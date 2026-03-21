<?php
namespace AGTI\Bling\Infrastructure\Serializer;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;

class Serializer
{
    public static function buildSerializer()
    {
        $encoders = [new JsonEncoder(), new XmlEncoder()];

        $normalizers = [
            new DateTimeNormalizer(),
            new ApiBlingListProductsResponseSuccess,
            new ApiBlingListProductsCategoriesResponseSuccess,
            new ApiBlingListStockResponseSuccess,
            new ApiBlingStockInfo,
            new ApiBlingProduct,
            new ApiBlingListContactsResponseSuccess,
            new ApiBlingCreateOrderResponseSuccess,
            new ApiBlingGetPaymentModesResponseSuccess,
            new AccountsReceivableResponseSuccessDenormalizer(),
            new ContaContabilDeserializer,
            new ApiBlingListOrdersResponseSuccess,
            Normalizer::buildObjectNormalizer(),
            new ArrayDenormalizer
        ];
        $serializer = new SymfonySerializer($normalizers, $encoders);

        return $serializer;
    }
}