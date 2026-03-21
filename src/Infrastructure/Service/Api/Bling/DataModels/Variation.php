<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Variation
{
    private $nome;
    private $order;
    private $produtoPai;

    /**
     * Get the value of produtoPai
     */ 
    public function getProdutoPai()
    {
        return $this->produtoPai;
    }

    /**
     * Set the value of produtoPai
     *
     * @return  self
     */ 
    public function setProdutoPai(Product $produtoPai)
    {
        $this->produtoPai = $produtoPai;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of order
     *
     * @return  self
     */ 
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }
}