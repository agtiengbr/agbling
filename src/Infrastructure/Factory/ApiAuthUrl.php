<?php
namespace AGTI\Bling\Infrastructure\Factory;

use AGTI\Bling\ValueObject\ApiToken;
use AGTI\Bling\ValueObject\ApiAuthUrl as ApiAuthUrlValueObject;
use AGTI\Bling\ValueObject\Configuration as VBConfiguration;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class ApiAuthUrl
{
    public static function getUrl(): ApiAuthUrlValueObject
    {
        return (new ApiAuthUrlValueObject())->setUrl("https://www.agti.eng.br/module/agblingintermediator/auth");
    }
}
