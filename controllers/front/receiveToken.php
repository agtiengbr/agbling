<?php

use AGTI\Bling\Infrastructure\Serializer\Serializer;

class agblingreceiveTokenModuleFrontController extends ModuleFrontController
{
    public function postProcess()
    {
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/auth.log', 1);
        AgClienteLogger::addLog("Token recebido.");

        $configuration = $this->get(AGTI\Bling\ValueObject\Configuration::class);

        $token = $configuration->getToken();
        if (!$token) {
            $token = new AGTI\Bling\ValueObject\ApiToken;
        }

        $token->setRefreshToken(Tools::getValue('refresh_token'))
            ->setToken(Tools::getValue('access_token'))
            ->setExpirationDate(new \DateTime('+30 minutes'));


        $configuration->setToken($token);

        $serializer = $this->get(Serializer::class);
        Configuration::updateValue('AGBLING_CONFIG', $serializer->serialize($configuration, 'json'));

        AgClienteLogger::addLog("Autenticação concluída.");
        echo "A autenticação com o Bling foi realizada com sucesso. Você já pode fechar esta janela.";
        exit();
    }
    
}