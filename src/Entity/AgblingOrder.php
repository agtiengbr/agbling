<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 */
class AgblingOrder
{
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id_agbling_order", type="integer")
     */
    private $id;

    /**
     * @var Orders
     * 
     * @ORM\OneToOne(targetEntity="Orders")
     * @ORM\JoinColumn(name="id_ps", referencedColumnName="id_order")
     */
    private $psOrder;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $idRemote;

    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $sendToBling;

    /**
     * @var AgblingAccountsReceivable[]
     * 
     * @ORM\OneToMany(targetEntity="AgblingAccountsReceivable", mappedBy="agblingOrder")
     */
    private $accountsReceivable;

    /**
     * Get the value of psOrder
     *
     * @return  Orders
     */ 
    public function getPsOrder()
    {
        return $this->psOrder;
    }

    /**
     * Set the value of psOrder
     *
     * @param  Orders  $psOrder
     *
     * @return  self
     */ 
    public function setPsOrder(Orders $psOrder)
    {
        $this->psOrder = $psOrder;

        return $this;
    }

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
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of idRemote
     *
     * @return  int
     */ 
    public function getIdRemote()
    {
        return $this->idRemote;
    }

    /**
     * Set the value of idRemote
     *
     * @param  int  $idRemote
     *
     * @return  self
     */ 
    public function setIdRemote(int $idRemote)
    {
        $this->idRemote = $idRemote;

        return $this;
    }

    /**
     * Get the value of sendToBling
     *
     * @return  boolean
     */ 
    public function getSendToBling()
    {
        return $this->sendToBling;
    }

    /**
     * Set the value of sendToBling
     *
     * @param  boolean  $sendToBling
     *
     * @return  self
     */ 
    public function setSendToBling($sendToBling)
    {
        $this->sendToBling = $sendToBling;

        return $this;
    }

    /**
     * Get the value of accountsReceivable
     *
     * @return AgblingAccountsReceivable[]
     */ 
    public function getAccountsReceivable()
    {
        return $this->accountsReceivable;
    }

    /**
     * Set the value of accountsReceivable
     *
     * @param AgblingAccountsReceivable[] $accountsReceivable
     *
     * @return self
     */ 
    public function setAccountsReceivable($accountsReceivable)
    {
        $this->accountsReceivable = $accountsReceivable;

        return $this;
    }
}