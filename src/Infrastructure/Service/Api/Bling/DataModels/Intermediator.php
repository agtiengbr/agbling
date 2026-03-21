<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Intermediator
{
    private $cnpj;
    private $nomeUsuario;

    /**
     * Get the value of cnpj
     */ 
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */ 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get the value of nomeUsuario
     */ 
    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    /**
     * Set the value of nomeUsuario
     *
     * @return  self
     */ 
    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;

        return $this;
    }
}