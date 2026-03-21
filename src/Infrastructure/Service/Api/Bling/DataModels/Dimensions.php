<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Dimensions
{
    private $largura;
    private $altura;
    private $profundidade;
    private $unidadeMedida;

    /**
     * Get the value of unidadeMedida
     */ 
    public function getUnidadeMedida()
    {
        return $this->unidadeMedida;
    }

    /**
     * Set the value of unidadeMedida
     *
     * @return  self
     */ 
    public function setUnidadeMedida($unidadeMedida)
    {
        $this->unidadeMedida = $unidadeMedida;

        return $this;
    }

    /**
     * Get the value of profundidade
     */ 
    public function getProfundidade()
    {
        return $this->profundidade;
    }

    /**
     * Set the value of profundidade
     *
     * @return  self
     */ 
    public function setProfundidade($profundidade)
    {
        $this->profundidade = $profundidade;

        return $this;
    }

    /**
     * Get the value of altura
     */ 
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set the value of altura
     *
     * @return  self
     */ 
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get the value of largura
     */ 
    public function getLargura()
    {
        return $this->largura;
    }

    /**
     * Set the value of largura
     *
     * @return  self
     */ 
    public function setLargura($largura)
    {
        $this->largura = $largura;

        return $this;
    }
}