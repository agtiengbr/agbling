<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateState;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\OrderStatus;

class CreateStateService extends BaseService
{
    public function getApiEndpoint()
    {
        return 'situacoes';
    }

    public function execute($data)
    {
        $response = $this->send('POST', [], json_encode($data));
        if ($response->getHttpCode() == 201) {
            $decoded = json_decode($response->getResponse());
            return $this->getSerializer()->deserialize(json_encode($decoded->data), OrderStatus::class, 'json');
        }
    }
}
