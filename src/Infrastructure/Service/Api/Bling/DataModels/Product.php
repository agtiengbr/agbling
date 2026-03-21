<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class Product
{
    private $id;
    private $nome;
    private $codigo;
    private $preco;
    private $tipo;
    private $situacao;
    private $formato;
    private $descricaoCurta;
    private $descricaoComplementar;
    private $categoria;
    private $imagemURL;
    private $estoque;
    private $dimensoes;
    private $imagens;
    private $variacao;
    private $pesoBruto;
    private $pesoLiquido;
    
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
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    
    /* Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    
    /**
     * Get the value of imagemURL
     */ 
    public function getImagemURL()
    {
        return $this->imagemURL;
    }

    /**
     * Set the value of imagemURL
     *
     * @return  self
     */ 
    public function setImagemURL($imagemURL)
    {
        $this->imagemURL = $imagemURL;

        return $this;
    }

    /**
     * Get the value of descricaoCurta
     */ 
    public function getDescricaoCurta()
    {
        return $this->descricaoCurta;
    }

    /**
     * Set the value of descricaoCurta
     *
     * @return  self
     */ 
    public function setDescricaoCurta($descricaoCurta)
    {
        $this->descricaoCurta = $descricaoCurta;

        return $this;
    }

    /**
     * Get the value of formato
     */ 
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set the value of formato
     *
     * @return  self
     */ 
    public function setFormato($formato)
    {
        $this->formato = $formato;

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
     * Get the value of preco
     */ 
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setPreco($preco)
    {
        $this->preco = $preco;

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
     * Get the value of estoque
     */ 
    public function getEstoque()
    {
        return $this->estoque;
    }

    /**
     * Set the value of estoque
     *
     * @return  self
     */ 
    public function setEstoque(ProductStock $estoque)
    {
        $this->estoque = $estoque;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria(Category $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of descricaoComplementar
     */ 
    public function getDescricaoComplementar()
    {
        return $this->descricaoComplementar;
    }

    /**
     * Set the value of descricaoComplementar
     *
     * @return  self
     */ 
    public function setDescricaoComplementar($descricaoComplementar)
    {
        $this->descricaoComplementar = $descricaoComplementar;

        return $this;
    }

    /**
     * Get the value of dimensoes
     */ 
    public function getDimensoes()
    {
        return $this->dimensoes;
    }

    /**
     * Set the value of dimensoes
     *
     * @return  self
     */ 
    public function setDimensoes($dimensoes)
    {
        $this->dimensoes = $dimensoes;

        return $this;
    }

    /**
     * Get the value of imagens
     */ 
    public function getImagens()
    {
        return $this->imagens;
    }

    /**
     * Set the value of imagens
     *
     * @return  self
     */ 
    public function setImagens($imagens)
    {
        $this->imagens = $imagens;

        return $this;
    }

    /**
     * Get the value of variacao
     */ 
    public function getVariacao()
    {
        return $this->variacao;
    }

    /**
     * Set the value of variacao
     *
     * @return  self
     */ 
    public function setVariacao(Variation $variacao)
    {
        $this->variacao = $variacao;

        return $this;
    }

    /**
     * Get the value of pesoLiquido
     */ 
    public function getPesoLiquido()
    {
        return $this->pesoLiquido;
    }

    /**
     * Set the value of pesoLiquido
     *
     * @return  self
     */ 
    public function setPesoLiquido($pesoLiquido)
    {
        $this->pesoLiquido = $pesoLiquido;

        return $this;
    }

    /**
     * Get the value of pesoBruto
     */ 
    public function getPesoBruto()
    {
        return $this->pesoBruto;
    }

    /**
     * Set the value of pesoBruto
     *
     * @return  self
     */ 
    public function setPesoBruto($pesoBruto)
    {
        $this->pesoBruto = $pesoBruto;

        return $this;
    }
}