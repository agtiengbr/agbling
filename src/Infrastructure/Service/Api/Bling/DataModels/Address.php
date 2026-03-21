<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Address
{
    /**
     * @var string
     */
    private $endereco;
    
    /**
     * @var string
     */
    private $cep;
    
    /**
     * @var string
     */
    private $bairro;
    
    /**
     * @var string
     */
    private $municipio;
    
    /**
     * @var string
     */
    private $uf;
    
    /**
     * @var string
     */
    private $numero;
    
    /**
     * @var string
     */
    private $complemento;
    

    /**
     * Get the value of endereco
     *
     * @return  string
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @param  string  $endereco
     *
     * @return  self
     */ 
    public function setEndereco(string $endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of cep
     *
     * @return  string
     */ 
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @param  string  $cep
     *
     * @return  self
     */ 
    public function setCep(string $cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of bairro
     *
     * @return  string
     */ 
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @param  string  $bairro
     *
     * @return  self
     */ 
    public function setBairro(string $bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of municipio
     *
     * @return  string
     */ 
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @param  string  $municipio
     *
     * @return  self
     */ 
    public function setMunicipio(string $municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get the value of uf
     *
     * @return  string
     */ 
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set the value of uf
     *
     * @param  string  $uf
     *
     * @return  self
     */ 
    public function setUf(string $uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get the value of numero
     *
     * @return  string
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @param  string  $numero
     *
     * @return  self
     */ 
    public function setNumero(string $numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of complemento
     *
     * @return  string
     */ 
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @param  string  $complemento
     *
     * @return  self
     */ 
    public function setComplemento(string $complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }
}