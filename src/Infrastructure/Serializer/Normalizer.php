<?php
namespace AGTI\Bling\Infrastructure\Serializer;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;

if (version_compare(_PS_VERSION_, '9', '<')) {
    class Normalizer
    {
        public static function buildObjectNormalizer()
        {
            $normalizer = new PropertyNormalizer(null, null, new ReflectionExtractor());

            $normalizer->setCircularReferenceHandler(function(){
                return -1;
            });

            return $normalizer;
        }
    }
} else {
    class Normalizer extends PropertyNormalizer
    {
        public static function buildObjectNormalizer()
        {
            $normalizer = new self(null, null, new ReflectionExtractor());

            return $normalizer;
        }

        public function normalize($object, $format = null, array $context = [])
        {
            $context[AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER] = function ($object) {
                return -1;
            };

            return parent::normalize($object, $format, $context);
        }
    }
}