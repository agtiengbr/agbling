<?php

namespace AGTI\Bling\Infrastructure\Mapping;

use AGTI\Cliente\Mapping\CNPJMapping as MappingCNPJMapping;

class CNPJMapping extends MappingCNPJMapping
{
    protected $configName = 'agbling_cnpj';

    public function isMappingEnabled()
    {
        return $this->getMappedValue() != 'mapping_disabled' && $this->getMappedValue() != '';
    }
}