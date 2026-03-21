<?php

use AGTI\Banner\Entity\Shop as EntityShop;
use AGTI\Bling\Application\Service\GetApiProduct;
use AGTI\Bling\Application\Service\SyncCategoryToPs;
use AGTI\Bling\Entity\AgblingCategory;
use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Entity\Attribute;
use AGTI\Bling\Entity\AttributeGroup;
use AGTI\Bling\Entity\AttributeGroupLang;
use AGTI\Bling\Entity\AttributeLang;
use AGTI\Bling\Entity\Lang;
use AGTI\Bling\Entity\Product;
use AGTI\Bling\Entity\ProductAttribute;
use AGTI\Bling\Entity\ProductAttributeCombination;
use AGTI\Bling\Entity\ProductAttributeShop;
use AGTI\Bling\Entity\ProductLang;
use AGTI\Bling\Entity\ProductShop;
use AGTI\Bling\Entity\Shop;
use AGTI\Bling\Entity\Variation;
use AGTI\Bling\EntityManager\ProductEntityManager;
use AGTI\Bling\EntityManager\VariationEntityManager;
use AGTI\Bling\Exception\UnauthorizedException;
use AGTI\Bling\Service\GetProducts;
use AGTI\Bling\Service\ServiceArgs\GetProducts as ServiceArgsGetProducts;
use AGTI\Bling\EntityManager\CategoryEntityManager;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Product as DataModelsProduct;
use AGTI\Bling\ValueObject\Configuration as ValueObjectConfiguration;

class agblingsyncProductsToPsModuleFrontController extends ModuleFrontController
{
    protected $config;
    protected $products = [];

    /** @var Variation[] */
    protected $variations = [];

    public function initContent()
    {
        $this->config = $this->get(ValueObjectConfiguration::class);
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/syncProductsToPs.log', 1);
        AgClienteLogger::addLog("Iniciando.");

        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
        if (is_null($token)) {
            AgClienteLogger::addLog("Falha de autenticação com o Bling; access token não gerado.");
            exit();
        }

        try {
            /** @var AgClienteWorker */
            $id_worker = Tools::getValue('id_agworker');
            global $agti_worker;
            $agti_worker = new AgClienteWorker($id_worker);
            $agti_worker->save();

            $em = $this->get('doctrine.orm.entity_manager');
            $products = $em->getRepository(AgblingProduct::class)->findBy(['inPs' => null], ['dateLastSync' => 'asc']);

            foreach ($products as $product) {
                $agti_worker->save();
                sleep(2);
                $product->setDateLastSync(new \DateTime);
                $em->flush();

                //obtém o produto do Bling
                $s = $this->get(GetApiProduct::class);
                $apiProduct = $s->exec($product->getIdRemote(), $token);
                // $apiProduct = $s->exec(16116074417, $token);

                
                //verifica se é um produto com combinação ou não
                AgClienteLogger::addLog("Processando produto de ID Remoto {$product->getIdRemote()}.");
                if ($apiProduct->getData()->getVariacao()) {
                    $this->handleCombination($apiProduct->getData());
                } else {
                    $this->handleProduct($apiProduct->getData());
                }
                $em->flush();


                // dump($apiProduct);
                // exit();
            }

        } catch (UnauthorizedException $e) {
            dump($e);
            AgClienteLogger::addLog("Erro de autenticação. O bling rejeitou o token da API com a mensagem {$e->getMessage()}.", 3);
        } catch (Exception $e) {
            dump($e);
            AgClienteLogger::addLog("Erro fatal: {$e->getMessage()}.", 3);
        }

        AgClienteLogger::addLog("Atualização dos produtos concluída.");
        exit();
    }

