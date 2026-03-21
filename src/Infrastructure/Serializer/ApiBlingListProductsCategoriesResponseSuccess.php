<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Category as ApiCategory;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\ListCategories\ListProductsCategoriesResponseSuccess; 

class ApiBlingListProductsCategoriesResponseSuccess implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $n = Normalizer::buildObjectNormalizer();
        $s = Serializer::buildSerializer();
        
        $obj = $n->denormalize($data, $type, $format, $context);

        $ret = [];
        foreach ($obj->getData() as $apiProd)  {
            $ret[] = $s->denormalize($apiProd, ApiCategory::class, $format, $context);
        }

        $obj->setData($ret);

        return $obj;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === ListProductsCategoriesResponseSuccess::class;
    }
}