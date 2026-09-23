<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;
use AGTI\Bling\Application\Exception\HttpCodeException;

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

        throw new HttpCodeException('Falha ao consultar contatos no Bling.', (int) $r->getHttpCode());
    }
}
