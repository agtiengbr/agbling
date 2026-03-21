<?php
class agblingauthModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/auth.log', 1);
        AgClienteLogger::addLog("Iniciando autenticação com o Bling.");
        
        Tools::redirect($this->get(AGTI\Bling\ValueObject\ApiAuthUrl::class)  . '?redirect_back=' . urlencode($this->context->link->getModuleLink('agbling', 'receiveToken')));

        exit();
    }
}