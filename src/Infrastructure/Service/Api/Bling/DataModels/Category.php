<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Category
{
    private $id;
    private $descricao;
    private $categoriaPai;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of categoriaPai
     */ 
    public function getCategoriaPai()
    {
        return $this->categoriaPai;
    }

    /**
     * Set the value of categoriaPai
     *
     * @return  self
     */ 
    public function setCategoriaPai(Category $categoriaPai)
    {
        $this->categoriaPai = $categoriaPai;

        return $this;
    }
}