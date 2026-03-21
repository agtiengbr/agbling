<?php
namespace AGTI\Bling\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id_category")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idParent;

    /**
     * @ORM\OneToMany(targetEntity="CategoryLang", mappedBy="category", cascade={"persist"})
     */
    private $langs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAdd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateUpd;

    public function __construct()
    {
        $this->langs = new ArrayCollection;
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

    public function addLang(CategoryLang $lang)
    {
        $this->langs->add($lang);
    }

    /**
     * Get the value of idParent
     */ 
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Set the value of idParent
     *
     * @return  self
     */ 
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;

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

}