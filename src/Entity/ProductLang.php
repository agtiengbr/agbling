<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class ProductLang
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     */
    private $product;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id_lang")
     */
    private $lang;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $linkRewrite;

    /**
     * @ORM\Column(type="string")
     */
    private $descriptionShort;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lang
     */ 
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set the value of lang
     *
     * @return  self
     */ 
    public function setLang($lang)
    {
        $this->lang = $lang;

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
     * Get the value of linkRewrite
     */ 
    public function getLinkRewrite()
    {
        return $this->linkRewrite;
    }

    /**
     * Set the value of linkRewrite
     *
     * @return  self
     */ 
    public function setLinkRewrite($linkRewrite)
    {
        $this->linkRewrite = $linkRewrite;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * Get the value of descriptionShort
     */ 
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }

    /**
     * Set the value of descriptionShort
     *
     * @return  self
     */ 
    public function setDescriptionShort($descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;

        return $this;
    }
}