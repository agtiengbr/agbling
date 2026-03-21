<?php

use AGTI\Bling\Infrastructure\Serializer\Serializer;
use AGTI\Bling\Application\Service\RefreshToken;

class agblingrenewTokenModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/renewToken.log', 1);

        AgClienteLogger::addLog('Iniciando serviço.');

        
        global $agti_worker;
        $id_worker = Tools::getValue('id_agworker');
        $agti_worker = new AgClienteWorker($id_worker);
        
        $semId = ftok(__FILE__, "s");
        $sem = sem_get($semId, 1);
        sem_acquire($sem);
        $agti_worker->save();

        try {
            $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
            if (!$token) {
                sem_release($sem);
                exit;
            }
            
            $s = $this->get(RefreshToken::class);
            $token = $s->exec();
            AgClienteLogger::addLog('Token Renovado.');

            $configuration = $this->get(AGTI\Bling\ValueObject\Configuration::class);
            $configuration->setToken($token);

            $serializer = $this->get(Serializer::class);
            Configuration::updateValue('AGBLING_CONFIG', $serializer->serialize($configuration, 'json'));

            echo "A autenticação com o Bling foi realizada com sucesso. Você já pode fechar esta janela.";
        } catch (Exception $e) {
            AgclienteLogger::addLog("Erro - {$e->getMessage()} - {$e->getTraceAsString()}");
            echo "Ocorreu um erro ao renovar o token. {$e->getMessage()}.";
        }

        sem_release($sem);
        exit();
    }
}