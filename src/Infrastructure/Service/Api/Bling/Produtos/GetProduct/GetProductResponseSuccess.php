<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\GetProduct;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Product;

class GetProductResponseSuccess
{
    /** @var Product[] */
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
    public function setData(Product $data)
    {
        $this->data = $data;

        return $this;
    }
}