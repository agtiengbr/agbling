<?php

namespace AGTI\Bling\ValueObject;

class Configuration
{
    /** @var ApiToken */
    private $token;

    /** @var ?string */
    protected $productOrigin;

    /** @var Mappings */
    private $mappings;
    
    /** @var int|null */
    private $idFirstOrderToSend;

    /** @var boolean */
    private $syncProductDescription;

    private $syncProductData;
    private $syncStock;

    private $sendOrders;

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken(ApiToken $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of productOrigin
     */ 
    public function getProductOrigin()
    {
        if ($this->productOrigin === null) {
            return "";
        }
        return $this->productOrigin;
    }

    /**
     * Set the value of productOrigin
     *
     * @return  self
     */ 
    public function setProductOrigin($productOrigin="")
    {
        $this->productOrigin = $productOrigin;

        return $this;
    }

    /**
     * Get the value of mappings
     */ 
    public function getMappings()
    {
        if (is_null($this->mappings)) {
            return new Mappings;
        }

        return $this->mappings;
    }

    /**
     * Set the value of mappings
     *
     * @return  self
     */ 
    public function setMappings(Mappings $mappings)
    {
        $this->mappings = $mappings;

        return $this;
    }

    /**
     * Get the value of idFirstOrderToSend
     */ 
    public function getIdFirstOrderToSend()
    {
        return $this->idFirstOrderToSend;
    }

    /**
     * Set the value of idFirstOrderToSend
     *
     * @return  self
     */ 
    public function setIdFirstOrderToSend($idFirstOrderToSend)
    {
        $this->idFirstOrderToSend = $idFirstOrderToSend;

        return $this;
    }

    /**
     * Get the value of syncProductDescription
     */ 
    public function getSyncProductDescription()
    {
        return $this->syncProductDescription;
    }

    /**
     * Set the value of syncProductDescription
     *
     * @return  self
     */ 
    public function setSyncProductDescription($syncProductDescription)
    {
        $this->syncProductDescription = $syncProductDescription;

        return $this;
    }

    public function getSyncProductData()
    {
        return $this->syncProductData;
    }

    public function setSyncProductData($syncProductData)
    {
        $this->syncProductData = (bool) $syncProductData;
        return $this;
    }

    public function getSyncStock()
    {
        return $this->syncStock;
    }

    public function setSyncStock($syncStock)
    {
        $this->syncStock = (bool) $syncStock;
        return $this;
    }

    public function getSendOrders()
    {
        return $this->sendOrders;
    }

    public function setSendOrders($sendOrders)
    {
        $this->sendOrders = (bool) $sendOrders;
        return $this;
    }
}