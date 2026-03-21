<?php

namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class OrderState
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOrderState;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sendEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $moduleName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $invoice;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $color;

    /**
     * @ORM\Column(type="boolean")
     */
    private $logable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $shipped;

    /**
     * @ORM\Column(type="boolean")
     */
    private $unremovable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delivery;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hidden;

    /**
     * @ORM\Column(type="boolean")
     */
    private $paid;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pdfInvoice;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pdfDelivery;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\OneToMany(targetEntity="OrderStateLang", mappedBy="orderState")
     */
    private $langs;

    public function __construct()
    {
        $this->langs = new ArrayCollection();
    }

    // Getters and Setters
    public function getIdOrderState()
    {
        return $this->idOrderState;
    }

    public function getSendEmail()
    {
        return $this->sendEmail;
    }

    public function setSendEmail($sendEmail)
    {
        $this->sendEmail = $sendEmail;
    }

    public function getModuleName()
    {
        return $this->moduleName;
    }

    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getLogable()
    {
        return $this->logable;
    }

    public function setLogable($logable)
    {
        $this->logable = $logable;
    }

    public function getShipped()
    {
        return $this->shipped;
    }

    public function setShipped($shipped)
    {
        $this->shipped = $shipped;
    }

    public function getUnremovable()
    {
        return $this->unremovable;
    }

    public function setUnremovable($unremovable)
    {
        $this->unremovable = $unremovable;
    }

    public function getDelivery()
    {
        return $this->delivery;
    }

    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    }

    public function getHidden()
    {
        return $this->hidden;
    }

    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    public function getPaid()
    {
        return $this->paid;
    }

    public function setPaid($paid)
    {
        $this->paid = $paid;
    }

    public function getPdfInvoice()
    {
        return $this->pdfInvoice;
    }

    public function setPdfInvoice($pdfInvoice)
    {
        $this->pdfInvoice = $pdfInvoice;
    }

    public function getPdfDelivery()
    {
        return $this->pdfDelivery;
    }

    public function setPdfDelivery($pdfDelivery)
    {
        $this->pdfDelivery = $pdfDelivery;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    public function getLangs()
    {
        return $this->langs;
    }

    public function addLang(OrderStateLang $lang)
    {
        $this->langs[] = $lang;
        $lang->setOrderState($this);
    }

    public function getLangById($idLang)
    {
        foreach ($this->langs as $lang) {
            if ($lang->getIdLang() == $idLang) {
                return $lang;
            }
        }
        return null;
    }
}
