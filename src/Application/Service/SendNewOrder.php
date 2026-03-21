<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Entity\AgBlingOrderState;
use AGTI\Bling\Entity\OrderDetail;
use AGTI\Bling\Entity\Orders;
use AGTI\Bling\Infrastructure\Factory\Configuration;
use AGTI\Bling\Infrastructure\Mapping\MappingAdapter;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts\GetContactsSearchArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts\GetContactsService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Discount;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Installment;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\OrderItem;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\PaymentMode;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Shipping;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateOrder\CreateOrderService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\UpdateOrderState\UpdateOrderStateService;
use AGTI\Bling\ValueObject\ApiToken;
Use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Product;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ShippingLabel;
use AGTI\Bling\ValueObject\Mappings;
use Doctrine\ORM\EntityManagerInterface;

class SendNewOrder
{
    use ApiApplicationTrait;

    private $apiService;
    private $getContactsService;
    private $updateOrderStateService;
    private $adapter;
    private $em;
    private $mappings;

    public function __construct(CreateOrderService $apiService, GetContactsService $getContactsService, UpdateOrderStateService $updateOrderStateService, MappingAdapter $adapter, EntityManagerInterface $em, Mappings $mappings)
    {
        $this->apiService = $apiService;
        $this->getContactsService = $getContactsService;
        $this->updateOrderStateService = $updateOrderStateService;
        $this->adapter = $adapter;
        $this->em = $em;
        $this->mappings = $mappings;
    }

    public function exec(Orders $psOrder, ApiToken $token)
    {
        //transportadora
        $address = $psOrder->getAddressDelivery();


        $apiTransporte = new Shipping;
        $apiTransporte->setFrete(
            $psOrder->getTotalShippingTaxIncl()
        )->setPesoBruto($psOrder->getTotalWeight())
        ->setEtiqueta(
            (new ShippingLabel)
                ->setNome($address->getFirstname() . '  ' . $address->getLastname())
                ->setEndereco($address->getAddress1())
                ->setNumero("")
                ->setComplemento($address->getOther())
                ->setMunicipio($address->getCity())
                ->setUf($address->getState()->getIsoCode())
                ->setCep($address->getPostcode())
                ->setBairro($address->getAddress2())
                ->setNomePais("Brasil")
        );

        //produtos
        $apiItens = array_map(
            function(OrderDetail $prod){
                /** @var AgblingProduct|null */
                $blingProd = $this->em->getRepository(AgblingProduct::class)->findOneBy(['sku' => $prod->getProductReference()]);

                if (!$blingProd) {
                    throw new \Exception("O produto {$prod->getProductName()} (SKU {$prod->getProductReference()}) não foi vinculado corretamente ao Bling.");
                }

                return (new OrderItem)
                    ->setDescricao($prod->getProductName())
                    ->setQuantidade($prod->getQty())
                    ->setValor($prod->getTotalPriceTaxIncl())
                    ->setProduto(
                        (new Product)
                            ->setId($blingProd->getIdRemote())
                    );
            },
            $psOrder->getProducts()->getValues()
        );

        //desconto
        $apiDiscount = new Discount;
        $apiDiscount->setValor($psOrder->getTotalDiscountsTaxIncl())
            ->setUnidade('REAL');

        // parcelas
        $installments = [];
        $paymentModeBling = $this->mappings->getPaymentMapping(str_replace(' ', '_', $psOrder->getPayment()));
        
        if ($paymentModeBling) {
            $installment = (new Installment)
                ->setValor($psOrder->getTotalPaid())
                ->setObservacoes("Parcela gerada pela integração da AGTI.")
                ->setDataVencimento(new \DateTime)
                ->setFormaPagamento(
                    (new PaymentMode)
                        ->setId($paymentModeBling)
                );
            $installments[] = $installment;
        }


        //extrai o CPF/CNPJ do Contato
        $data = $this->adapter->getDocumentFromCustomer($psOrder->getCustomer());
        if ($data['cnpj'] && $data['company']) {
            $document = $data['cnpj'];
        } else {
            $document = $data['cpf'];
        }
        $document = preg_replace("/[^0-9]/", "", $document);

        $apiOrder = new Order;
        $apiOrder->setNumeroLoja($psOrder->getId())
            ->setNumero($psOrder->getId())
            ->setData($psOrder->getDateAdd())
            ->setContato(
                $this->getContactsService->exec(
                    (new GetContactsSearchArgs)->setNumeroDocumento($document)
                )->getData()[0]
            )
            ->setDesconto($apiDiscount)
            ->setTransporte($apiTransporte)
            ->setItens($apiItens)
            ->setParcelas($installments);

        


        $this->apiService->setToken($token);
        $r = $this->apiService->exec($apiOrder);
        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        // Atualiza o estado do pedido no Bling
        $blingOrderId = $r->getData()->getId();
        $currentStateId = $psOrder->getCurrentState()->getIdOrderState();
        $blingStateId = $this->mappings->getOrderStateMapping($currentStateId);

        if ($blingStateId) {
            $blingOrderState = $this->em->getRepository(AgBlingOrderState::class)->find($blingStateId);
            if ($blingOrderState) {
                $this->updateOrderStateService->setToken($token);
                $this->updateOrderStateService->exec($blingOrderId, $blingOrderState->getIdRemote());
                $this->postApiRequest($this->updateOrderStateService->getRequest(), $this->em);
            }
        }

        
        $repo = $this->em->getRepository(AgblingOrder::class);
        $bo = $repo->findOneBy(['psOrder' => $psOrder]);

        if (!$bo) {
            $bo = new AgblingOrder;
            $bo->setPsOrder($psOrder);
            $psOrder->setBlingOrder($bo);

            $this->em->persist($bo);
        }

        $bo->setIdRemote($r->getData()->getId());

        $this->em->flush();
    }
}