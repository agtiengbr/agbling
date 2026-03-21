<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class StockInfo
{
    private $produto;
    private $saldoFisicoTotal;
    private $saldoVirtualTotal;
    private $depositos;

    /**
     * Get the value of depositos
     */ 
    public function getDepositos()
    {
        return $this->depositos;
    }

    /**
     * Set the value of depositos
     *
     * @return  self
     */ 
    public function setDepositos($depositos)
    {
        $this->depositos = $depositos;

        return $this;
    }

    /**
     * Get the value of saldoVirtualTotal
     */ 
    public function getSaldoVirtualTotal()
    {
        return $this->saldoVirtualTotal;
    }

    /**
     * Set the value of saldoVirtualTotal
     *
     * @return  self
     */ 
    public function setSaldoVirtualTotal($saldoVirtualTotal)
    {
        $this->saldoVirtualTotal = $saldoVirtualTotal;

        return $this;
    }

    /**
     * Get the value of saldoFisicoTotal
     */ 
    public function getSaldoFisicoTotal()
    {
        return $this->saldoFisicoTotal;
    }

    /**
     * Set the value of saldoFisicoTotal
     *
     * @return  self
     */ 
    public function setSaldoFisicoTotal($saldoFisicoTotal)
    {
        $this->saldoFisicoTotal = $saldoFisicoTotal;

        return $this;
    }

    /**
     * Get the value of produto
     */ 
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @return  self
     */ 
    public function setProduto(Product $produto)
    {
        $this->produto = $produto;

        return $this;
    }
}