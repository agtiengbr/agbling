<?php

namespace AGTI\Bling\Infrastructure\Mapping;

use AGTI\Cliente\Mapping\IEMapping as MappingIEMapping;

class IEMapping extends MappingIEMapping
{
    protected $configName = 'agbling_ie';

    public function isMappingEnabled()
    {
        return $this->getMappedValue() != 'mapping_disabled' && $this->getMappedValue() != '';
    }
}