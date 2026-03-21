<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\PaymentModes\GetPaymentModes;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\GetOrder\GetOrderResponseSuccess;

class GetPaymentModesService extends BaseService
{
    /**
     * @var int
     */
    private $id;

    public function getApiEndpoint()
    {
        return "formas-pagamentos";
    }

    public function exec()
    {
       $r = $this->send(
            "GET"
        );

        if ($r->getHttpCode() == 200) {
            return $this->getSerializer()->deserialize($r->getResponse(), GetPaymentModesResponseSuccess::class, 'json');
        }
    }
}