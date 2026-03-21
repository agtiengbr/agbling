<?php
namespace AGTI\Bling\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ProductAttribute
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_product_attribute", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $reference;


    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     */
    private $product;


    /**
     * @ORM\Column(type="string")
     */
    private $location;


    /**
     * @ORM\OnetoMany(targetEntity="ProductAttributeShop", cascade={"persist"}, mappedBy="productAttribute")
     */
    private $shops;


    /**
     * @ORM\OneToMany(targetEntity="ProductAttributeCombination", cascade={"persist"}, mappedBy="productAttribute")
     */
    private $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of reference
     */ 
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set the value of reference
     *
     * @return  self
     */ 
    public function setReference($reference)
    {
        $this->reference = $reference;

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
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * 
     */ 
    public function getShops()
    {
        return $this->shops;
    }

    /**
     * 
     * @return  self
     */ 
    public function setShops($shops)
    {
        $this->shops = $shops;

        return $this;
    }

    
    /**
     * Add shop.
     *
     * @return Attribute
     */
    public function addShop(ProductAttributeShop $shop)
    {
        $this->shops[] = $shop;

        return $this;
    }


    /**
     * Get the value of attributes
     */ 
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the value of attributes
     *
     * @return  self
     */ 
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function addAttribute(ProductAttributeCombination $comb)
    {
        $this->attributes->add( $comb);
    }


    public function removeAttribute(ProductAttributeCombination $comb)
    {
        $this->attributes->remove( $comb);
    }
}