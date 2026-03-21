<?php

use AGTI\Bling\Application\Exception\UnauthorizedHttpException;
use AGTI\Bling\Application\Service\DownloadNewProducts;
use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Entity\Configuration;
use AGTI\Bling\Entity\Product;
use AGTI\Bling\Entity\Variation;
use AGTI\Bling\EntityManager\CategoryEntityManager;
use AGTI\Bling\EntityManager\ProductEntityManager;
use AGTI\Bling\EntityManager\VariationEntityManager;
use AGTI\Bling\Exception\UnauthorizedException;
use AGTI\Bling\Infrastructure\Serializer\Serializer;
use AGTI\Bling\Service\GetProducts;
use AGTI\Bling\Service\ServiceArgs\GetProducts as ServiceArgsGetProducts;
use AGTI\Bling\ValueObject\Configuration as VBConfiguration;

class agblingdownloadNewProductsModuleFrontController extends ModuleFrontController
{
    protected $config;
    protected $products = [];

    /** @var Variation[] */
    protected $variations = [];
    
    public function initContent()
    {
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/downloadNewProducts.log', 1);

        $this->config = $this->get(VBConfiguration::class);
        
        //se o download de novos produtos não estiver habilitado, ignora o controlador
        if (!$this->config->getProductOrigin() === 'bling') {
            AgClienteLogger::addLog("Matriz de Produtos não é o Bling.");
            exit();
        }


        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
        if (is_null($token)) {
            AgClienteLogger::addLog("Falha de autenticação com o Bling; access token não gerado.");
            exit();
        }
        
        try {
            $service = $this->get(DownloadNewProducts::class);
            AgClienteLogger::addLog("Iniciando serviço da Aplicação.");
            $service->exec($token);
            AgClienteLogger::addLog("Serviço da Aplicação finalizado.");
        } catch (UnauthorizedHttpException $e) {
            $config = $this->get(AGTI\Bling\ValueObject\Configuration::class);
            $config->setToken($config->getToken()->setToken(null));
            $serializer = $this->get(Serializer::class);

            AgClienteLogger::addLog("Falha de autenticação com o Bling retornado pela API.");

            \Configuration::updateValue("AGTI_BLING", $serializer->serialize($config, "json"));
        }

        exit();



        
        
        try {
         

            $this->loadProducts();
            foreach ($this->products as $product) {
                $this->handleProduct($product);
            }

            foreach ($this->variations as $variation) {
                $parentProduct = ProductEntityManager::findPsProductFromSku($variation->getParentCode());
                if (!$parentProduct->id) {
                    continue;
                }
                $this->handleProductVariation($variation, $parentProduct->id);
            }

        } catch (UnauthorizedException $e) {
            dump($e);
            AgClienteLogger::addLog("Erro de autenticação. O bling rejeitou o token da API com a mensagem {$e->getMessage()}.", 3);
        } catch (Exception $e) {
            dump($e);
            AgClienteLogger::addLog("Erro fatal: {$e->getMessage()}.", 3);
        }

        exit();
    }

    protected function loadProducts()
    {
        AgClienteLogger::addLog("Iniciando download dos novos produtos do Bling. Loja {$this->context->shop->id}.");

        if (!$this->config->getToken()) {
            throw new Exception("O token da API não foi configurado.");
        }

        $args = new ServiceArgsGetProducts;
        //não recebe as variações como produtos individuais, mas efetivamente como variações do produto pai
        $args->setIgnoreVariations(true);

        $service = new GetProducts;
        $service->setApiKey($this->config->getToken());

        AgClienteLogger::addLog("Baixando todos os produtos do Bling com o token {$this->config->getToken()}.");
        $products = $service->exec($args);
        AgClienteLogger::addLog("Total de produtos do Bling: " . count($products->getProducts()) . ".");

        $this->products = $products->getProducts();
        $this->variations = $products->getVariations();
    }

    protected function handleProduct(Product $product)
    {
        /** @var AgClienteWorker */
        global $agti_worker;
        // $agti_worker->save();
        
        $sku = $product->getCodigo();

        //produto no Bling está sem SKU; impossível integrar.
        if (!$sku) {
            AgClienteLogger::addLog("Produto sem SKU. Impossível integrar.");
            return;
        }

        \AgBlingProduct::publishSku($product->getCodigo());

        if (!CategoryEntityManager::existsInPs($product->getCategoria())) {
            return;
        }

        //verifica se o SKU já está no PS para a multiloja atual
        AgClienteLogger::addLog("Analisando SKU {$sku}.");
        $psProduct = ProductEntityManager::findPsProductFromSku($sku, $this->context->shop->id);

        $exists = Validate::isLoadedObject($psProduct);
        if (!(bool) $exists) {
            \AgClienteLogger::addLog("SKU não cadastrado na loja {$this->context->shop->id}.");
            //verifica se o SKU existe para alguma multiloja
            if (Validate::isLoadedObject(ProductEntityManager::findPsProductFromSku($sku))) {
                \AgClienteLogger::addLog("SKU já cadastrado no PrestaShop.");
                if ($this->config->getIsolateMultiShop()) {
                    ProductEntityManager::saveProductInPrestaShop($product);
                } else {
                    ProductEntityManager::saveProductInShop($product, $this->context->shop->id, $this->config->getSyncCategory());
                }
            } else {
                \AgClienteLogger::addLog("SKU não cadastrado no PrestaShop como um todo.");
                $product->createInPrestaShop();
            }
        } else {
            \AgClienteLogger::addLog("SKU já cadastrado no produto {$psProduct->id}.");
        }

        //trata combinações
        // if ((bool) $exists && count($product->getVariations())) {
        //     //busca o ID do produto
        //     $psProduct = ProductEntityManager::findPsProductFromSku($sku, $this->context->shop->id);
        //     foreach ($product->getVariations() as $variation) {
        //         $this->handleProductVariation($variation, $psProduct->id);
        //     }
        // }
    }

    protected function handleProductVariation(Variation $variation, int $idProduct)
    {
        if (!$variation->getCodigo()) {
            return;
        }

        \AgBlingProduct::publishSku($variation->getCodigo());

        //se o produto principal já existe verifica se ele possui combinações novas para que sejam criadas
        $idPA = VariationEntityManager::findIdProductAttributeFromSku($variation->getSku(), $this->context->shop->id);
        //verifica se alguma de suas combinações não existem no PrestaShop
        if (!(bool) $idPA) {
            $idPa = VariationEntityManager::findIdProductAttributeFromSku($variation->getSku());
             if ((bool) $idPa) {
                \AgClienteLogger::addLog("SKU já cadastrado no PrestaShop.");
                if ($this->config->getIsolateMultiShop()) {
                    variationEntityManager::saveInPrestaShop($variation, $idProduct);
                } else {
                    variationEntityManager::saveInShop($variation, $idProduct, $this->context->shop->id);
                }
            } else {
                \AgClienteLogger::addLog("SKU não cadastrado no PrestaShop como um todo.");
                variationEntityManager::saveInPrestaShop($variation, $idProduct);
            }

            AgClienteLogger::addLog("Combinação {$variation->getSku()} ainda não cadastrada na loja {$this->context->shop->id}.");
        } else {
            AgClienteLogger::addLog("Combinação {$variation->getSku()} já cadastrada no PrestaShop com ID {$idPA}.");
        }
    }
}
