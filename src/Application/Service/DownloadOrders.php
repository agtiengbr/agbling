<?php
namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos\ListOrdersService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos\ListOrdersServiceArgs;
use Doctrine\ORM\EntityManagerInterface;

class DownloadOrders
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(ListOrdersService $apiService, EntityManagerInterface $em)
    {
        $this->apiService = $apiService;
        $this->em = $em;
    }

    public function exec($token, $config)
    {
        if ($config->getSendOrders() || !$config->hasOrderStatusMapping()) {
            return;
        }

        $this->apiService->setToken($token);

        $args = new ListOrdersServiceArgs;
        $args->setDataAlteracaoInicial((new \DateTime('-1 day'))->format('Y-m-d H:i:s'))
             ->setDataAlteracaoFinal((new \DateTime())->format('Y-m-d H:i:s'))
             ->setIdsSituacoes($config->getMappedOrderStatuses());

        do {
            $response = $this->apiService->exec($args);
            foreach ($response->getData() as $blingOrder) {
                $psOrder = $this->em->getRepository(Order::class)->findOneBy(['reference' => $blingOrder->getNumero()]);
                if ($psOrder) {
                    $agblingOrder = $this->em->getRepository(AgblingOrder::class)->findOneBy(['psOrder' => $psOrder]);
                    if (!$agblingOrder) {
                        $agblingOrder = new AgblingOrder;
                        $agblingOrder->setPsOrder($psOrder)
                                     ->setBlingOrderId($blingOrder->getId());
                        $this->em->persist($agblingOrder);
                    }
                }
            }

            $this->em->flush();
            $args->setPage($args->getPage() + 1);
        } while ($response->hasMorePages());
    }
}
