<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Homologacao\Produtos;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class HomologacaoProdutosFourService extends BaseService
{
    private $id;
    public function getApiEndpoint()
    {
        return "homologacao/produtos/{$this->id}/situacoes";
    }

    public function exec($id, $data, $headers)
    {
        $this->id = $id;
        $this->send("PATCH", [], json_encode($data), $headers);
        return [
            'data' => json_decode($this->getRequest()->getResponse()),
            'headers' => $this->getRequest()->getHeadersResponse()
        ];
        
    }
}