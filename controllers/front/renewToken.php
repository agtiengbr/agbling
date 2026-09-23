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

        try {
            $agti_worker->save();

            // O refresh token continua válido após o access token expirar.
            $configuration = $this->get(AGTI\Bling\ValueObject\Configuration::class);
            $token = $configuration->getToken();
            if (!$token instanceof AGTI\Bling\ValueObject\ApiToken || !$token->getRefreshToken()) {
                throw new \RuntimeException('Refresh token do Bling indisponível.');
            }
            
            $s = $this->get(RefreshToken::class);
            $token = $s->exec($token);

            $configuration->setToken($token);

            $serializer = $this->get(Serializer::class);
            if (!Configuration::updateValue('AGBLING_CONFIG', $serializer->serialize($configuration, 'json'))) {
                throw new \RuntimeException('Falha ao salvar os tokens renovados do Bling.');
            }

            AgClienteLogger::addLog('Token Renovado.');
            try {
                $s->recordRequest();
            } catch (\Throwable $e) {
                AgClienteLogger::addLog('Falha ao registrar a renovação do Bling: ' . get_class($e));
            }

            echo "A autenticação com o Bling foi realizada com sucesso. Você já pode fechar esta janela.";
        } catch (\Throwable $e) {
            AgClienteLogger::addLog('Erro na renovação do Bling: ' . get_class($e) . ' - ' . $e->getMessage());
            echo 'Ocorreu um erro ao renovar o token do Bling.';
        } finally {
            sem_release($sem);
        }

        exit();
    }
}
