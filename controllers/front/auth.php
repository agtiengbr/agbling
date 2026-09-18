<?php
class agblingauthModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/auth.log', 1);
        AgClienteLogger::addLog("Iniciando autenticação com o Bling.");
        
        $apiAuthUrl = $this->get(AGTI\Bling\ValueObject\ApiAuthUrl::class);
        Tools::redirect($apiAuthUrl->getUrl() . '?redirect_back=' . urlencode($this->context->link->getModuleLink('agbling', 'receiveToken')));

        exit();
    }
}
