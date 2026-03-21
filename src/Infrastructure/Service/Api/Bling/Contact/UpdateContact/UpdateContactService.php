<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\UpdateContact;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;
use AGTI\Bling\ValueObject\ApiToken;

class UpdateContactService extends BaseService
{
    /** @var int */
    private $id;

    public function getApiEndpoint()
    {
        return "contatos/{$this->id}";
    }

    public function exec(Contact $contact, $id, ApiToken $token)
    {
        $this->id = $id;

        $r = $this->send(
            "PUT",
            [],
            $this->getSerializer()->serialize($contact, 'json')
        );
    }
}