<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos\ListOrdersResponse;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts\ListProductsResponseSuccess;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ApiBlingListOrdersResponseSuccess implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $n = Normalizer::buildObjectNormalizer();
        $s = Serializer::buildSerializer();
        
        $obj = $n->denormalize($data, $type, $format, $context);

        $ret = [];
        foreach ($obj->getData() as $apiOrder)  {
            $ret[] = $s->denormalize($apiOrder, Order::class, $format, $context);
        }

        $obj->setData($ret);

        return $obj;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === ListOrdersResponse::class;
    }
}