<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Contact\GetContacts;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Contact;

class GetContactsSearchArgs
{
    /** @var int */
    private $pagina;

    /** @var int */
    private $limite;

    /** @var string */
    private $pesquisa;

    /** @var int */
    private $criterio;

    /** @var \DateTime */
    private $dataInclusaoInicial;

    /** @var \DateTime */
    private $dataInclusaoFinal;

    /** @var \DateTime */
    private $dataAlteracaoInicial;

    /** @var \DateTime */
    private $dataAlteracaoFinal;

    /** @var int */
    private $idTipoContato;

    /** @var int */
    private $idVendedor;

    /** @var string */
    private $uf;    
    
    /** @var string */
    private $telefone;

    /** @var int[] */
    private $idsContatos;

    /** @var string */
    private $numeroDocumento;

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
     * Get the value of idsContatos
     */ 
    public function getIdsContatos()
    {
        return $this->idsContatos;
    }

    /**
     * Set the value of idsContatos
     *
     * @return  self
     */ 
    public function setIdsContatos($idsContatos)
    {
        $this->idsContatos = $idsContatos;

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
     * Get the value of uf
     */ 
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set the value of uf
     *
     * @return  self
     */ 
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get the value of idVendedor
     */ 
    public function getIdVendedor()
    {
        return $this->idVendedor;
    }

    /**
     * Set the value of idVendedor
     *
     * @return  self
     */ 
    public function setIdVendedor($idVendedor)
    {
        $this->idVendedor = $idVendedor;

        return $this;
    }

    /**
     * Get the value of idTipoContato
     */ 
    public function getIdTipoContato()
    {
        return $this->idTipoContato;
    }

    /**
     * Set the value of idTipoContato
     *
     * @return  self
     */ 
    public function setIdTipoContato($idTipoContato)
    {
        $this->idTipoContato = $idTipoContato;

        return $this;
    }

    /**
     * Get the value of dataAlteracaoFinal
     */ 
    public function getDataAlteracaoFinal()
    {
        return $this->dataAlteracaoFinal;
    }

    /**
     * Set the value of dataAlteracaoFinal
     *
     * @return  self
     */ 
    public function setDataAlteracaoFinal($dataAlteracaoFinal)
    {
        $this->dataAlteracaoFinal = $dataAlteracaoFinal;

        return $this;
    }

    /**
     * Get the value of dataAlteracaoInicial
     */ 
    public function getDataAlteracaoInicial()
    {
        return $this->dataAlteracaoInicial;
    }

    /**
     * Set the value of dataAlteracaoInicial
     *
     * @return  self
     */ 
    public function setDataAlteracaoInicial($dataAlteracaoInicial)
    {
        $this->dataAlteracaoInicial = $dataAlteracaoInicial;

        return $this;
    }

    /**
     * Get the value of dataInclusaoFinal
     */ 
    public function getDataInclusaoFinal()
    {
        return $this->dataInclusaoFinal;
    }

    /**
     * Set the value of dataInclusaoFinal
     *
     * @return  self
     */ 
    public function setDataInclusaoFinal($dataInclusaoFinal)
    {
        $this->dataInclusaoFinal = $dataInclusaoFinal;

        return $this;
    }

    /**
     * Get the value of criterio
     */ 
    public function getCriterio()
    {
        return $this->criterio;
    }

    /**
     * Set the value of criterio
     *
     * @return  self
     */ 
    public function setCriterio($criterio)
    {
        $this->criterio = $criterio;

        return $this;
    }

    /**
     * Get the value of pesquisa
     */ 
    public function getPesquisa()
    {
        return $this->pesquisa;
    }

    /**
     * Set the value of pesquisa
     *
     * @return  self
     */ 
    public function setPesquisa($pesquisa)
    {
        $this->pesquisa = $pesquisa;

        return $this;
    }

    /**
     * Get the value of limite
     */ 
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * Set the value of limite
     *
     * @return  self
     */ 
    public function setLimite($limite)
    {
        $this->limite = $limite;

        return $this;
    }

    /**
     * Get the value of pagina
     */ 
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Set the value of pagina
     *
     * @return  self
     */ 
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;

        return $this;
    }
}