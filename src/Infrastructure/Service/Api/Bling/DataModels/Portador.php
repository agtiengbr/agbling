<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Portador
{
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
