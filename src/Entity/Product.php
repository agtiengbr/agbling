<?php
namespace AGTI\Bling\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id_product")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="reference")
     */
    private $reference;

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
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="ProductLang", mappedBy="product", cascade={"persist"})
     */
    private $langs;


    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $width;
    
    /**
     * @ORM\Column(type="float")
     */
    private $height;
    
    /**
     * @ORM\Column(type="float")
     */
    private $depth;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="id_category_default", referencedColumnName="id_category")
     */
    private $defaultCategory;

    /**
     * @ORM\OneToMany(targetEntity="CategoryProduct", mappedBy="product")
     */
    private $categories;
    
    
    public function __construct()
    {
        $this->langs = new ArrayCollection;
        $this->categories = new ArrayCollection;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
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
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
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
     * Get the value of langs
     */ 
    public function getLangs()
    {
        return $this->langs;
    }

    /**
     * Set the value of langs
     *
     * @return  self
     */ 
    public function setLangs($langs)
    {
        $this->langs = $langs;

        return $this;
    }

    /**
     * Get the value of depth
     */ 
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set the value of depth
     *
     * @return  self
     */ 
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of width
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */ 
    public function setWidth($width)
    {
        $this->width = $width;

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

    /**
     * Get the value of weight
     */ 
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */ 
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get the value of categories
     */ 
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set the value of categories
     *
     * @return  self
     */ 
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get the value of defaultCategory
     */ 
    public function getDefaultCategory()
    {
        return $this->defaultCategory;
    }

    /**
     * Set the value of defaultCategory
     *
     * @return  self
     */ 
    public function setDefaultCategory($defaultCategory)
    {
        $this->defaultCategory = $defaultCategory;

        return $this;
    }
}