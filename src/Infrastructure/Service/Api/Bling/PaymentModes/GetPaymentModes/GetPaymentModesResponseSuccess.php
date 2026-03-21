<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\PaymentModes\GetPaymentModes;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\PaymentMode;

class GetPaymentModesResponseSuccess
{
    /**
     * @var PaymentMode[]
     */
    private $data;

    /**
     * Get the value of data
     *
     * @return  PaymentMode[]
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param  PaymentMode[]  $data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}