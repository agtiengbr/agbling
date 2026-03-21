<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgBlingOrderState;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Situations\GetSituationService;
use Doctrine\ORM\EntityManagerInterface;

class CreateBlingOrderStateFromApi
{
    private $getSituationService;
    private $em;

    public function __construct(GetSituationService $getSituationService, EntityManagerInterface $em)
    {
        $this->getSituationService = $getSituationService;
        $this->em = $em;
    }

    public function exec($idSituacao, $token)
    {
        $this->getSituationService->setToken($token);
        $situation = $this->getSituationService->exec($idSituacao);

        if ($situation) {
            $orderState = new AgBlingOrderState();
            $orderState->setIdRemote($situation->getId());
            $orderState->setNome($situation->getNome());
            $orderState->setCor($situation->getCor());
            $orderState->setIdHerdado($situation->getIdHerdado());

            $this->em->persist($orderState);
            $this->em->flush();

            return $orderState;
        }

        return null;
    }
}
