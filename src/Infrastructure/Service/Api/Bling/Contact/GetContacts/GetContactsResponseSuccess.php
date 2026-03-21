<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;

class GetContactsResponseSuccess
{
    /** @var Contact[] */
    private $data;

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}