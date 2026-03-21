<?php
namespace AGTI\Bling\Infrastructure\Factory;

use AGTI\Bling\ValueObject\Configuration;

class Token
{
    public static function getToken(Configuration $conf)
    {
        if ($conf->getToken() != null && $conf->getToken()->getExpirationDate() && new \DateTime($conf->getToken()->getExpirationDate()) > new \DateTime) {
            return $conf->getToken();
        }

    }
}