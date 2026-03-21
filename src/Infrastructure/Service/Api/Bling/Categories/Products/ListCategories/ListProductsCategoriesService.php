<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\ListCategories;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class ListProductsCategoriesService extends BaseService
{
    public function getApiEndpoint()
    {
        return "categorias/produtos";
    }

    public function exec(ListProductsCategoriesServiceArgs $args)
    {
        $r = $this->send(
            "GET",
            [
                "pagina" => $args->getPage(),
                "limite" => $args->getLimit()
            ]
        );

        if ($r->getHttpCode() == 200) {
            $ret = $this->getserializer()->deserialize($r->getResponse(), ListProductsCategoriesResponseSuccess::class, 'json');

            return $ret;
        }
    }
}
