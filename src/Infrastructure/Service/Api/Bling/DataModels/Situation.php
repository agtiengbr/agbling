<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Situation
{
    private $id;
    private $nome;
    private $idHerdado;
    private $cor;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getIdHerdado()
    {
        return $this->idHerdado;
    }

    public function getCor()
    {
        return $this->cor;
    }
}
