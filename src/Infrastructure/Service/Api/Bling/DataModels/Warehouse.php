<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Warehouse
{
    private $id;
    private $saldoFisico;
    private $saldoVirtual;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of saldoFisico
     */ 
    public function getSaldoFisico()
    {
        return $this->saldoFisico;
    }

    /**
     * Set the value of saldoFisico
     *
     * @return  self
     */ 
    public function setSaldoFisico($saldoFisico)
    {
        $this->saldoFisico = $saldoFisico;

        return $this;
    }

    /**
     * Get the value of saldoVirtual
     */ 
    public function getSaldoVirtual()
    {
        return $this->saldoVirtual;
    }

    /**
     * Set the value of saldoVirtual
     *
     * @return  self
     */ 
    public function setSaldoVirtual($saldoVirtual)
    {
        $this->saldoVirtual = $saldoVirtual;

        return $this;
    }
}