<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\GetOrder;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\GetOrder\GetOrderResponseSuccess;

class GetOrderService extends BaseService
{
    /**
     * @var int
     */
    private $id;

    public function getApiEndpoint()
    {
        return "pedidos/vendas/{$this->id}";
    }

    public function exec($id)
    {
        $this->id = $id;

        $r = $this->send(
            "GET"
        );

        if ($r->getHttpCode() == 200) {
            return $this->getSerializer()->deserialize($r->getResponse(), GetOrderResponseSuccess::class, 'json');
        }

        dump($r);
        exit();
    }
}