    protected function handleProduct(DataModelsProduct $product)
    {
        $em = $this->get('doctrine.orm.entity_manager');


        $ettCat = $em->getRepository(AgblingCategory::class)->findOneBy(['remoteId' => $product->getCategoria()->getId()]);
        $ettShop = $em->getRepository(Shop::class)->findOneBy(['id' => $this->context->shop->id]);

        if (!$ettCat) {
            AgClienteLogger::addLog("Pulando o produto porque a categoria não foi baixada do Bling ainda.");
            return;
        }

        if (!$ettCat->getPsCategory()) {
            $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
            $ettCat = $this->get(SyncCategoryToPs::class)->exec($ettCat, $token);
        }

        if (!$ettCat) {
            AgClienteLogger::addLog("Pulando o produto porque a categoria não foi cadastrada no PS ainda.");
            return;
        }
        
        //não cadastra produtos sem SKU
        if (!$product->getCodigo()) {
            AgClienteLogger::addLog("Pulando o produto porque ele não possui um SKU ainda.");
            return;
        }

        //sincroniza os dados do produto.
        // Aqui já sabemos que o produto existe na tabela agbling_product mas naõ sabemos se ele existe
        //na ps_product ou ps_product_shop para a multilooa atual
        $ettBlingProd = $em->getRepository(AgblingProduct::class)->findOneBy(['idRemote' => $product->getId()]);

        $ettBlingProd->setInPs = true;

        $ettPsProd = $em->getRepository(Product::class)->findOneBy(['reference' => $product->getCodigo()]);
        //se o produto não existir ainda, cria ele
        if (!$ettPsProd) {            
            $ettPsProd = new Product;
            $ettPsProd->setReference($product->getCodigo())
                ->setIdTaxRulesGroup(0)
                ->setState(1);

            $blingCategory = $em->getRepository(AgblingCategory::class)->findOneBy(['remoteId' => $product->getCategoria()->getId()]);

            if ($blingCategory) {
                $ettPsProd->setDefaultCategory($blingCategory->getPsCategory());
            }

            $em->persist($ettPsProd);

            $new = true;
        } else {
            $new = false;
        }

        $ettPsProd
            ->setPrice($product->getPreco())
            ->setActive($product->getSituacao() === 'A')
            ->setWeight($product->getPesoBruto())
            ->setWidth($product->getDimensoes()->getLargura())
            ->setHeight($product->getDimensoes()->getAltura())
            ->setDepth($product->getDimensoes()->getProfundidade());

        //se o produto não existir ainda na loja atual, cria ele

        $ettPsProdShop = $em->getRepository(ProductShop::class)->findOneBy(['product' => $ettPsProd, 'shop' => $ettShop]);
        
        if (!$ettPsProdShop) {
            $ettPsProdShop = new ProductShop;
            $ettPsProdShop->setProduct($ettPsProd)
                ->setShop($ettShop)
                ->setIdTaxRulesGroup(0);

            $em->persist($ettPsProdShop);
        }

        $ettPsProdShop
            ->setPrice($product->getPreco())
            ->setActive($product->getSituacao() === 'A');
            
            

        

        if ($this->config->getSyncProductDescription() || $new) {
            $langs = [];
            $ettLangs = $em->getRepository(Lang::class)->findAll();
            foreach ($ettLangs as $ettLang) {
                $ettProdLang = new ProductLang;
                $ettProdLang->setProduct($ettPsProd)
                    ->setLang($ettLang)
                    ->setName(str_replace(['^','<','>',';','=','#','{','}'], '', $product->getNome()))
                    ->setLinkRewrite(\Tools::link_rewrite($ettProdLang->getName()))
                    ->setDescriptionShort($product->getDescricaoCurta())
                    ->setDescription($product->getDescricaoComplementar());

                // $em->persist($ettProdLang);
                    
                $langs[] = $ettProdLang;
            }


            foreach ($ettPsProd->getLangs() as $lang) {
                $em->remove($lang);
            }
        }
        

        if (count($product->getImagens())) {
            //implementar o download das imagens
        }

        $em->flush();

        $ettPsProd->setLangs($langs);

        $em->flush();
        return;
        exit();
    }

    protected function handleCombination(DataModelsProduct $variation)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $lang = $em->getRepository(Lang::class)->findOneBy(['id' => $this->context->language->id]);


        $ettCat = $em->getRepository(AgblingCategory::class)->findOneBy(['remoteId' => $variation->getCategoria()->getId()]);
        $ettShop = $em->getRepository(Shop::class)->findOneBy(['id' => $this->context->shop->id]);
     

        $sku = $variation->getCodigo();
        if (!$sku) {
            AgClienteLogger::addLog("Pulando a combinação porque ela não possui um SKU.");
            return;
        }


        $parentProdEtt = $em->getRepository(AgblingProduct::class)->findOneBy(['idRemote' => $variation->getVariacao()->getProdutoPai()->getid()]);
        if (!$parentProdEtt) {
            AgClienteLogger::addLog("Pulando a combinação {$sku} porque o produto pai não foi baixado do Bling ainda..");
            return;
        }

