<?php

namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class OrderStateLang
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idOrderState;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idLang;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $template;

    /**
     * @ORM\ManyToOne(targetEntity="OrderState", inversedBy="langs")
     * @ORM\JoinColumn(name="id_order_state", referencedColumnName="id_order_state")
     */
    private $orderState;

    // Getters and Setters
    public function getIdOrderState()
    {
        return $this->idOrderState;
    }

    public function setIdOrderState($idOrderState)
    {
        $this->idOrderState = $idOrderState;
    }

    public function getIdLang()
    {
        return $this->idLang;
    }

    public function setIdLang($idLang)
    {
        $this->idLang = $idLang;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getOrderState()
    {
        return $this->orderState;
    }

    public function setOrderState($orderState)
    {
        $this->orderState = $orderState;
    }
}
