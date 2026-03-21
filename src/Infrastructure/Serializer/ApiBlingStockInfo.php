<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\StockInfo;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Warehouse;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque\ListaEstoquesResponseSuccess;

class ApiBlingStockInfo implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $n = Normalizer::buildObjectNormalizer();
        $s = Serializer::buildSerializer();
        $n->setSerializer($s);
        
        $obj = $n->denormalize($data, $type, $format, $context);

        $ret = [];
        foreach ($obj->getDepositos() as $deposito)  {
            $ret[] = $s->denormalize($deposito, Warehouse::class, $format, $context);
        }

        $obj->setDepositos($ret);

        return $obj;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === StockInfo::class;
    }
}