<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque;

class ListaEstoquesServiceArgs
{
    private $ids;

    /**
     * Get the value of ids
     */ 
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * Set the value of ids
     *
     * @return  self
     */ 
    public function setIds($ids)
    {
        $this->ids = $ids;

        return $this;
    }
}