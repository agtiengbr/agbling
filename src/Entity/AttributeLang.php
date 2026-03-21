<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributeLang.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class AttributeLang
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Attribute", inversedBy="attributeLangs")
     * @ORM\JoinColumn(name="id_attribute", referencedColumnName="id_attribute", nullable=false)
     */
    private $attribute;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->attribute;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return AttributeLang
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
     * Set attribute.
     *
     * @param \PrestaShopBundle\Entity\Attribute $attribute
     *
     * @return AttributeLang
     */
    public function setAttribute(Attribute $attribute)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute.
     *
     * @return \PrestaShopBundle\Entity\Attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set lang.
     *
     * @param Lang $lang
     *
     * @return AttributeLang
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
