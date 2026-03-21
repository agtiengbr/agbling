<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Origem
{
    private $id;
    private $tipoOrigem;
    private $numero;
    private $dataEmissao;
    private $valor;
    private $situacao;
    private $url;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getTipoOrigem()
    {
        return $this->tipoOrigem;
    }

    public function setTipoOrigem($tipoOrigem)
    {
        $this->tipoOrigem = $tipoOrigem;
        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    public function setDataEmissao($dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;
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

    public function getSituacao()
    {
        return $this->situacao;
    }

    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}
