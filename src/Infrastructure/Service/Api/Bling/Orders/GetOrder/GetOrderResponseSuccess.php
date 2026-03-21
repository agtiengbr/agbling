<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\GetOrder;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;

class GetOrderResponseSuccess
{
    /**
     * @var Order
     */
    private $data;

    

    /**
     * Get the value of data
     *
     * @return  Order
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param  Order  $data
     *
     * @return  self
     */ 
    public function setData(Order $data)
    {
        $this->data = $data;

        return $this;
    }
}