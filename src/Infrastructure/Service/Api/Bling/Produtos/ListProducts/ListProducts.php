<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class ListProducts extends BaseService
{
    public function getApiEndpoint()
    {
        return "produtos";
    }

    public function exec(ListProductsArgs $args)
    {
        $r = $this->send(
            "GET",
            [
                "pagina" => $args->getPage(),
                "limite" => $args->getLimit(),
                "criterio" => $args->getCriteria(),
                "tipo" => $args->getType()
            ]
        );

        if ($r->getHttpCode() == 200) {
            $ret = $this->getserializer()->deserialize($r->getResponse(), ListProductsResponseSuccess::class, 'json');

            return $ret;
        }
    }
}
