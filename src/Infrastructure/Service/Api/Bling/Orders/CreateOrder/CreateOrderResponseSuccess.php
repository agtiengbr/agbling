<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateOrder;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;
use AGTI\PagSeguro\Infrastructure\Api\Remote\Order\Entity\Order as EntityOrder;

class CreateOrderResponseSuccess
{
    /** @var EntityOrder */
    private $data;

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}