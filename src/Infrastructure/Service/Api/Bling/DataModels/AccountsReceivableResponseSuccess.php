<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class AccountsReceivableResponseSuccess
{
    private $data;

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }
}
