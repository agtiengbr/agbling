<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\GetProduct;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class GetProduct extends BaseService
{
    private $idProduct;

    public function getApiEndpoint()
    {
        return "produtos/{$this->idProduct}";
    }

    public function exec(GetProductArgs $args)
    {
        $this->idProduct = $args->getId();

        $r = $this->send("GET");

       
        if ($r->getHttpCode() == 200) {
            $ret = $this->getserializer()->deserialize($r->getResponse(), GetProductResponseSuccess::class, 'json');

            return $ret;
        }
    }
}
