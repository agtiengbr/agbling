<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class ContactAddress
{
    /**
     * @var Address
     */
    private $geral;
    
    /**
     * @var Address
     */
    private $cobranca;
    


    /**
     * Get the value of geral
     *
     * @return  Address
     */ 
    public function getGeral()
    {
        return $this->geral;
    }

    /**
     * Set the value of geral
     *
     * @param  Address  $geral
     *
     * @return  self
     */ 
    public function setGeral(Address $geral)
    {
        $this->geral = $geral;

        return $this;
    }

    /**
     * Get the value of cobranca
     *
     * @return  Address
     */ 
    public function getCobranca()
    {
        return $this->cobranca;
    }

    /**
     * Set the value of cobranca
     *
     * @param  Address  $cobranca
     *
     * @return  self
     */ 
    public function setCobranca(Address $cobranca)
    {
        $this->cobranca = $cobranca;

        return $this;
    }
}