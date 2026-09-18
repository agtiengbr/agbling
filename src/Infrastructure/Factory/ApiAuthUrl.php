<?php
namespace AGTI\Bling\Infrastructure\Factory;

use AGTI\Bling\ValueObject\ApiToken;
use AGTI\Bling\ValueObject\Configuration as VBConfiguration;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class ApiAuthUrl
{
    public static function getUrl()
    {
        return "https://www.agti.eng.br/module/agblingintermediator/auth";
    }
}
