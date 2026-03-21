<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class AccountsReceivable
{
    private $id;
    private $situacao;
    private $vencimento;
    private $valor;
    private $idTransacao;
    private $linkQRCodePix;
    private $linkBoleto;
    private $dataEmissao;
    private $contato;
    private $formaPagamento;
    private $contaContabil;
    private $origem;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getSituacao()
    {
        return $this->situacao;
    }

    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
        return $this;
    }

    public function getVencimento()
    {
        return $this->vencimento;
    }

    public function setVencimento(\DateTime $vencimento)
    {
        $this->vencimento = $vencimento;
        return $this;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    public function getIdTransacao()
    {
        return $this->idTransacao;
    }

    public function setIdTransacao($idTransacao)
    {
        $this->idTransacao = $idTransacao;
        return $this;
    }

    public function getLinkQRCodePix()
    {
        return $this->linkQRCodePix;
    }

    public function setLinkQRCodePix($linkQRCodePix)
    {
        $this->linkQRCodePix = $linkQRCodePix;
        return $this;
    }

    public function getLinkBoleto()
    {
        return $this->linkBoleto;
    }

    public function setLinkBoleto($linkBoleto)
    {
        $this->linkBoleto = $linkBoleto;
        return $this;
    }

    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    public function setDataEmissao(\DateTime $dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;
        return $this;
    }

    public function getContato()
    {
        return $this->contato;
    }

    public function setContato(Contato $contato)
    {
        $this->contato = $contato;
        return $this;
    }

    public function getFormaPagamento()
    {
        return $this->formaPagamento;
    }

    public function setFormaPagamento(FormaPagamento $formaPagamento)
    {
        $this->formaPagamento = $formaPagamento;
        return $this;
    }

    public function getContaContabil()
    {
        return $this->contaContabil;
    }

    public function setContaContabil(ContaContabil $contaContabil)
    {
        $this->contaContabil = $contaContabil;
        return $this;
    }

    public function getOrigem()
    {
        return $this->origem;
    }

    public function setOrigem(Origem $origem)
    {
        $this->origem = $origem;
        return $this;
    }
}
