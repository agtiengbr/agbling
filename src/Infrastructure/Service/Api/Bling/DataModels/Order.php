<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Order
{
    private $id;
    private $numero;
    private $numeroLoja;

    private $data;
    private $dataSaida;
    // private $dataPrevista;
    private $contato;
    private $loja;
    private $numeroPedidoCompra;
    private $outrasDespesas;
    // private $observacoes;
    // private $observacoesInternas;
    private $desconto;
    // private $categoria;
    // private $tributacao;
    private $itens;
    private $parcelas;
    private $transporte;
    private $vendedor;
    private $intermediador;
    private $taxas;


    // private $fornecedor;
    /** @var Situacao */
    private $situacao;
    // private $ordemCompra;
    


    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of dataPrevista
     */ 
    // public function getDataPrevista()
    // {
    //     return $this->dataPrevista;
    // }

    // /**
    //  * Set the value of dataPrevista
    //  *
    //  * @return  self
    //  */ 
    // public function setDataPrevista($dataPrevista)
    // {
    //     $this->dataPrevista = $dataPrevista;

    //     return $this;
    // }

    /**
     * Get the value of fornecedor
     */ 
    // public function getFornecedor()
    // {
    //     return $this->fornecedor;
    // }

    // /**
    //  * Set the value of fornecedor
    //  *
    //  * @return  self
    //  */ 
    // public function setFornecedor($fornecedor)
    // {
    //     $this->fornecedor = $fornecedor;

    //     return $this;
    // }

    // /**
    //  * Get the value of situacao
    //  */ 
    // public function getSituacao()
    // {
    //     return $this->situacao;
    // }

    // /**
    //  * Set the value of situacao
    //  *
    //  * @return  self
    //  */ 
    // public function setSituacao($situacao)
    // {
    //     $this->situacao = $situacao;

    //     return $this;
    // }

    // /**
    //  * Get the value of ordemCompra
    //  */ 
    // public function getOrdemCompra()
    // {
    //     return $this->ordemCompra;
    // }

    // /**
    //  * Set the value of ordemCompra
    //  *
    //  * @return  self
    //  */ 
    // public function setOrdemCompra($ordemCompra)
    // {
    //     $this->ordemCompra = $ordemCompra;

    //     return $this;
    // }

    // /**
    //  * Get the value of observacoes
    //  */ 
    // public function getObservacoes()
    // {
    //     return $this->observacoes;
    // }

    // /**
    //  * Set the value of observacoes
    //  *
    //  * @return  self
    //  */ 
    // public function setObservacoes($observacoes)
    // {
    //     $this->observacoes = $observacoes;

    //     return $this;
    // }

    // /**
    //  * Get the value of observacoesInternas
    //  */ 
    // public function getObservacoesInternas()
    // {
    //     return $this->observacoesInternas;
    // }

    // /**
    //  * Set the value of observacoesInternas
    //  *
    //  * @return  self
    //  */ 
    // public function setObservacoesInternas($observacoesInternas)
    // {
    //     $this->observacoesInternas = $observacoesInternas;

    //     return $this;
    // }

    /**
     * Get the value of desconto
     */ 
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * Set the value of desconto
     *
     * @return  self
     */ 
    public function setDesconto(Discount $desconto)
    {
        $this->desconto = $desconto;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    // public function getCategoria()
    // {
    //     return $this->categoria;
    // }

    // /**
    //  * Set the value of categoria
    //  *
    //  * @return  self
    //  */ 
    // public function setCategoria($categoria)
    // {
    //     $this->categoria = $categoria;

    //     return $this;
    // }

    // /**
    //  * Get the value of tributacao
    //  */ 
    // public function getTributacao()
    // {
    //     return $this->tributacao;
    // }

    // /**
    //  * Set the value of tributacao
    //  *
    //  * @return  self
    //  */ 
    // public function setTributacao($tributacao)
    // {
    //     $this->tributacao = $tributacao;

    //     return $this;
    // }

    /**
     * Get the value of transporte
     */ 
    public function getTransporte()
    {
        return $this->transporte;
    }

    /**
     * Set the value of transporte
     *
     * @return  self
     */ 
    public function setTransporte($transporte)
    {
        $this->transporte = $transporte;

        return $this;
    }

    /**
     * Get the value of itens
     */ 
    public function getItens()
    {
        return $this->itens;
    }

    /**
     * Set the value of itens
     *
     * @return  self
     */ 
    public function setItens($itens)
    {
        $this->itens = $itens;

        return $this;
    }

    /**
     * Get the value of parcelas
     */ 
    public function getParcelas()
    {
        return $this->parcelas;
    }

    /**
     * Set the value of parcelas
     *
     * @return  self
     */ 
    public function setParcelas($parcelas)
    {
        $this->parcelas = $parcelas;

        return $this;
    }

    /**
     * Get the value of numeroLoja
     */ 
    public function getNumeroLoja()
    {
        return $this->numeroLoja;
    }

    /**
     * Set the value of numeroLoja
     *
     * @return  self
     */ 
    public function setNumeroLoja($numeroLoja)
    {
        $this->numeroLoja = $numeroLoja;

        return $this;
    }

    /**
     * Get the value of dataSaida
     */ 
    public function getDataSaida()
    {
        return $this->dataSaida;
    }

    /**
     * Set the value of dataSaida
     *
     * @return  self
     */ 
    public function setDataSaida($dataSaida)
    {
        $this->dataSaida = $dataSaida;

        return $this;
    }

    /**
     * Get the value of contato
     */ 
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Set the value of contato
     *
     * @return  self
     */ 
    public function setContato(Contact $contato)
    {
        $this->contato = $contato;

        return $this;
    }

    /**
     * Get the value of loja
     */ 
    public function getLoja()
    {
        return $this->loja;
    }

    /**
     * Set the value of loja
     *
     * @return  self
     */ 
    public function setLoja(Shop $loja)
    {
        $this->loja = $loja;

        return $this;
    }

    /**
     * Get the value of numeroPedidoCompra
     */ 
    public function getNumeroPedidoCompra()
    {
        return $this->numeroPedidoCompra;
    }

    /**
     * Set the value of numeroPedidoCompra
     *
     * @return  self
     */ 
    public function setNumeroPedidoCompra($numeroPedidoCompra)
    {
        $this->numeroPedidoCompra = $numeroPedidoCompra;

        return $this;
    }

    /**
     * Get the value of outrasDespesas
     */ 
    public function getOutrasDespesas()
    {
        return $this->outrasDespesas;
    }

    /**
     * Set the value of outrasDespesas
     *
     * @return  self
     */ 
    public function setOutrasDespesas($outrasDespesas)
    {
        $this->outrasDespesas = $outrasDespesas;

        return $this;
    }

    /**
     * Get the value of vendedor
     */ 
    public function getVendedor()
    {
        return $this->vendedor;
    }

    /**
     * Set the value of vendedor
     *
     * @return  self
     */ 
    public function setVendedor($vendedor)
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    /**
     * Get the value of intermediador
     */ 
    public function getIntermediador()
    {
        return $this->intermediador;
    }

    /**
     * Set the value of intermediador
     *
     * @return  self
     */ 
    public function setIntermediador($intermediador)
    {
        $this->intermediador = $intermediador;

        return $this;
    }

    /**
     * Get the value of taxas
     */ 
    public function getTaxas()
    {
        return $this->taxas;
    }

    /**
     * Set the value of taxas
     *
     * @return  self
     */ 
    public function setTaxas($taxas)
    {
        $this->taxas = $taxas;

        return $this;
    }

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
     * Get the value of situacao
     */ 
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set the value of situacao
     *
     * @return  self
     */ 
    public function setSituacao(Situacao $situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }
}