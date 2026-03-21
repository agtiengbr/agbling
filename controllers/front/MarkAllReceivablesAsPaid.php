<?php

use AGTI\Bling\Application\Service\MarkAsPaidApplicationService;
use AGTI\Bling\Entity\AgblingAccountsReceivable;
use AGTI\Bling\Entity\BillToReceive;
use AGTI\Bling\ValueObject\ApiToken;
use PrestaShop\PrestaShop\Adapter\Entity\Configuration;
use Symfony\Component\HttpFoundation\Response;

class agblingMarkAllReceivablesAsPaidModuleFrontController extends ModuleFrontController
{
    private $em;
    private $markAsPaidApplicationService;
    private $accountsReceivableRepository;

    public function __construct()
    {
        parent::__construct();
    }

    public function initContent()
    {
        $this->em = $this->get('doctrine.orm.entity_manager');
        $this->markAsPaidApplicationService = $this->get(MarkAsPaidApplicationService::class);
        $this->accountsReceivableRepository = $this->em->getRepository(AgblingAccountsReceivable::class);

        parent::initContent();

        try {
            AgClienteLogger::addLog("Iniciando a marcação de todas as contas a receber como pagas.", 1);

            // Get the API token
            $token = $this->get(ApiToken::class);

            // Fetch all unpaid receivables for paid orders
            $unpaidReceivables = $this->accountsReceivableRepository->findUnpaidReceivablesForPaidOrders();

            // Mark each receivable as paid
            foreach ($unpaidReceivables as $receivable) {
                $this->markAsPaidApplicationService->exec($receivable, $token, new \DateTime(), false);
            }

            AgClienteLogger::addLog("Marcação de todas as contas a receber como pagas concluída com sucesso.", 1);
        } catch (\Exception $e) {
            AgClienteLogger::addLog("Erro ao marcar contas a receber como pagas: " . $e->getMessage(), 3);
        }

        exit();
    }
}
