<?php
namespace AGTI\Bling\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table
 * @ORM\Entity
 */
class AttributeGroup
{
     /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_attribute_group", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_color_group", type="boolean")
     */
    private $isColorGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="group_type", type="string", length=255)
     */
    private $groupType;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Attribute", mappedBy="attributeGroup", orphanRemoval=true)
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="Shop", cascade={"persist"})
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="id_attribute_group", referencedColumnName="id_attribute_group")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_shop", referencedColumnName="id_shop", onDelete="CASCADE")}
     * )
     */
    private $shops;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AttributeGroupLang", mappedBy="attributeGroup", cascade={"persist"})
     */
    private $attributeGroupLangs;

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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of isColorGroup
     *
     * @return  bool
     */ 
    public function getIsColorGroup()
    {
        return $this->isColorGroup;
    }

    /**
     * Set the value of isColorGroup
     *
     * @param  bool  $isColorGroup
     *
     * @return  self
     */ 
    public function setIsColorGroup($isColorGroup)
    {
        $this->isColorGroup = $isColorGroup;

        return $this;
    }

    /**
     * Get the value of groupType
     *
     * @return  string
     */ 
    public function getGroupType()
    {
        return $this->groupType;
    }

    /**
     * Set the value of groupType
     *
     * @param  string  $groupType
     *
     * @return  self
     */ 
    public function setGroupType($groupType)
    {
        $this->groupType = $groupType;

        return $this;
    }

    /**
     * Get the value of position
     *
     * @return  int
     */ 
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @param  int  $position
     *
     * @return  self
     */ 
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get the value of attributes
     *
     * @return  ArrayCollection
     */ 
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the value of attributes
     *
     * @param  ArrayCollection  $attributes
     *
     * @return  self
     */ 
    public function setAttributes(ArrayCollection $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function addAttributeGroupLang(AttributeGroupLang $attributeGroupLang)
    {
        $this->attributeGroupLangs[] = $attributeGroupLang;

        $attributeGroupLang->setAttributeGroup($this);

        return $this;
    }

    public function removeAttributeGroupLang(AttributeGroupLang $attributeGroupLang)
    {
        $this->attributeGroupLangs->removeElement($attributeGroupLang);
    }

        /**
     * Add shop.
     *
     * @param \PrestaShopBundle\Entity\Shop $shop
     *
     * @return AttributeGroup
     */
    public function addShop(Shop $shop)
    {
        $this->shops[] = $shop;

        return $this;
    }

    /**
     * Remove shop.
     *
     * @param \PrestaShopBundle\Entity\Shop $shop
     */
    public function removeShop(Shop $shop)
    {
        $this->shops->removeElement($shop);
    }

}