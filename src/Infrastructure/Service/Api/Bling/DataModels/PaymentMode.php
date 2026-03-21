<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels;

class PaymentMode
{
    
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $descricao;
    
    /**
     * @var int
     */
    private $tipoPagamento;
    
    /**
     * @var int
     */
    private $situacao;
    
    /**
     * @var boo
     */
    private $fixa;
    
    /**
     * @var int
     */
    private $padrao;
    
    /**
     * @var int
     */
    private $finalidade;

    /**
     * Get the value of finalidade
     *
     * @return  int
     */ 
    public function getFinalidade()
    {
        return $this->finalidade;
    }

    /**
     * Set the value of finalidade
     *
     * @param  int  $finalidade
     *
     * @return  self
     */ 
    public function setFinalidade(int $finalidade)
    {
        $this->finalidade = $finalidade;

        return $this;
    }

    /**
     * Get the value of padrao
     *
     * @return  int
     */ 
    public function getPadrao()
    {
        return $this->padrao;
    }

    /**
     * Set the value of padrao
     *
     * @param  int  $padrao
     *
     * @return  self
     */ 
    public function setPadrao(int $padrao)
    {
        $this->padrao = $padrao;

        return $this;
    }

    /**
     * Get the value of fixa
     *
     * @return  bool
     */ 
    public function getFixa()
    {
        return $this->fixa;
    }

    /**
     * Set the value of fixa
     *
     * @param  bool  $fixa
     *
     * @return  self
     */ 
    public function setFixa(bool $fixa)
    {
        $this->fixa = $fixa;

        return $this;
    }

    /**
     * Get the value of situacao
     *
     * @return  int
     */ 
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set the value of situacao
     *
     * @param  int  $situacao
     *
     * @return  self
     */ 
    public function setSituacao(int $situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * Get the value of tipoPagamento
     *
     * @return  int
     */ 
    public function getTipoPagamento()
    {
        return $this->tipoPagamento;
    }

    /**
     * Set the value of tipoPagamento
     *
     * @param  int  $tipoPagamento
     *
     * @return  self
     */ 
    public function setTipoPagamento(int $tipoPagamento)
    {
        $this->tipoPagamento = $tipoPagamento;

        return $this;
    }

    /**
     * Get the value of descricao
     *
     * @return  string
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @param  string  $descricao
     *
     * @return  self
     */ 
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
}