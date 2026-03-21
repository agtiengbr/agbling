<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class ProductShop
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     */
    private $product;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Shop")
     * @ORM\JoinColumn(name="id_shop", referencedColumnName="id_shop")
     */
    private $shop;

    /**
     * @ORM\Column(type="integer")
     */
    private $idTaxRulesGroup;

        /**
     * @ORM\Column(type="datetime")
     */
    private $dateAdd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateUpd;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;


    /**
     * Get the value of shop
     */ 
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set the value of shop
     *
     * @return  self
     */ 
    public function setShop($shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get the value of product
     */ 
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @return  self
     */ 
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get the value of idTaxRulesGroup
     */ 
    public function getIdTaxRulesGroup()
    {
        return $this->idTaxRulesGroup;
    }

    /**
     * Set the value of idTaxRulesGroup
     *
     * @return  self
     */ 
    public function setIdTaxRulesGroup($idTaxRulesGroup)
    {
        $this->idTaxRulesGroup = $idTaxRulesGroup;

        return $this;
    }

    /**
     * Get the value of dateAdd
     */ 
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set the value of dateAdd
     *
     * @return  self
     */ 
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get the value of dateUpd
     */ 
    public function getDateUpd()
    {
        return $this->dateUpd;
    }

    /**
     * Set the value of dateUpd
     *
     * @return  self
     */ 
    public function setDateUpd($dateUpd)
    {
        $this->dateUpd = $dateUpd;

        return $this;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setDateAdd(new \DateTime);        
        $this->setDateUpd(new \DateTime);
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setDateUpd(new \DateTime);
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }
}