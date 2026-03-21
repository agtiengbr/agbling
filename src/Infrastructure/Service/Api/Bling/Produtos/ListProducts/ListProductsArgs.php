<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts;

class ListProductsArgs
{
    private $page;
    private $limit;
    private $type;
    private $criteria;

    /**
     * Get the value of criteria
     */ 
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * Set the value of criteria
     *
     * @return  self
     */ 
    public function setCriteria($criteria)
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of limit
     */ 
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */ 
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the value of page
     */ 
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */ 
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }
}