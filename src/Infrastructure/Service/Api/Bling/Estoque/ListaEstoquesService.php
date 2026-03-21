<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class ListaEstoquesService extends BaseService
{
    private $args;

    public function getApiEndpoint()
    {
        $r = "estoques/saldos?idsProdutos[]=" . implode("&idsProdutos[]=", $this->args->getIds());
        return $r;
    }

    public function exec(ListaEstoquesServiceArgs $args)
    {
        $this->args = $args;

        $r = $this->send(
            "GET"
        );

        if ($r->getHttpCode() == 200) {
            $r = $this->getSerializer()->deserialize($r->getResponse(), ListaEstoquesResponseSuccess::class, 'json');

            return $r;
        }
    }
    
}