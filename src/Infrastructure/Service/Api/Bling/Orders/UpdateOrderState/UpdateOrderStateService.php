<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\UpdateOrderState;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class UpdateOrderStateService extends BaseService
{
    private $idPedidoVenda;
    private $idSituacao;

    public function getApiEndpoint()
    {
        return "pedidos/vendas/{$this->idPedidoVenda}/situacoes/{$this->idSituacao}";
    }

    public function exec($idPedidoVenda, $idSituacao)
    {
        $this->idPedidoVenda = $idPedidoVenda;
        $this->idSituacao = $idSituacao;

        $response = $this->send('PATCH');

        if ($response->getHttpCode() == 200) {
            return json_decode($response->getResponse());
        }
    }
}
