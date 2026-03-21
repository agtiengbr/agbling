<?php
namespace AGTI\IoPay\Infrastructure\Serializer;

use AGTI\IoPay\ValueObject\Shipping;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ShippingNormalizer implements NormalizerInterface
{

    public function normalize($object, $format = null, array $context = [])
    {
        $normalizer = Normalizer::buildObjectNormalizer();
        $normalizer->setSerializer(Serializer::buildSerializer());

        $data = $normalizer->normalize($object, $format, $context);

        //customiza o estado
        $data['address_1'] = $data['address1'];
        $data['address_2'] = $data['address2'];
        $data['address_3'] = $data['address3'];
        
        unset($data['address1']);
        unset($data['address2']);
        unset($data['address3']);

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Shipping;
    }

}