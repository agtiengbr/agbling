<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\AccountsReceivable;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Portador;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Exception\ApiException;

class MarkAsPaidService extends BaseService
{
    private $accountId;

    public function getApiEndpoint()
    {
        return 'contas/receber/' . $this->accountId . '/baixar';
    }

    public function markAsPaid($idRemote, $date, $useDueDate, Portador $portador)
    {
        $this->accountId = $idRemote;
        $bodyData = json_encode([
            'data' => $date->format('Y-m-d'),
            'usarDataVencimento' => (bool) $useDueDate,
            'portador' => ['id' => $portador->getId()]
        ]);

        $response = $this->send('POST', [], $bodyData);

        $responseData = json_decode($response->getResponse(), true);

        if (isset($responseData['error'])) {
            throw new ApiException(
                $responseData['error']['message'],
                $responseData['error']['type'],
                $responseData['error']['description'],
                $responseData['error']['redirectUrl']
            );
        }

        return $response;
    }
}
