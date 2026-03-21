<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class ContasContabeisArgs
{
    private $pagina;
    private $limite;
    private $ocultarInvisiveis;
    private $ocultarTipoContaBancaria;
    private $aliasIntegracao;

    public function getPagina()
    {
        return $this->pagina;
    }

    public function getLimite()
    {
        return $this->limite;
    }

    public function getOcultarInvisiveis()
    {
        return $this->ocultarInvisiveis;
    }

    public function getOcultarTipoContaBancaria()
    {
        return $this->ocultarTipoContaBancaria;
    }

    public function getAliasIntegracao()
    {
        return $this->aliasIntegracao;
    }

    /**
     * Set the value of pagina
     *
     * @return  self
     */ 
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;

        return $this;
    }

    /**
     * Set the value of limite
     *
     * @return  self
     */ 
    public function setLimite($limite)
    {
        $this->limite = $limite;

        return $this;
    }

    /**
     * Set the value of ocultarInvisiveis
     *
     * @return  self
     */ 
    public function setOcultarInvisiveis($ocultarInvisiveis)
    {
        $this->ocultarInvisiveis = $ocultarInvisiveis;

        return $this;
    }

    /**
     * Set the value of ocultarTipoContaBancaria
     *
     * @return  self
     */ 
    public function setOcultarTipoContaBancaria($ocultarTipoContaBancaria)
    {
        $this->ocultarTipoContaBancaria = $ocultarTipoContaBancaria;

        return $this;
    }

    /**
     * Set the value of aliasIntegracao
     *
     * @return  self
     */ 
    public function setAliasIntegracao($aliasIntegracao)
    {
        $this->aliasIntegracao = $aliasIntegracao;

        return $this;
    }
}
