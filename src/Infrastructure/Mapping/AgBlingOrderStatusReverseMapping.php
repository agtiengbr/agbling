<?php
/** 
 * Classe responsável pelo mapeamento dos estados DO PS para os do Bling.
 */

namespace AGTI\Bling\Infrastructure\Mapping;

use AGTI\Bling\Enum\BlingOrderStatus;
use AGTI\Cliente\Mapping\MappingInterface;

class AgBlingOrderStatusReverseMapping implements MappingInterface
{
    protected $configName;
    protected $label;
    
    public function isMultiple()
    {
        return false;
    }
    
    public function getOptionsForSelect()
    {
        $items = $this->getAvailableOptions();

        $return = [['id' => -1, 'name' => 'Mapeamento Desativado']];
        foreach ($items as $value) {
            $return[] = [
                'id' => $value['id'],
                'name' => $value['name']
            ];
        }

        return $return;
    }

    public function getAvailableOptions()
    {
        $statuses = BlingOrderStatus::getAllCodes();
        
        $ret = [];

        foreach ($statuses as $status) {
            $ret[] = [
                'id' => $status,
                'name' => BlingOrderStatus::getName($status)
            ];
        }

        return $ret;
    }

    public function getMappedValue()
    {
        return \Configuration::get($this->getConfigName());
    }

    function getValue(...$key)
    {
        return $this->getMappedValue();
    }

    public function mapsTo($value)
    {
        \Configuration::updateValue($this->getConfigName(), $value);
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function getLabelForSelect()
    {
        return $this->label;
    }

    /**
     * Get the value of configName
     */ 
    public function getConfigName()
    {
        return $this->configName;
    }

    /**
     * Set the value of configName
     *
     * @return  self
     */ 
    public function setConfigName($configName)
    {
        $this->configName = $configName;

        return $this;
    }
}