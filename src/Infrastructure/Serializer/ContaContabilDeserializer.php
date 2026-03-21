<?php

namespace AGTI\Bling\Infrastructure\Serializer;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContaContabil;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ContaContabilDeserializer implements DenormalizerInterface
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $contasContabeis = [];
        foreach ($data['data'] as $item) {
            $contaContabil = new ContaContabil();
            $contaContabil->setId($item['id']);
            $contaContabil->setDescricao($item['descricao']);
            $contaContabil->setTipo($item['tipo']);
            $contaContabil->setAliasIntegracao($item['aliasIntegracao']);
            $contasContabeis[] = $contaContabil;
        }
        return $contasContabeis;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'array<' . ContaContabil::class . '>';
    }
}
