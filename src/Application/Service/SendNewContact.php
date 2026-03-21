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
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContactAddress;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Address;
use Doctrine\ORM\EntityManagerInterface;

class SendNewContact
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;
    private $mapping;

    public function __construct(CreateContactService $apiService, EntityManagerInterface $em, MappingAdapter $mapping)
    {
        $this->apiService = $apiService;
        $this->em = $em;
        $this->mapping = $mapping;
    }

    /**
     * Se o $order for informado, então os endereços do contato serão obtidos a partir desta order
     */
    public function exec(Customer $ettCustomer, ApiToken $token, Orders $order = null)
    {
        $apiContact = new Contact;

        $data = $this->mapping->getDocumentFromCustomer($ettCustomer);;
        if ($data['cnpj'] && $data['company']) {
            $apiContact->setNumeroDocumento($data['cnpj'])
                ->setNome($data['company'])
                ->setTipo('J');
        } else {
            $apiContact->setNumeroDocumento($data['cpf'])
                ->setNome($data['name'])
                ->setTipo('F');
        }
        
        if ($order) {
            $apiContact->setEndereco(
                (new ContactAddress)
                    ->setCobranca(
                        (new Address)
                            ->setEndereco($order->getAddressInvoice()->getAddress1())
                            ->setCep($order->getAddressInvoice()->getPostcode())
                            ->setBairro($order->getAddressInvoice()->getAddress2())
                            ->setMunicipio($order->getAddressInvoice()->getCity())
                            ->setUf($order->getAddressInvoice()->getState()->getIsoCode())
                            ->setNumero($this->mapping->getNumberFromAddress($order->getAddressInvoice()))
                            ->setComplemento($order->getAddressInvoice()->getOther())
                    )
                    ->setGeral(
                        (new Address)
                            ->setEndereco($order->getAddressDelivery()->getAddress1())
                            ->setCep($order->getAddressDelivery()->getPostcode())
                            ->setBairro($order->getAddressDelivery()->getAddress2())
                            ->setMunicipio($order->getAddressDelivery()->getCity())
                            ->setUf($order->getAddressDelivery()->getState()->getIsoCode())
                            ->setNumero($this->mapping->getNumberFromAddress($order->getAddressDelivery()))
                            ->setComplemento($order->getAddressDelivery()->getOther())
                    )
            );
        }

        $apiContact->setSituacao('A');
        
        $this->apiService->setToken($token);
        $r = $this->apiService->exec($apiContact);
        $this->postApiRequest($this->apiService->getRequest(), $this->em);
    }
}