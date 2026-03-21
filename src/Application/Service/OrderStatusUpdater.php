<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\UpdateOrderState\UpdateOrderStateService;
use AGTI\Bling\ValueObject\ApiToken;
use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;

class OrderStatusUpdater
{
    use ApiApplicationTrait;

    private $updateOrderStateService;
    private $em;

    public function __construct(EntityManagerInterface $em, UpdateOrderStateService $updateOrderStateService)
    {
        $this->updateOrderStateService = $updateOrderStateService;
        $this->em = $em;
    }

    public function updateOrderStatus(Orders $order, $newStatus, ApiToken $token)
    {
        $agBlingOrder = $this->em->getRepository(AgblingOrder::class)->findOneBy(['psOrder' => $order]);

        if (!$agBlingOrder) {
            throw new \Exception("O pedido não foi enviado ao Bling ainda.");
        }

        $this->updateOrderStateService->setToken($token);
        $this->updateOrderStateService->exec($agBlingOrder->getIdRemote(), $newStatus);
        $this->postApiRequest($this->updateOrderStateService->getRequest(), $this->em);
    }
}
