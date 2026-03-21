<?php

namespace AGTI\Bling\Infrastructure\Mapping;

use AGTI\Cliente\Mapping\PersonTypeMapping as MappingPersonTypeMapping;

class PersonTypeMapping extends MappingPersonTypeMapping
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setConfigName('agbling_person_type');        
    }
}