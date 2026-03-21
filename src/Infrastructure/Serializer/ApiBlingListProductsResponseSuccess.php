<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts\ListProductsResponseSuccess;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Product as ApiProduct;

class ApiBlingListProductsResponseSuccess implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $n = Normalizer::buildObjectNormalizer();
        $s = Serializer::buildSerializer();
        
        $obj = $n->denormalize($data, $type, $format, $context);

        $ret = [];
        foreach ($obj->getData() as $apiProd)  {
            $ret[] = $s->denormalize($apiProd, ApiProduct::class, $format, $context);
        }

        $obj->setData($ret);

        return $obj;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === ListProductsResponseSuccess::class;
    }
}