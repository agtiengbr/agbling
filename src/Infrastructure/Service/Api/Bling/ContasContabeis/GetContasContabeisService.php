<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\ContasContabeis;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContasContabeisArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContaContabil;

class GetContasContabeisService extends BaseService
{
    private $args;

    public function getApiEndpoint()
    {
        $queryParams = http_build_query([
            'pagina' => $this->args->getPagina(),
            'limite' => $this->args->getLimite(),
            'ocultarInvisiveis' => $this->args->getOcultarInvisiveis(),
            'ocultarTipoContaBancaria' => $this->args->getOcultarTipoContaBancaria(),
            'aliasIntegracao' => $this->args->getAliasIntegracao(),
        ]);
            
        return "contas-contabeis?" . $queryParams;
    }

    public function exec(ContasContabeisArgs $args)
    {
        $this->args = $args;

        $r = $this->send("GET");

        if ($r->getHttpCode() == 200) {
            return $this->getSerializer()->deserialize($r->getResponse(), 'array<' . ContaContabil::class . '>', 'json');
        }
    }
}