        $parentProdPsEtt = $em->getRepository(Product::class)->findOneBy(['reference' => $parentProdEtt->getSku()]);
        if (!$parentProdPsEtt) {
            AgClienteLogger::addLog("Pulando a combinação {$sku} porque o produto pai não foi cadastrado no PS ainda.");
            return;
        }
        

        //verifica se já existe a combinação
        $pacEtt = $em->getRepository(ProductAttribute::class)->findOneBy(['reference' => $variation->getCodigo()]);
        if (is_null($pacEtt)) {
            AgClienteLogger::addLog("Combinação nova, cadastrando no PS.");
            $pacEtt = new ProductAttribute;
            $pacEtt->setProduct($parentProdPsEtt)
                ->setReference($variation->getCodigo())
                ->setLocation("");

            $pasEtt = new ProductAttributeShop;
            $pasEtt->setProductAttribute($pacEtt)
                ->setShop($ettShop)
                ->setProduct($parentProdPsEtt);

            $em->persist($pacEtt);
            $em->persist($pasEtt);
        } else {
            AgClienteLogger::addLog("Combinação existente. Nada a fazer.");
            return;
        }
        
        //separa os atributos do produto
        $variationSingle = $variation->getVariacao();
        $attributes = explode(';', $variationSingle->getNome());

        foreach ($attributes as $attribute) {
            $parts = explode(':', $attribute);

            //aqui, $parts é um array de dois elementos: o nome do grupo de atributos e o valor do atributo para esta combinação */
            //agora, faremos o cadastro dos grupos e dos atributos no PS

            $agl = $em->getRepository(AttributeGroupLang::class)->findOneBy(['name' => $parts[0], 'lang' => $lang]);
            AgClienteLogger::addLog("Atributo: {$attribute}.");

            if (is_null($agl)) {
                AgClienteLogger::addLog("Cadastrando Grupo de Atributos {$parts[0]}.");
                $ag = new AttributeGroup;

                $agl = new AttributeGroupLang;
                $agl->setLang($lang)
                    ->setName($parts[0])
                    ->setPublicName($parts[0])
                    ->setAttributeGroup($ag);

                $ag->addAttributeGroupLang($agl)
                    ->addShop($ettShop)
                    ->setIsColorGroup(false)
                    ->setGroupType(0)
                    ->setPosition(1);


                $em->persist($ag);
            } else {
                AgClienteLogger::addLog("Grupo de Atributos {$parts[0]} já cadastrado.");
            }


            $al = $em->getRepository(AttributeLang::class)->findOneBy(['name' => $parts[1], 'lang' => $lang]);
            
            if (is_null($al)) {
                AgClienteLogger::addLog("Cadastrando valor do atributo {$parts[1]}.");
                $a = new Attribute;

                $al = new AttributeLang;
                $al->setLang($lang);
                $al->setName($parts[1]);
                $al->setAttribute($a);
                //não existe o atributo, cadastra ele no PS

                $a->addShop($ettShop)
                    ->setAttributeGroup($agl->getAttributeGroup())
                    ->setColor(false)
                    ->setPosition(1);

                
                $em->persist($a);
                $em->persist($al);
            } else {
                AgClienteLogger::addLog("valor do atributo {$parts[1]} já cadastrado.");
            }


            //verifica se a combinação já existe no PS
            $pac = new ProductAttributeCombination;
            $pac->setAttribute($al->getAttribute())
                ->setProductAttribute($pacEtt);

            $pacEtt->addAttribute($pac);
            $em->persist($pacEtt);
        }



        $em->flush();
        return;
        exit();















        \AgBlingProduct::publishSku($sku);

        //variação não existe na loja atual, nada a atualizar
        $idPA = VariationEntityManager::findIdProductAttributeFromSku($sku, $this->context->shop->id);
        if (!$idPA) {
            return;
        }

        $parent = ProductEntityManager::findPsProductFromSku($variation->getParentCode(), $this->context->shop->id);
        if (!$parent->id) {
            $parent = ProductEntityManager::findPsProductFromSku($variation->getParentCode());
        }

        if (!$parent->id) {
            return;
        }

        VariationEntityManager::saveInShop($variation, $parent->id, $this->context->shop->id);
        if (!$this->config->getIsolateMultiShop()) {
            VariationEntityManager::saveInPrestaShop($variation, $parent->id);
        }

        global $agti_worker;
        $agti_worker->save();
    }
}