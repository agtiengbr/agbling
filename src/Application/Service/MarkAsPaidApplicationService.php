<?php
namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgblingAccountsReceivable;
use AGTI\Bling\Infrastructure\Service\Api\Bling\AccountsReceivable\MarkAsPaidService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Portador;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Exception\ApiException;
use AGTI\Bling\ValueObject\Mappings;
use Doctrine\ORM\EntityManagerInterface;

class MarkAsPaidApplicationService
{
    use ApiApplicationTrait;

    private $markAsPaidService;
    private $em;
    private $mappings;

    public function __construct(MarkAsPaidService $markAsPaidService, EntityManagerInterface $em, Mappings $mappings)
    {
        $this->markAsPaidService = $markAsPaidService;
        $this->em = $em;
        $this->mappings = $mappings;
    }

    public function exec(AgblingAccountsReceivable $receivable, $apiToken, $date, $useDueDate = false)
    {
        $this->markAsPaidService->setToken($apiToken);

        // Obter o ID do Portador através do mapeamento de conta contábil do pedido
        $order = $receivable->getBlingOrder()->getPsOrder();
        $paymentMode = $order->getPayment();
        $portadorId = $this->mappings->getContaContabilMapping(str_replace(' ', '_', $paymentMode));

        if (is_null($portadorId)) {
            throw new \Exception("Conta contábil não mapeada: " . $paymentMode);
        }

        $portador = new Portador;
        $portador->setId($portadorId);

        try {
            $response = $this->markAsPaidService->markAsPaid($receivable->getBlingId(), $date, $useDueDate, $portador);
        } catch (ApiException $e) {
            $this->postApiRequest($this->markAsPaidService->getRequest(), $this->em);
            throw $e;
        }

        $this->postApiRequest($this->markAsPaidService->getRequest(), $this->em);

        // Marcar o recebível como pago
        $receivable->setSituacao(2);
        $this->em->flush();

        return $response;
    }
}
