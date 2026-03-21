<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class ProductStock
{
    private $minimo;
    private $maximo;
    private $crossdocking;
    private $localizacao;

    /**
     * Get the value of localizacao
     */ 
    public function getLocalizacao()
    {
        return $this->localizacao;
    }

    /**
     * Set the value of localizacao
     *
     * @return  self
     */ 
    public function setLocalizacao($localizacao)
    {
        $this->localizacao = $localizacao;

        return $this;
    }

    /**
     * Get the value of crossdocking
     */ 
    public function getCrossdocking()
    {
        return $this->crossdocking;
    }

    /**
     * Set the value of crossdocking
     *
     * @return  self
     */ 
    public function setCrossdocking($crossdocking)
    {
        $this->crossdocking = $crossdocking;

        return $this;
    }

    /**
     * Get the value of maximo
     */ 
    public function getMaximo()
    {
        return $this->maximo;
    }

    /**
     * Set the value of maximo
     *
     * @return  self
     */ 
    public function setMaximo($maximo)
    {
        $this->maximo = $maximo;

        return $this;
    }

    /**
     * Get the value of minimo
     */ 
    public function getMinimo()
    {
        return $this->minimo;
    }

    /**
     * Set the value of minimo
     *
     * @return  self
     */ 
    public function setMinimo($minimo)
    {
        $this->minimo = $minimo;

        return $this;
    }
}