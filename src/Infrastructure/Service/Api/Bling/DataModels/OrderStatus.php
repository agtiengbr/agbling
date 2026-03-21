<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class OrderStatus
{
    private $id;
    private $idModuloSistema;
    private $idEmpresa;
    private $nome;
    private $valor;
    private $cor;
    private $interna;
    private $idHerdado;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdModuloSistema()
    {
        return $this->idModuloSistema;
    }

    public function setIdModuloSistema($idModuloSistema)
    {
        $this->idModuloSistema = $idModuloSistema;
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getCor()
    {
        return $this->cor;
    }

    public function setCor($cor)
    {
        $this->cor = $cor;
    }

    public function getInterna()
    {
        return $this->interna;
    }

    public function setInterna($interna)
    {
        $this->interna = $interna;
    }

    public function getIdHerdado()
    {
        return $this->idHerdado;
    }

    public function setIdHerdado($idHerdado)
    {
        $this->idHerdado = $idHerdado;
    }
}
