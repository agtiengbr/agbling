<?php

use AGTI\Bling\Application\Service\ApiApplicationTrait;
use AGTI\Bling\Application\Service\CreateBlingOrderStateFromApi;
use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\Entity\AgBlingOrderState;
use AGTI\Bling\Entity\Orders;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos\ListOrdersService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos\ListOrdersServiceArgs;
use Doctrine\ORM\EntityManagerInterface;

class agblingdownloadOrdersModuleFrontController extends ModuleFrontController
{
    use ApiApplicationTrait;

    public function initContent()
    {
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/downloadOrders.log', 1);

        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
        if (is_null($token)) {
            AgClienteLogger::addLog("Falha de autenticação com o Bling; access token não gerado.");
            exit();
        }

        /** @var EntityManagerInterface */
        $em = $this->get('doctrine.orm.entity_manager');
        $createBlingOrderStateFromApiService = $this->get(CreateBlingOrderStateFromApi::class);

        try {
            $service = $this->get(ListOrdersService::class);
            $service->setToken($token);

            $args = new ListOrdersServiceArgs;
            $args->setPage(1);

            do {
                $response = $service->exec($args);
                $this->postApiRequest($service->getRequest(), $em);

                foreach ($response->getData() as $blingOrder) {
                    // Check if situation exists, if not, create it
                    $situationId = $blingOrder->getSituacao()->getId();
                    $orderState = $em->getRepository(AgBlingOrderState::class)->findOneBy(['idRemote' => $situationId]);
                    if (!$orderState) {
                        $createBlingOrderStateFromApiService->exec($situationId, $token);
                    }

                    $psOrder = $em->getRepository(Orders::class)->findOneBy(['id' => $blingOrder->getNumeroLoja()]);
                    
                    if ($psOrder) {
                        $agblingOrder = $em->getRepository(AgblingOrder::class)->findOneBy(['psOrder' => $psOrder]);
                        if (!$agblingOrder) {
                            $agblingOrder = new AgblingOrder;
                            $agblingOrder->setPsOrder($psOrder)
                                         ->setIdRemote($blingOrder->getId());

                            $em->persist($agblingOrder);

                        }
                    }
                }

                $em->flush();
                $args->setPage($args->getPage() + 1);
            } while ($response->hasMorePages());

        } catch (Exception $e) {
            dump($e);exit();
            AgClienteLogger::addLog("Erro ao baixar pedidos: " . $e->getMessage(), 3);
        }

        exit();
    }
}