<?php
namespace AGTI\Bling\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ProductAttributeShop
{
     /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="ProductAttribute")
     * @ORM\JoinColumn(name="id_product_attribute", referencedColumnName="id_product_attribute")
     */
    private $productAttribute;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Shop")
     * @ORM\JoinColumn(name="id_shop", referencedColumnName="id_shop")
     */
    private $shop;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     */
    private $product;


    /**
     * Get the value of productAttribute
     */ 
    public function getProductAttribute()
    {
        return $this->productAttribute;
    }

    /**
     * Set the value of productAttribute
     *
     * @return  self
     */ 
    public function setProductAttribute($productAttribute)
    {
        $this->productAttribute = $productAttribute;

        return $this;
    }

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
}