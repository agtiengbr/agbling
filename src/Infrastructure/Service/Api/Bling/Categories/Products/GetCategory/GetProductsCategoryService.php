<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\GetCategory;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class GetProductsCategoryService extends BaseService
{
    private $args;
    public function getApiEndpoint()
    {
        return "categorias/produtos/{$this->args->getId()}";
    }

    public function exec(GetproductsCategoryServiceArgs $args)
    {
        $this->args = $args;

        $r = $this->send("GET");

        if ($r->getHttpCode() == 200) {
            $ret = $this->getSerializer()->deserialize($r->getResponse(), GetProductsCategoryServiceResponseSuccess::class, 'json');
            return $ret;
        }
    }
}