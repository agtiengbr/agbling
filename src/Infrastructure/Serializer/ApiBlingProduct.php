<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Product;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Image;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Dimensions;

class ApiBlingProduct implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $n = Normalizer::buildObjectNormalizer();
        $s = Serializer::buildSerializer();
        $n->setSerializer($s);
        
        $obj = $n->denormalize($data, $type, $format, $context);

        $ret = [];

        if (is_array($obj->getImagens())) {
            foreach ($obj->getImagens() as $image)  {
                $ret[] = $s->denormalize($image, Image::class, $format, $context);
            }
        }
        
        $obj->setImagens($ret);
        $obj->setDimensoes($n->denormalize($obj->getDimensoes(), Dimensions::class, $format, $context));

        return $obj;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === Product::class;
    }
}