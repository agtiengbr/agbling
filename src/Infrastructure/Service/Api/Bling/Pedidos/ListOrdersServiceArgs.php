<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos;

class ListOrdersServiceArgs
{
    private $page = 1;
    private $limit = 100;
    private $dataAlteracaoInicial;
    private $dataAlteracaoFinal;
    private $idsSituacoes = [];

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getDataAlteracaoInicial()
    {
        return $this->dataAlteracaoInicial;
    }

    public function setDataAlteracaoInicial($dataAlteracaoInicial)
    {
        $this->dataAlteracaoInicial = $dataAlteracaoInicial;
        return $this;
    }

    public function getDataAlteracaoFinal()
    {
        return $this->dataAlteracaoFinal;
    }

    public function setDataAlteracaoFinal($dataAlteracaoFinal)
    {
        $this->dataAlteracaoFinal = $dataAlteracaoFinal;
        return $this;
    }

    public function getIdsSituacoes()
    {
        return $this->idsSituacoes;
    }

    public function setIdsSituacoes(array $idsSituacoes)
    {
        $this->idsSituacoes = $idsSituacoes;
        return $this;
    }
}
