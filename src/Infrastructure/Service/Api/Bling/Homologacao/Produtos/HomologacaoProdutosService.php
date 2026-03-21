<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Homologacao\Produtos;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class HomologacaoProdutosService extends BaseService
{
    public function getApiEndpoint()
    {
        return "homologacao/produtos";
    }

    public function exec()
    {

        $this->send("GET");
        return [
            'data' => json_decode($this->getRequest()->getResponse()),
            'headers' => $this->getRequest()->getHeadersResponse()
        ];
    }
}