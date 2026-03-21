<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Shipping
{
    private $frete;
    private $transportador;
    private $fretePorConta;
    private $pesoBruto;
    private $volumes;

    /**
     * @var ShippingLabel
     */
    private $etiqueta;

    /**
     * Get the value of frete
     */ 
    public function getFrete()
    {
        return $this->frete;
    }

    /**
     * Set the value of frete
     *
     * @return  self
     */ 
    public function setFrete($frete)
    {
        $this->frete = $frete;

        return $this;
    }

    /**
     * Get the value of transportador
     */ 
    public function getTransportador()
    {
        return $this->transportador;
    }

    /**
     * Set the value of transportador
     *
     * @return  self
     */ 
    public function setTransportador($transportador)
    {
        $this->transportador = $transportador;

        return $this;
    }

    /**
     * Get the value of fretePorConta
     */ 
    public function getFretePorConta()
    {
        return $this->fretePorConta;
    }

    /**
     * Set the value of fretePorConta
     *
     * @return  self
     */ 
    public function setFretePorConta($fretePorConta)
    {
        $this->fretePorConta = $fretePorConta;

        return $this;
    }

    /**
     * Get the value of pesoBruto
     */ 
    public function getPesoBruto()
    {
        return $this->pesoBruto;
    }

    /**
     * Set the value of pesoBruto
     *
     * @return  self
     */ 
    public function setPesoBruto($pesoBruto)
    {
        $this->pesoBruto = $pesoBruto;

        return $this;
    }

    /**
     * Get the value of volumes
     */ 
    public function getVolumes()
    {
        return $this->volumes;
    }

    /**
     * Set the value of volumes
     *
     * @return  self
     */ 
    public function setVolumes($volumes)
    {
        $this->volumes = $volumes;

        return $this;
    }

    /**
     * Get the value of etiqueta
     *
     * @return  ShippingLabel
     */ 
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set the value of etiqueta
     *
     * @param  ShippingLabel  $etiqueta
     *
     * @return  self
     */ 
    public function setEtiqueta(ShippingLabel $etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }
}