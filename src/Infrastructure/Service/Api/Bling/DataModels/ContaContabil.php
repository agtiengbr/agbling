<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class ContaContabil
{
    private $id;
    private $descricao;
    private $tipo;
    private $aliasIntegracao;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getAliasIntegracao()
    {
        return $this->aliasIntegracao;
    }

    public function setAliasIntegracao($aliasIntegracao)
    {
        $this->aliasIntegracao = $aliasIntegracao;
        return $this;
    }
}
