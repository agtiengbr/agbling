<?php

use AGTI\Bling\Application\Exception\UnauthorizedHttpException;
use AGTI\Bling\Application\Service\DownloadNewCategories;
use AGTI\Bling\Entity\Category;
use AGTI\Bling\Entity\Configuration;
use AGTI\Bling\EntityManager\CategoryEntityManager;
use AGTI\Bling\Infrastructure\Serializer\Serializer;
use AGTI\Bling\Service\GetCategories;

class agblingdownloadNewCategoriesModuleFrontController extends ModuleFrontController
{
    protected $config;
    protected $categories = [];
    protected $categoriesTree = [];

    public function initContent()
    {
        
        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/downloadNewCategories.log', 1);


        $config = $this->get(AGTI\Bling\ValueObject\Configuration::class);

        //se o download de novos produtos não estiver habilitado, ignora o controlador
        if (!$config->getProductOrigin() === 'bling') {
            AgClienteLogger::addLog("Matriz de Produtos não é o Bling.");
            exit();
        }


        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
        if (is_null($token)) {
            AgClienteLogger::addLog("Falha de autenticação com o Bling; access token não gerado.");
            exit();
        }

        try {
            $s = $this->get(DownloadNewCategories::class);

            AgClienteLogger::addLog("Iniciando serviço da Aplicação.");
            $s->exec($token);
            AgClienteLogger::addLog("Serviço da Aplicação finalizado.");

        } catch (UnauthorizedHttpException $e) {
            $config = $this->get(AGTI\Bling\ValueObject\Configuration::class);
            $config->setToken($config->getToken()->setToken(null));
            $serializer = $this->get(Serializer::class);

            AgClienteLogger::addLog("Falha de autenticação com o Bling retornado pela API.");

            \Configuration::updateValue("AGTI_BLING", $serializer->serialize($config, "json"));
        }

        exit();


        AgClienteLogger::addLog("Iniciando download das categorais do Bling.");

        parent::initContent();

        $service = new GetCategories;
        $service->setApiKey($this->config->getToken());
        $this->categories = $service->exec()->getCategories();
        AgClienteLogger::addLog(count($this->categories) . ' categorias encontradas.');

        
        //indexa as categorias da raiz até as folhas
        $this->categoriesTree = [];
        foreach ($this->categories as $category ){
            $this->categoriesTree[$category->getIdCategoriaPai()][] = $category;
        }

        $this->handleCategoryTree($this->categoriesTree[0]);
        AgClienteLogger::addLog("Finalizando download das categorais do Bling.");

        exit();
    }

    protected function handleCategoryTree(array $categories)
    {
        /** @var Category */
        foreach ($categories as $category) {
            if (!CategoryEntityManager::existsInPs($category)) {
                CategoryEntityManager::createInPrestaShop($category);
            }

            if (isset($this->categoriesTree[$category->getId()])) {
                $this->handleCategoryTree($this->categoriesTree[$category->getId()]);
            }
        }
    }
}