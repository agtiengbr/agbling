<?php

namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class AgBlingOrderState
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idModuloSistema;

    /**
     * @ORM\Column(type="integer")
     */
    private $idEmpresa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $cor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $interna;

    /**
     * @ORM\Column(type="integer")
     */
    private $idHerdado;

    /**
     * @ORM\Column(type="integer")
     */
    private $idRemote;

    public function getId()
    {
        return $this->id;
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

    public function getIdRemote()
    {
        return $this->idRemote;
    }

    public function setIdRemote($idRemote)
    {
        $this->idRemote = $idRemote;
    }
}
