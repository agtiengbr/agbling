<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

use DateTime;

class MarkAsPaidArgs
{
    private $id;
    private $data;
    private $usarDataVencimento;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(DateTime $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getUsarDataVencimento()
    {
        return $this->usarDataVencimento;
    }

    public function setUsarDataVencimento($usarDataVencimento)
    {
        $this->usarDataVencimento = $usarDataVencimento;
        return $this;
    }
}
