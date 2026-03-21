<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;

class ListOrdersService extends BaseService
{
    public function getApiEndpoint()
    {
        return 'pedidos/vendas';
    }

    public function exec(ListOrdersServiceArgs $args)
    {
        $query = [
            'pagina' => $args->getPage(),
            'limite' => $args->getLimit(),
            'dataAlteracaoInicial' => $args->getDataAlteracaoInicial(),
            'dataAlteracaoFinal' => $args->getDataAlteracaoFinal(),
            'idsSituacoes' => $args->getIdsSituacoes(),
        ];

        $response = $this->send('GET', $query);
        return $this->getSerializer()->deserialize($response->getResponse(), ListOrdersResponse::class, 'json');
    }
}
