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
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts\GetContactsSearchArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts\GetContactsService;
use Doctrine\ORM\EntityManagerInterface;

class SearchContactByDocument
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;
    private $mapping;

    public function __construct(GetContactsService $apiService, EntityManagerInterface $em, MappingAdapter $mapping)
    {
        $this->apiService = $apiService;
        $this->em = $em;
        $this->mapping = $mapping;
    }

    /**
     * @return Contact|null
     */
    public function exec(Customer $ettCustomer, ApiToken $token)
    {
        $data = $this->mapping->getDocumentFromCustomer($ettCustomer);;
        if ($data['cnpj'] && $data['company']) {
            $document = $data['cnpj'];
        } else {
            $document = $data['cpf'];
        }

        $document = preg_replace("/[^0-9]/", "", $document);
        $args = new GetContactsSearchArgs;
        $args->setNumeroDocumento($document);

        $this->apiService->setToken($token);
        $r = $this->apiService->exec($args);
        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        if (count($r->getData())) {
            return $r->getData()[0];
        }
        
        return null;
    }
}