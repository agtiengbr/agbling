<?php

use AGTI\Bling\Application\Service\ApiApplicationTrait;
use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Entity\Product;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque\ListaEstoquesService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque\ListaEstoquesServiceArgs;

class agblingdownloadStocksModuleFrontController extends ModuleFrontController
{
    use ApiApplicationTrait;

    public function initContent()
    {
        if (!$this->config->getSyncStock()) {
            AgClienteLogger::addLog("Sincronização de estoque está desativada.");
            exit();
        }

        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/downloadStocks.log', 1);

        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
        if (is_null($token)) {
            AgClienteLogger::addLog("Falha de autenticação com o Bling; access token não gerado.");
            exit();
        }

        $em = $this->get('doctrine.orm.entity_manager');
        $products = $em->getRepository(AgblingProduct::class)->findAll();

        $pagesize = 200;

        try {
            $totalPages = count($products) / $pagesize  + 1;
            for ($i=0; $i < $totalPages; $i++) {
                AgClienteLogger::addLog("Processando página {$i} de {$totalPages}.");

                $s = $this->get(ListaEstoquesService::class);
                $s->setToken($token);

                $args = new ListaEstoquesServiceArgs;

                $ids = [];
                for ($j=$i * $pagesize; $j < ($i+1) * $pagesize && $j < count($products); $j++) {
                    AgClienteLogger::addLog("Processando produto {$products[$j]->getSku()}.");
                    //verifica se o SKU existe no PS
                    $prod = $em->getRepository(Product::class)->findOneBy(['reference' => $products[$j]->getSku()]);
                    if (!is_null($prod)) {
                        $ids[] = $products[$j]->getIdRemote();
                    } else {
                        AgClienteLogger::addLog("SKU não consta no PrestaShop");
                    }
                }

                //se nenhum SKU da página atual está no PS, pula a pagina
                if (!count($ids)) {
                    continue;
                }
                $args->setIds($ids);
                $r = $s->exec($args);
                $this->postApiRequest($r->getRequest(), $em);
                $this->postApiRequest($r->getRequest(), $em);

                if (isset($r) && is_array($r->getData())) {
                    foreach ($r->getData() as $stock) {
                        AgClienteLogger::addLog("Atualizando estoque do SKU {$stock->getProduto()->getId()} para {$stock->getSaldoFisicoTotal()}.");
                        
                        //busca o produto bling para achar o SKU
                        $blingProd = $em->getRepository(AgblingProduct::class)->findOneBy(['idRemote' => $stock->getProduto()->getId()]);
                        
                        //busca o produto PS
                        $prod = $em->getRepository(Product::class)->findOneBy(['reference' => $blingProd->getSku()]);

                        //atualiza o estoque
                        \StockAvailable::setQuantity($prod->getId(), 0, $stock->getSaldoFisicoTotal());
                    }
                }
            }
        } catch (Exception $e) {
            AgClienteLogger::addLog($e->getMessage(), 3);
        }

        exit();
    }
}