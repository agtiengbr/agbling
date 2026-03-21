<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Homologacao\Produtos;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class HomologacaoProdutosTwoService extends BaseService
{
    public function getApiEndpoint()
    {
        return "homologacao/produtos";
    }

    public function exec($data, $headers)
    {
        $this->send("POST", [], json_encode($data), $headers);
        return [
            'data' => json_decode($this->getRequest()->getResponse()),
            'headers' => $this->getRequest()->getHeadersResponse()
        ];
        
    }
}