<?php

namespace AGTI\Bling\Infrastructure\Mapping;

use AGTI\Cliente\Mapping\CarrierMapping as MappingCarrierMapping;

class CarrierMapping extends MappingCarrierMapping
{
    protected $configName = 'agbling_default_carrier';

    public function __construct()
    {
        $this->setLabel("Transportadora Padrão");
    }
}