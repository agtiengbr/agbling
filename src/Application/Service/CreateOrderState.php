<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgBlingOrderState;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateState\CreateStateService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\OrderStatus;
use Doctrine\ORM\EntityManagerInterface;

class CreateOrderState
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(CreateStateService $apiService, EntityManagerInterface $em)
    {
        $this->apiService = $apiService;
        $this->em = $em;
    }

    public function exec($data, $token)
    {
        $this->apiService->setToken($token);
        $response = $this->apiService->execute($data);
        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        // Verifica se a resposta é uma instância de OrderStatus
        if ($response instanceof OrderStatus) {
            // Persiste a nova forma de pagamento no banco de dados utilizando os dados retornados pela API
            $orderState = new AgBlingOrderState();
            $orderState->setIdRemote($response->getId());
            $orderState->setNome($data['nome']);
            $orderState->setCor($data['cor']);

            $this->em->persist($orderState);
            $this->em->flush();
        }

        return $response;
    }
}
