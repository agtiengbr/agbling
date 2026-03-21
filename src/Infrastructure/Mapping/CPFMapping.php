<?php

namespace AGTI\Bling\Infrastructure\Mapping;

use AGTI\Cliente\Mapping\CPFMapping as MappingCPFMapping;

class CPFMapping extends MappingCPFMapping
{
    protected $configName = 'agbling_cpf';

    public function isMappingEnabled()
    {
        return $this->getMappedValue() != 'mapping_disabled' && $this->getMappedValue() != '';
    }
}