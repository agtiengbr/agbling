<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

use AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts\GetContactsResponseSuccess;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateOrder\CreateOrderResponseSuccess;

class ApiBlingCreateOrderResponseSuccess implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $n = Normalizer::buildObjectNormalizer();
        $s = Serializer::buildSerializer();
        
        $obj = $n->denormalize($data, $type, $format, $context);
        $ret = $s->denormalize($obj->getData(), Order::class, $format, $context);
        $obj->setData($ret);

        return $obj;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === CreateOrderResponseSuccess::class;
    }
}
