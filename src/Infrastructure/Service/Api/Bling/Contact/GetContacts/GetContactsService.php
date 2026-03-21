<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;

class GetContactsService extends BaseService
{
    public function getApiEndpoint()
    {
        return "contatos";
    }

    public function exec(GetContactsSearchArgs $args)
    {
        $r = $this->send("GET", $this->getSerializer()->normalize($args));

        if ($r->getHttpCode() == 200) {
            return $this->getSerializer()->deserialize($r->getResponse(), GetContactsResponseSuccess::class, 'json');
        }

        dump($r);
        exit();
    }
}