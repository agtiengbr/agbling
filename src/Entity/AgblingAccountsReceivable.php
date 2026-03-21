<?php

namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AGTI\Bling\Repository\AgblingAccountsReceivableRepository")
 * @ORM\Table()
 */
class AgblingAccountsReceivable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $blingId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataEmissao;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataVencimento;

    /**
     * @ORM\Column(type="integer")
     */
    private $situacao;

    /**
     * @ORM\ManyToOne(targetEntity="AGTI\Bling\Entity\AgblingOrder")
     * @ORM\JoinColumn(name="id_bling_order", referencedColumnName="id_agbling_order")
     */
    private $blingOrder;

    public function getId()
    {
        return $this->id;
    }

    public function getBlingId()
    {
        return $this->blingId;
    }

    public function setBlingId($blingId)
    {
        $this->blingId = $blingId;
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

    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }

    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;
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

    public function getBlingOrder()
    {
        return $this->blingOrder;
    }

    public function setBlingOrder($blingOrder)
    {
        $this->blingOrder = $blingOrder;
        return $this;
    }
}
