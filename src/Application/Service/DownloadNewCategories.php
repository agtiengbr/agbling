<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Application\Exception\HttpCodeException;
use Doctrine\ORM\EntityManagerInterface;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\ListCategories\ListProductsCategoriesService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\ListCategories\ListProductsCategoriesServiceArgs;
use AGTI\Bling\Entity\AgblingCategory;

class DownloadNewCategories
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(ListProductsCategoriesService $apiService, EntityManagerInterface $em)
    {
        $this->apiService = $apiService;
        $this->em = $em;
    }

    public function exec($token)
    {
        $this->apiService->setToken($token);

        $args = new ListProductsCategoriesServiceArgs;

        $page = 0;

        $parents = [];
        while(1) {
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


            if (count($r->getData())) {
                $page++;
                foreach ($r->getData() as $cat) {
                    $ett = $this->em->getRepository(AgblingCategory::class)->findOneBy(['remoteId' => $cat->getId()]);
                    if (!is_null($ett)) {
                        continue;
                    }
                    
                    
                    $ett = new AgblingCategory;
                    $ett->setRemoteId($cat->getId());
                    $this->em->persist($ett);


                    if ($cat->getCategoriaPai()) {
                        $parents[$cat->getId()] = $cat->getCategoriaPai()->getId();
                    }
                }
            } else {
                break;
            }
        }

        $this->em->flush();


        //atualiza o id_parent de cada categoria
        $ett = $this->em->getRepository(AgblingCategory::class)->findAll();
        foreach ($ett as $cat) {
            if (isset($parents[$cat->getId()])) {
                $parent = $this->em->getRepository(AgblingCategory::class)->findOneBy(['remoteId' => $parents[$cat->getId()]]);
                $cat->setParentcategory($parent);
            }
        }

        $this->em->flush();
    }
}