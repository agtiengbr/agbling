<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\GetProduct\GetProduct;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\GetProduct\GetProductArgs;
use Doctrine\ORM\EntityManagerInterface;

class GetApiProduct
{
    use ApiApplicationTrait;

    private $em;
    private $apiService;

    public function __construct(GetProduct $apiService, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->apiService = $apiService;
    }

    public function exec($idRemote, $token)
    {
        $this->apiService->setToken($token);
        
        $args = new GetProductArgs;
        $args->setId($idRemote);

        $prod = $this->apiService->exec($args);
        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        return $prod;
    }
}