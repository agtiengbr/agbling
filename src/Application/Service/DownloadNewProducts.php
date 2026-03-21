<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts\ListProducts;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts\ListProductsArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts\ListProductsResponseSuccess;
use AGTI\Bling\Application\Exception\HttpCodeException;
use Doctrine\ORM\EntityManagerInterface;

class DownloadNewProducts
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(ListProducts $apiService, EntityManagerInterface $em)
    {
        $this->apiService = $apiService;
        $this->em = $em;
    }

    public function exec($token)
    {
        if (!$this->configuration->getSyncProductData()) {
            \AgClienteLogger::addLog("Sincronização de dados dos produtos está desativada.");
            return;
        }

        $this->apiService->setToken($token);

        $args = new ListProductsArgs;
    
        //todos os produtos
        $page = 1;

        $args->setCriteria(5);

        while(1) {
            \AgClienteLogger::addLog("Página {$page}.");
            $args->setPage($page);
            /** @var ListProductsResponseSuccess */
            $r = $this->apiService->exec($args);
            try {
                $this->postApiRequest($this->apiService->getRequest(), $this->em);
            } catch (HttpCodeException $e) {
                if ($e->getHttpCode() == 429) {
                    sleep(1);
                    continue;
                }
            }


            if (!is_null($r) && is_array($r->getData()) && count($r->getData())) {
                $page++;
                //salva os produtos na tabela local do Bling. Se encontrar um produto que já foi salvo, ignora todos os demais, pois podemos assumir que também já foram salvos
                foreach ($r->getData() as $prod) {
                    if (!$prod->getCodigo()) {
                        continue;
                    }

                \AgClienteLogger::addLog("processando SKU {$prod->getCodigo()}.");

                    $ett = $this->em->getRepository(AgblingProduct::class)->findOneBy(['sku' => $prod->getCodigo()]);
                    if (!is_null($ett)) {
                        continue;;
                    }
                    
                    $ett = new AgblingProduct;
                    $ett->setSku($prod->getCodigo())
                        ->setPublished(true)
                        ->setIdRemote($prod->getId());

                    $this->em->persist($ett);
                    $this->em->flush();
                }
            } else {
                dump('zerou');
                break;
            }
        }

        $this->em->flush();
    }
}