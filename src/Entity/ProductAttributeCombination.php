<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ProductAttributeCombination
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="ProductAttribute")
     * @ORM\JoinColumn(name="id_product_attribute", referencedColumnName="id_product_attribute")
     */
    private $productAttribute;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Attribute")
     * @ORM\JoinColumn(name="id_attribute", referencedColumnName="id_attribute")
     */
    private $attribute;

    /**
     * Get the value of productAttribute
     *
     * @return  int
     */ 
    public function getProductAttribute()
    {
        return $this->productAttribute;
    }

    /**
     * Set the value of productAttribute
     *
     * @param  int  $productAttribute
     *
     * @return  self
     */ 
    public function setProductAttribute($productAttribute)
    {
        $this->productAttribute = $productAttribute;

        return $this;
    }

    /**
     * Get the value of attribute
     *
     * @return  int
     */ 
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set the value of attribute
     *
     * @param  int  $attribute
     *
     * @return  self
     */ 
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;

        return $this;
    }
}