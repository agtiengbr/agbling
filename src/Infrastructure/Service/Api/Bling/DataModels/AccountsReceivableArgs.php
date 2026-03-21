<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

use DateTime;

class AccountsReceivableArgs
{
    private $pagina;
    private $limite;
    private $situacoes;
    private $tipoFiltroData;
    private $dataInicial;
    private $dataFinal;
    private $idsCategorias;
    private $idPortador;
    private $idContato;
    private $idVendedor;
    private $idFormaPagamento;
    private $boletoGerado;

    public function getPagina()
    {
        return $this->pagina;
    }

    public function setPagina($pagina)
    {
        $this->pagina = $pagina;
        return $this;
    }

    public function getLimite()
    {
        return $this->limite;
    }

    public function setLimite($limite)
    {
        if ($limite > 100) {
            throw new \InvalidArgumentException("O limite máximo de itens por página é 100.");
        }
        $this->limite = $limite;
        return $this;
    }

    public function getSituacoes()
    {
        return $this->situacoes;
    }

    public function setSituacoes(array $situacoes)
    {
        foreach ($situacoes as $situacao) {
            if ($situacao < 1 || $situacao > 5) {
                throw new \InvalidArgumentException("As situações devem ser inteiros de 1 a 5.");
            }
        }
        $this->situacoes = $situacoes;
        return $this;
    }

    public function getTipoFiltroData()
    {
        return $this->tipoFiltroData;
    }

    public function setTipoFiltroData($tipoFiltroData)
    {
        if (!in_array($tipoFiltroData, ['E', 'V', 'R'])) {
            throw new \InvalidArgumentException("O tipo de filtro deve ser 'E', 'V' ou 'R'.");
        }
        $this->tipoFiltroData = $tipoFiltroData;
        return $this;
    }

    public function getDataInicial()
    {
        return $this->dataInicial;
    }

    public function setDataInicial(DateTime $dataInicial)
    {
        $this->dataInicial = $dataInicial;
        return $this;
    }

    public function getDataFinal()
    {
        return $this->dataFinal;
    }

    public function setDataFinal(DateTime $dataFinal)
    {
        $this->dataFinal = $dataFinal;
        return $this;
    }

    public function getIdsCategorias()
    {
        return $this->idsCategorias;
    }

    public function setIdsCategorias($idsCategorias)
    {
        $this->idsCategorias = $idsCategorias;
        return $this;
    }

    public function getIdPortador()
    {
        return $this->idPortador;
    }

    public function setIdPortador($idPortador)
    {
        $this->idPortador = $idPortador;
        return $this;
    }

    public function getIdContato()
    {
        return $this->idContato;
    }

    public function setIdContato($idContato)
    {
        $this->idContato = $idContato;
        return $this;
    }

    public function getIdVendedor()
    {
        return $this->idVendedor;
    }

    public function setIdVendedor($idVendedor)
    {
        $this->idVendedor = $idVendedor;
        return $this;
    }

    public function getIdFormaPagamento()
    {
        return $this->idFormaPagamento;
    }

    public function setIdFormaPagamento($idFormaPagamento)
    {
        $this->idFormaPagamento = $idFormaPagamento;
        return $this;
    }

    public function getBoletoGerado()
    {
        return $this->boletoGerado;
    }

    public function setBoletoGerado($boletoGerado)
    {
        $this->boletoGerado = $boletoGerado;
        return $this;
    }
}