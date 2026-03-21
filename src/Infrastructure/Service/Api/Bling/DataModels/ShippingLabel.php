<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class ShippingLabel
{
    /**
     * @var string|null
     */
    private $nome;

    /**
     * @var string|null
     */
    private $endereco;

    /**
     * @var string|null
     */
    private $numero;

    /**
     * @var string|null
     */
    private $complemento;

    /**
     * @var string|null
     */
    private $municipio;

    /**
     * @var string|null
     */
    private $uf;

    /**
     * @var string|null
     */
    private $cep;

    /**
     * @var string|null
     */
    private $bairro;

    /**
     * @var string|null
     */
    private $nomePais;


    /**
     * Get the value of nome
     *
     * @return  string|null
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @param  string|null  $nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of endereco
     *
     * @return  string|null
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @param  string|null  $endereco
     *
     * @return  self
     */ 
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of numero
     *
     * @return  string|null
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @param  string|null  $numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of complemento
     *
     * @return  string|null
     */ 
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @param  string|null  $complemento
     *
     * @return  self
     */ 
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get the value of municipio
     *
     * @return  string|null
     */ 
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @param  string|null  $municipio
     *
     * @return  self
     */ 
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get the value of uf
     *
     * @return  string|null
     */ 
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set the value of uf
     *
     * @param  string|null  $uf
     *
     * @return  self
     */ 
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get the value of cep
     *
     * @return  string|null
     */ 
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @param  string|null  $cep
     *
     * @return  self
     */ 
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of bairro
     *
     * @return  string|null
     */ 
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @param  string|null  $bairro
     *
     * @return  self
     */ 
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of nomePais
     *
     * @return  string|null
     */ 
    public function getNomePais()
    {
        return $this->nomePais;
    }

    /**
     * Set the value of nomePais
     *
     * @param  string|null  $nomePais
     *
     * @return  self
     */ 
    public function setNomePais($nomePais)
    {
        $this->nomePais = $nomePais;

        return $this;
    }
}