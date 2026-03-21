<?php

namespace AGTI\Bling\Infrastructure\Serializer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use AGTI\Bling\Infrastructure\Service\Api\Bling\PaymentModes\GetPaymentModes\GetPaymentModesResponseSuccess;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\PaymentMode;

class ApiBlingGetPaymentModesResponseSuccess implements DenormalizerInterface
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer([$normalizer]);

        $r = $serializer->denormalize($data, GetPaymentModesResponseSuccess::class, 'json');
        $data = $r->getData();

        $paymentModes = [];
        foreach ($data as $paymentMode) {
            $paymentModes[] = $serializer->denormalize($paymentMode, PaymentMode::class, 'json');
        }

        $data = $paymentModes;
        $r->setData($data);
        return $r;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === GetPaymentModesResponseSuccess::class;
    }
}