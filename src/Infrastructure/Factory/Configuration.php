<?php
namespace AGTI\Bling\Infrastructure\Factory;

use AGTI\Bling\ValueObject\ApiToken;
use AGTI\Bling\ValueObject\Configuration as VBConfiguration;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class Configuration
{
    private static $cache;

    public static function getConfiguration(SerializerInterface $serializer)
    {
        if (self::$cache) {
            return self::$cache;
        }

        try {
            $ret = $serializer->deserialize(\Configuration::get("AGBLING_CONFIG")   , VBConfiguration::class, "json");
        } catch (NotEncodableValueException $e) {
            $ret = new VBConfiguration;
        }
        
        self::$cache = $ret;
        return $ret;
    }
}