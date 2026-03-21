<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Homologacao\Produtos;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class HomologacaoProdutosThreeService extends BaseService
{
    private $id;
    public function getApiEndpoint()
    {
        return "homologacao/produtos/{$this->id}";
    }

    public function exec($id, $data, $headers)
    {
        $this->id = $id;
        $this->send("PUT", [], json_encode($data), $headers);
        return [
            'data' => json_decode($this->getRequest()->getResponse()),
            'headers' => $this->getRequest()->getHeadersResponse()
        ];
        
    }
}