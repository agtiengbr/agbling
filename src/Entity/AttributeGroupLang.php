<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributeGroupLang.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class AttributeGroupLang
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AttributeGroup", inversedBy="attributeGroupLangs")
     * @ORM\JoinColumn(name="id_attribute_group", referencedColumnName="id_attribute_group", nullable=false, onDelete="CASCADE")
     */
    private $attributeGroup;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id_lang", nullable=false, onDelete="CASCADE")
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="public_name", type="string", length=64)
     */
    private $publicName;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->attributeGroup;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return AttributeGroupLang
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set publicName.
     *
     * @param string $publicName
     *
     * @return AttributeGroupLang
     */
    public function setPublicName($publicName)
    {
        $this->publicName = $publicName;

        return $this;
    }

    /**
     * Get publicName.
     *
     * @return string
     */
    public function getPublicName()
    {
        return $this->publicName;
    }

    /**
     * Set attributeGroup.
     *
     * @param \PrestaShopBundle\Entity\AttributeGroup $attributeGroup
     *
     * @return AttributeGroupLang
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
     * Set lang.
     *
     * @param Lang $lang
     *
     * @return AttributeGroupLang
     */
    public function setLang(Lang $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang.
     *
     * @return Lang
     */
    public function getLang()
    {
        return $this->lang;
    }
}
