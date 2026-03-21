<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class FormaPagamento
{
    private $id;
    private $codigoFiscal;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getCodigoFiscal()
    {
        return $this->codigoFiscal;
    }

    public function setCodigoFiscal($codigoFiscal)
    {
        $this->codigoFiscal = $codigoFiscal;
        return $this;
    }
}
