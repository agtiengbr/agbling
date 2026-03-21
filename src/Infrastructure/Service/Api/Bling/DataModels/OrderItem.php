<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class OrderItem
{
    private $descricao;
    private $codigoFornecedor;
    private $unidade;
    private $valor;
    private $quantidade;
    private $aliquotaIPI;
    private $descricaoDetalhada;

    /**
     * @var Product
     */
    private $produto;


    /**
     * Get the value of descricaoDetalhada
     */ 
    public function getDescricaoDetalhada()
    {
        return $this->descricaoDetalhada;
    }

    /**
     * Set the value of descricaoDetalhada
     *
     * @return  self
     */ 
    public function setDescricaoDetalhada($descricaoDetalhada)
    {
        $this->descricaoDetalhada = $descricaoDetalhada;

        return $this;
    }

    /**
     * Get the value of aliquotaIPI
     */ 
    public function getAliquotaIPI()
    {
        return $this->aliquotaIPI;
    }

    /**
     * Set the value of aliquotaIPI
     *
     * @return  self
     */ 
    public function setAliquotaIPI($aliquotaIPI)
    {
        $this->aliquotaIPI = $aliquotaIPI;

        return $this;
    }

    /**
     * Get the value of quantidade
     */ 
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     *
     * @return  self
     */ 
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of unidade
     */ 
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * Set the value of unidade
     *
     * @return  self
     */ 
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get the value of codigoFornecedor
     */ 
    public function getCodigoFornecedor()
    {
        return $this->codigoFornecedor;
    }

    /**
     * Set the value of codigoFornecedor
     *
     * @return  self
     */ 
    public function setCodigoFornecedor($codigoFornecedor)
    {
        $this->codigoFornecedor = $codigoFornecedor;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of produto
     *
     * @return  Product
     */ 
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @param  Product  $produto
     *
     * @return  self
     */ 
    public function setProduto(Product $produto)
    {
        $this->produto = $produto;

        return $this;
    }
}