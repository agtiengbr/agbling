<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Product;

class ListProductsResponseSuccess
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
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}