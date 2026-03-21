<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\CreateContact;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;

class CreateContactService extends BaseService
{
    public function getApiEndpoint()
    {
        return "contatos";
    }

    public function exec(Contact $contact)
    {
        $this->send("POST", [], $this->getSerializer()->serialize($contact, 'json'));
    }
}