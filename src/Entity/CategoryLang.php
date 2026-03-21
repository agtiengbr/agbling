<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class CategoryLang
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     */
    private $category;

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
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

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
}