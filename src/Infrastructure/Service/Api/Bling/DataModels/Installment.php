<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Installment 
{
    private $id;
    private $dataVencimento;
    private $valor;
    private $observacoes;
    private $formaPagamento;

    public function getId() 
    {
        return $this->id;
    }

    public function getDataVencimento() 
    {
        return $this->dataVencimento;
    }

    public function getValor() 
    {
        return $this->valor;
    }

    public function getObservacoes() 
    {
        return $this->observacoes;
    }

    public function getFormaPagamento() 
    {
        return $this->formaPagamento;
    }

    public function setId($id) 
    {
        $this->id = $id;
        return $this;
    }

    public function setDataVencimento($dataVencimento) 
    {
        $this->dataVencimento = $dataVencimento;
        return $this;
    }

    public function setValor($valor) 
    {
        $this->valor = $valor;
        return $this;
    }

    public function setObservacoes($observacoes) 
    {
        $this->observacoes = $observacoes;
        return $this;
    }

    /**
     * @param FormaPagamento|null $formaPagamento
     */
    public function setFormaPagamento($formaPagamento) 
    {
        $this->formaPagamento = $formaPagamento;
        return $this;
    }
}
