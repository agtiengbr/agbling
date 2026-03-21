<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\StockInfo;

class ListaEstoquesResponseSuccess
{
    /**
     * @var StockInfo[]
     */
    private $data;

    /**
     * Get the value of data
     *
     * @return  StockInfo[]
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param  StockInfo[]  $data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}