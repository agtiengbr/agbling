<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\Orders;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\CreateContact\CreateContactService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Discount;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Shipping;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateOrder\CreateOrderService;
use AGTI\Bling\ValueObject\ApiToken;
use AGTI\Bling\Entity\Customer;
use AGTI\Bling\Infrastructure\Mapping\MappingAdapter;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\UpdateContact\UpdateContactService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContactAddress;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Address;
use Doctrine\ORM\EntityManagerInterface;

class UpdateContact
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;
    private $mapping;

    public function __construct(UpdateContactService $apiService, EntityManagerInterface $em, MappingAdapter $mapping)
    {
        $this->apiService = $apiService;
        $this->em = $em;
        $this->mapping = $mapping;
    }

    /**
     * Se o $order for informado, então os endereços do contato serão obtidos a partir desta order
     */
    public function exec(Customer $ettCustomer, Contact $apiContact, ApiToken $token, Orders $order = null)
    {
        \AgclienteLogger::addLog("Buscando documento do cliente.");
        $data = $this->mapping->getDocumentFromCustomer($ettCustomer);;
        if ($data['cnpj'] && $data['company']) {
            $apiContact->setNumeroDocumento($data['cnpj'])
                ->setNome($data['company'])
                ->setTipo('J');
        } elseif ($data['cpf']) {
            $apiContact->setNumeroDocumento($data['cpf'])
                ->setNome($data['name'])
                ->setTipo('F');
        } else {
            $apiContact->setTipo("E");
        }
        
        \AgclienteLogger::addLog("Buscando dados do pedido.");
        if ($order) {
            $number = $this->mapping->getNumberFromAddress($order->getAddressInvoice()) ?: 'S/N';
            $apiContact->setEndereco(
                (new ContactAddress)
                    ->setCobranca(
                        (new Address)
                            ->setEndereco($order->getAddressInvoice()->getAddress1())
                            ->setCep($order->getAddressInvoice()->getPostcode())
                            ->setBairro($order->getAddressInvoice()->getAddress2())
                            ->setMunicipio($order->getAddressInvoice()->getCity())
                            ->setUf($order->getAddressInvoice()->getState()->getIsoCode())
                            ->setNumero($number)
                            ->setComplemento($order->getAddressInvoice()->getOther())
                    )
                    ->setGeral(
                        (new Address)
                            ->setEndereco($order->getAddressDelivery()->getAddress1())
                            ->setCep($order->getAddressDelivery()->getPostcode())
                            ->setBairro($order->getAddressDelivery()->getAddress2())
                            ->setMunicipio($order->getAddressDelivery()->getCity())
                            ->setUf($order->getAddressDelivery()->getState()->getIsoCode())
                            ->setNumero($number)
                            ->setComplemento($order->getAddressDelivery()->getOther())
                    )
            );
        }

        $apiContact->setSituacao('A');
        
        \AgclienteLogger::addLog("Enviando Request.");
        $this->apiService->setToken($token);
        $this->apiService->exec($apiContact, $apiContact->getId(), $token);

        \AgclienteLogger::addLog("Salvando Request.");
        $this->postApiRequest($this->apiService->getRequest(), $this->em);
    }
}