<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Contact
{
    private $id;
    private $numeroDocumento;


    private $nome;
    private $codigo;
    private $situacao;
    private $telefone;
    private $celular;
    private $fantasia;
    private $tipo;
    private $indicadorIe;
    private $ie;
    private $rg;
    private $orgaoEmissor;
    private $email;
    private $endereco;
    private $vendedor;
    private $dadosAdicionais;
    // private $financeiro;
    // private $pais;
    // private $tiposContato;
    // private $pessoasContato;
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
     * Get the value of numeroDocumento
     */ 
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set the value of numeroDocumento
     *
     * @return  self
     */ 
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of celular
     */ 
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set the value of celular
     *
     * @return  self
     */ 
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get the value of fantasia
     */ 
    public function getFantasia()
    {
        return $this->fantasia;
    }

    /**
     * Set the value of fantasia
     *
     * @return  self
     */ 
    public function setFantasia($fantasia)
    {
        $this->fantasia = $fantasia;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of indicadorIe
     */ 
    public function getIndicadorIe()
    {
        return $this->indicadorIe;
    }

    /**
     * Set the value of indicadorIe
     *
     * @return  self
     */ 
    public function setIndicadorIe($indicadorIe)
    {
        $this->indicadorIe = $indicadorIe;

        return $this;
    }

    /**
     * Get the value of ie
     */ 
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * Set the value of ie
     *
     * @return  self
     */ 
    public function setIe($ie)
    {
        $this->ie = $ie;

        return $this;
    }

    /**
     * Get the value of rg
     */ 
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set the value of rg
     *
     * @return  self
     */ 
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get the value of orgaoEmissor
     */ 
    public function getOrgaoEmissor()
    {
        return $this->orgaoEmissor;
    }

    /**
     * Set the value of orgaoEmissor
     *
     * @return  self
     */ 
    public function setOrgaoEmissor($orgaoEmissor)
    {
        $this->orgaoEmissor = $orgaoEmissor;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of situacao
     */ 
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set the value of situacao
     *
     * @return  self
     */ 
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
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
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */ 
    public function setEndereco(ContactAddress $endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of vendedor
     */ 
    public function getVendedor()
    {
        return $this->vendedor;
    }

    /**
     * Set the value of vendedor
     *
     * @return  self
     */ 
    public function setVendedor(Seller $vendedor)
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    /**
     * Get the value of dadosAdicionais
     */ 
    public function getDadosAdicionais()
    {
        return $this->dadosAdicionais;
    }

    /**
     * Set the value of dadosAdicionais
     *
     * @return  self
     */ 
    public function setDadosAdicionais(ContactExtraData $dadosAdicionais)
    {
        $this->dadosAdicionais = $dadosAdicionais;

        return $this;
    }
}