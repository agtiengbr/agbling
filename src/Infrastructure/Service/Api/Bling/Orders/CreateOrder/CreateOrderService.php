<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateOrder;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Order;

class CreateOrderService extends BaseService
{
    public function getApiEndpoint()
    {
        return "pedidos/vendas";
    }

    /**
     * @return CreateOrderResponseSuccess|null
     */
    public function exec(Order $order)
    {
        $r = $this->send(
            "POST",
            [],
            $this->getSerializer()->serialize($order, 'json')
        );

        if ($r->getHttpCode() == 201) {
            return $this->getSerializer()->deserialize($this->getRequest()->getResponse(), CreateOrderResponseSuccess::class, 'json');
        }
    }
}