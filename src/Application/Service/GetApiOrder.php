<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Entity\OrderDetail;
use AGTI\Bling\Entity\Orders;
use AGTI\Bling\Infrastructure\Mapping\MappingAdapter;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts\GetContactsSearchArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts\GetContactsService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Discount;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\OrderItem;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Shipping;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateOrder\CreateOrderService;
use AGTI\Bling\ValueObject\ApiToken;
Use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Product;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ShippingLabel;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\GetOrder\GetOrderService;
use Doctrine\ORM\EntityManagerInterface;

class GetApiOrder
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(GetOrderService $apiService, EntityManagerInterface $em)
    {
        $this->apiService = $apiService;
        $this->em = $em;
    }

    public function exec($id, $token)
    {
        $this->apiService->setToken($token);
        $r = $this->apiService->exec($id);
        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        dump($r);
        dump($this->apiService->getRequest());
    }
}