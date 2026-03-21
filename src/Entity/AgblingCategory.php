<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class AgblingCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id_agbling_category")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="id_bling")
     */
    private $remoteId;

    /**
     * @ORM\ManyToOne(targetEntity="AgblingCategory")
     * @ORM\JoinColumn(name="id_bling_parent_category", referencedColumnName="id_agbling_category")
     */
    private $parentCategory;

    /**
     * @ORM\OneToOne(targetEntity="Category", cascade={"persist"})
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     */
    private $psCategory;

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
     * Get the value of remoteId
     */ 
    public function getRemoteId()
    {
        return $this->remoteId;
    }

    /**
     * Set the value of remoteId
     *
     * @return  self
     */ 
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;

        return $this;
    }

    /**
     * Get the value of parentCategory
     */ 
    public function getParentCategory()
    {
        return $this->parentCategory;
    }

    /**
     * Set the value of parentCategory
     *
     * @return  self
     */ 
    public function setParentCategory($parentCategory)
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }

    /**
     * Get the value of psCategory
     */ 
    public function getPsCategory()
    {
        return $this->psCategory;
    }

    /**
     * Set the value of psCategory
     *
     * @return  self
     */ 
    public function setPsCategory($psCategory)
    {
        $this->psCategory = $psCategory;

        return $this;
    }
}