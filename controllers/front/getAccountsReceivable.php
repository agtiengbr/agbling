<?php

use AGTI\Bling\Application\Service\GetAccountsReceivable;
use AGTI\Bling\ValueObject\ApiToken;
use PrestaShop\PrestaShop\Adapter\Entity\Configuration;
use Symfony\Component\HttpFoundation\Response;

class agblinggetAccountsReceivableModuleFrontController extends ModuleFrontController
{
    private $em;
    private $getAccountsReceivableService;

    public function __construct()
    {
        parent::__construct();
    }

    public function initContent()
    {
        $this->em = $this->get('doctrine.orm.entity_manager');
        $this->getAccountsReceivableService = $this->get(GetAccountsReceivable::class);

        parent::initContent();

        try {
            AgClienteLogger::addLog("Iniciando a busca de contas a receber do Bling.", 1);

            // Get the date of the last query
            $lastQueryDate = Configuration::get('AGBLING_LAST_QUERY_DATE');
            $dataInicial = $lastQueryDate ? new \DateTime($lastQueryDate) : new \DateTime('2020-01-01');

            // Ensure the minimum dataInicial is 366 days ago
            $minDate = (new \DateTime())->modify('-366 days');
            if ($dataInicial < $minDate) {
                $dataInicial = $minDate;
            }

            // Get the API token
            $token = $this->get(ApiToken::class);

            // Execute the service to fetch and save accounts receivable
            $this->getAccountsReceivableService->exec($dataInicial, $token);

            // Update the date of the last query
            Configuration::updateValue('AGBLING_LAST_QUERY_DATE', (new \DateTime())->format('Y-m-d H:i:s'));

            AgClienteLogger::addLog("Busca de contas a receber do Bling concluída com sucesso.", 1);
            $this->context->smarty->assign('message', 'Busca de contas a receber do Bling concluída com sucesso.');
        } catch (\Exception $e) {
            AgClienteLogger::addLog("Erro ao buscar contas a receber do Bling: " . $e->getMessage(), 3);
            $this->context->smarty->assign('message', 'Erro ao buscar contas a receber do Bling: ' . $e->getMessage());
        }

        exit();
    }
}
