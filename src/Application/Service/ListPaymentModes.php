<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Infrastructure\Service\Api\Bling\PaymentModes\GetPaymentModes\GetPaymentModesService;
use Doctrine\ORM\EntityManagerInterface;

class ListPaymentModes
{
    use ApiApplicationTrait;

    private $em;
    private $service;

    public function __construct(
        GetPaymentModesService $service,
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
        $this->service = $service;
    }

    public function exec($token)
    {
        $this->service->setToken($token);
        $r = $this->service->exec();
        $this->postApiRequest($this->service->getRequest(), $this->em);

        return $r->getData();
    }
}