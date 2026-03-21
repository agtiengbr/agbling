<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Fees
{
    private $taxaComissao;
    private $custoFrete;
    private $valorBase;

    /**
     * Get the value of valorBase
     */ 
    public function getValorBase()
    {
        return $this->valorBase;
    }

    /**
     * Set the value of valorBase
     *
     * @return  self
     */ 
    public function setValorBase($valorBase)
    {
        $this->valorBase = $valorBase;

        return $this;
    }

    /**
     * Get the value of custoFrete
     */ 
    public function getCustoFrete()
    {
        return $this->custoFrete;
    }

    /**
     * Set the value of custoFrete
     *
     * @return  self
     */ 
    public function setCustoFrete($custoFrete)
    {
        $this->custoFrete = $custoFrete;

        return $this;
    }

    /**
     * Get the value of taxaComissao
     */ 
    public function getTaxaComissao()
    {
        return $this->taxaComissao;
    }

    /**
     * Set the value of taxaComissao
     *
     * @return  self
     */ 
    public function setTaxaComissao($taxaComissao)
    {
        $this->taxaComissao = $taxaComissao;

        return $this;
    }
}