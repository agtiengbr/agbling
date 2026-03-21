<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\AccountsReceivable;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\AccountsReceivableArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\AccountsReceivableResponseSuccess;

class GetAccountsReceivableService extends BaseService
{
    /**
     * @var AccountsReceivableArgs
     */
    private $args;

    public function getApiEndpoint()
    {
        $queryParams = http_build_query([
            'pagina' => $this->args->getPagina(),
            'limite' => $this->args->getLimite(),
            'situacoes' => $this->args->getSituacoes(),
            'tipoFiltroData' => $this->args->getTipoFiltroData(),
            'dataInicial' => $this->args->getDataInicial()->format('Y-m-d'),
            'dataFinal' => $this->args->getDataFinal()->format('Y-m-d'),
            'idsCategorias' => $this->args->getIdsCategorias(),
            'idPortador' => $this->args->getIdPortador(),
            'idContato' => $this->args->getIdContato(),
            'idVendedor' => $this->args->getIdVendedor(),
            'idFormaPagamento' => $this->args->getIdFormaPagamento(),
            'boletoGerado' => $this->args->getBoletoGerado(),
        ]);

        return "contas/receber?" . $queryParams;
    }

    public function exec(AccountsReceivableArgs $args)
    {
        $this->args = $args;

        $r = $this->send("GET");

        if ($r->getHttpCode() == 200) {
            return $this->getSerializer()->deserialize($r->getResponse(), AccountsReceivableResponseSuccess::class, 'json');
        }
    }
}
