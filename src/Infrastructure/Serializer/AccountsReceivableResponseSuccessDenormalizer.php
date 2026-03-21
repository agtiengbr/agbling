<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\AccountsReceivable;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\AccountsReceivableResponseSuccess;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AccountsReceivableResponseSuccessDenormalizer implements DenormalizerInterface
{
    private $objectNormalizer;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $this->objectNormalizer = Normalizer::buildObjectNormalizer();
        $this->objectNormalizer->setSerializer(Serializer::buildSerializer());

        $response = $this->objectNormalizer->denormalize($data, $class, $format, $context);
        $accountsReceivable = [];

        foreach ($data['data'] as $item) {
            $accountsReceivable[] = $this->objectNormalizer->denormalize($item, AccountsReceivable::class, $format, $context);
        }

        $response->setData($accountsReceivable);
        return $response;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === AccountsReceivableResponseSuccess::class;
    }
}
