<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class AgblingProduct
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id_agbling_product")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $sku;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\Column(type="integer")
     */
    private $idRemote;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inPs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLastSync;


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
     * Get the value of sku
     */ 
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get the value of published
     */ 
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set the value of published
     *
     * @return  self
     */ 
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get the value of idRemote
     */ 
    public function getIdRemote()
    {
        return $this->idRemote;
    }

    /**
     * Set the value of idRemote
     *
     * @return  self
     */ 
    public function setIdRemote($idRemote)
    {
        $this->idRemote = $idRemote;

        return $this;
    }

    /**
     * Get the value of inPs
     */ 
    public function getInPs()
    {
        return $this->inPs;
    }

    /**
     * Set the value of inPs
     *
     * @return  self
     */ 
    public function setInPs($inPs)
    {
        $this->inPs = $inPs;

        return $this;
    }

    /**
     * Get the value of dateLastSync
     */ 
    public function getDateLastSync()
    {
        return $this->dateLastSync;
    }

    /**
     * Set the value of dateLastSync
     *
     * @return  self
     */ 
    public function setDateLastSync($dateLastSync)
    {
        $this->dateLastSync = $dateLastSync;

        return $this;
    }
}