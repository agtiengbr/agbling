<?php
namespace AGTI\Bling\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Attribute
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_attribute", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AttributeGroup", inversedBy="attributes")
     * @ORM\JoinColumn(name="id_attribute_group", referencedColumnName="id_attribute_group", nullable=false)
     */
    private $attributeGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=32)
     */
    private $color;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\ManyToMany(targetEntity="Shop", cascade={"persist"})
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="id_attribute", referencedColumnName="id_attribute")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_shop", referencedColumnName="id_shop", onDelete="CASCADE")}
     * )
     */
    private $shops;

    /**
     * @ORM\OneToMany(targetEntity="AttributeLang", mappedBy="attribute", cascade={"persist"})
     */
    private $attributeLangs;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->shops = new ArrayCollection();
        $this->attributeLangs = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set color.
     *
     * @param string $color
     *
     * @return Attribute
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set position.
     *
     * @param int $position
     *
     * @return Attribute
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set attributeGroup.
     *
     * @param \PrestaShopBundle\Entity\AttributeGroup $attributeGroup
     *
     * @return Attribute
     */
    public function setAttributeGroup(AttributeGroup $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;

        return $this;
    }

    /**
     * Get attributeGroup.
     *
     * @return \PrestaShopBundle\Entity\AttributeGroup
     */
    public function getAttributeGroup()
    {
        return $this->attributeGroup;
    }

    /**
     * Add shop.
     *
     * @param \PrestaShopBundle\Entity\Shop $shop
     *
     * @return Attribute
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

    /**
     * Get shops.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShops()
    {
        return $this->shops;
    }

    public function addAttributeLang(AttributeLang $attributeLang)
    {
        $this->attributeLangs[] = $attributeLang;

        $attributeLang->setAttribute($this);

        return $this;
    }

    public function removeAttributeLang(AttributeLang $attributeLang)
    {
        $this->attributeLangs->removeElement($attributeLang);
    }

    public function getAttributeLangs()
    {
        return $this->attributeLangs;
    }
}
