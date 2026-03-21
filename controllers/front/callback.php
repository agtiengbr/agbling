<?php

use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Entity\Product;
use AGTI\Bling\ValueObject\Configuration;
use AGTI\Bling\EntityManager\OrderEntityManager;
use AGTI\Bling\EntityManager\ProductEntityManager;
use AGTI\Bling\EntityManager\VariationEntityManager;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque\ListaEstoquesService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque\ListaEstoquesServiceArgs;
use AGTI\Bling\Service\GetOrder as ServiceGetOrder;
use AGTI\Bling\Service\GetProduct as ServiceGetProduct;
use AGTI\Bling\Service\ServiceArgs\GetOrder;
use AGTI\Bling\Service\ServiceArgs\GetProduct;

class agblingcallbackModuleFrontController extends ModuleFrontController
{
    /** @var Configuration */
    protected $config;


    public function initContent()
    {
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/callback.txt', 1);

        $this->config = $this->get(Configuration::class);
        if (Tools::getValue('proccess')) {
            AgClienteLogger::addLog("Processando Webhooks.");
            $this->proccess();
        }

        AgClienteLogger::addLog("Webhook recebido.");
        parent::initContent();
        $data = substr(file_get_contents('php://input'), 5);
        $decodedData = json_decode($data);
        $retorno = $decodedData->retorno;

        AgClienteLogger::addLog($data, 1);
        if (isset($retorno->estoques)) {
            $this->handleStockCallback($retorno->estoques);
        } elseif (isset($retorno->pedidos)) {
            $this->handleOrdersCallback($retorno->pedidos);
        }

        exit();
    }

    protected function handleStockCallback($data)
    {
        if ($this->config->getProductOrigin() != 'bling') {
            AgClienteLogger::addLog("Matriz de estoque não é o bling. Encerrando.");
            exit();
        }

        AgClienteLogger::addLog("Processando callback.");
        foreach ($data as $stock) {
            AgClienteLogger::addLog(json_encode($stock));
            $data = $stock->estoque;

            $cb = new AgBlingCallback;
            $cb->type = 'stock';
            $cb->id_object = $data->codigo;
            $cb->processed = 0;
            $cb->date_next_tentative = date('Y-m-d H:i:s', strtotime('+15 minutes'));

            $cb->save();
        }
    }

    protected function handleOrdersCallback($data)
    {
        if ($this->config->getProductOrigin() != 'bling') {
            exit();
        }


        foreach ($data as $orders) {
            $data = $orders->pedido;

            $cb = new AgBlingCallback;
            $cb->type = 'order';
            $cb->id_object = $data->numero;
            $cb->processed = 0;
            $cb->date_next_tentative = date('Y-m-d H:i:s', strtotime('+15 minutes'));

            $cb->save();
        }
    }

    protected function proccess()
    {        
        global $agti_worker;
        $agti_worker = new AgClienteWorker(Tools::getValue('id_worker'));
        $agti_worker->save();

        while(1) {
            $agti_worker->save();
            sleep(2);
            $next = AgBlingCallback::getNext();
            AgClienteLogger::addLog("Processnado callback {$next->id}.", 1);
            if (!Validate::isLoadedObject($next)) {
                AgClienteLogger::addLog("Nenhum webhook restante.", 1);
                break;
            }

            $next->date_next_tentative = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            $next->qty_tentatives++;
            $next->save();

            if ($next->type == 'stock') {
                $this->handleNotificationStock($next);
            } elseif ($next->type == 'order') {
                $this->handleNotificationOrder($next);
            }

            $next->processed = 1;
            $next->save();
        }

        exit();
    }

    protected function handleNotificationOrder(AgBlingCallback $cb)
    {
        //ajustar API v3

        // OrderEntityManager::updateStatusInprestaShop($r->getOrder());
    }

    protected function handleNotificationStock(AgBlingCallback $cb)
    {
        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
        if (is_null($token)) {
            AgClienteLogger::addLog("Falha de autenticação com o Bling; access token não gerado.", 4);
            return;
        }

        $em = $this->get('doctrine.orm.entity_manager');
        
        $s = $this->get(ListaEstoquesService::class);
        $s->setToken($token);


        $blingProduct = $em->getRepository(AgblingProduct::class)->findOneBy(['sku' => $cb->id_object]);
        if (!$blingProduct) {
            AgClienteLogger::addLog("O SKU {$cb->id_object} não foi baixado do Bling ainda.", 2);
            return;
        }

        $args = new ListaEstoquesServiceArgs;
        $args->setIds([$blingProduct->getIdRemote()]);
        

        $r = $s->exec($args);
        foreach ($r->getData() as $stock) {
            //busca o produto bling para achar o SKU
            $blingProd = $em->getRepository(AgblingProduct::class)->findOneBy(['idRemote' => $stock->getProduto()->getId()]);
            
            //busca o produto PS
            $prod = $em->getRepository(Product::class)->findOneBy(['reference' => $blingProd->getSku()]);
            if (!$prod) {
                AgClienteLogger::addLog("O SKU {$cb->id_object} não foi integrado no PS ainda.", 2);
                return;
            }
            
            AgClienteLogger::addLog("Atualizando estoque do produto {$prod->getId()} para {$stock->getSaldoFisicoTotal()}.", 1);

            //atualiza o estoque
            \StockAvailable::setQuantity($prod->getId(), 0, $stock->getSaldoFisicoTotal());
        }
    }
}