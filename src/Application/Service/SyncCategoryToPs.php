<?php
namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgblingCategory;
use AGTI\Bling\Entity\Category;
use AGTI\Bling\Entity\CategoryLang;
use AGTI\Bling\Entity\Lang;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\GetCategory\GetProductsCategoryService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\GetCategory\GetProductsCategoryServiceArgs;
use Doctrine\ORM\EntityManagerInterface;

class SyncCategoryToPs
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(GetProductsCategoryService $apiService, EntityManagerInterface $em)
    {
        $this->apiService = $apiService;
        $this->em = $em;
    }

    public function exec(AgblingCategory $category, $token)
    {
        $args = new GetProductsCategoryServiceArgs;
        $args->setId($category->getRemoteId());
        
        $this->apiService->setToken($token);
        $remoteCategory = $this->apiService->exec($args);
        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        //se a categoria tem uma categoria pai verifica se ela já está no PS ou não
        if ($remoteCategory->getData()->getCategoriaPai() && $remoteCategory->getData()->getCategoriaPai()->getId()) {
            //se a categoria pai não estiver no PS ainda, sincroniza ela antes
            $remoteCategoryEtt = $this->em->getRepository(AgblingCategory::class)->findOneBy(['remoteId' => $remoteCategory->getData()->getCategoriaPai()->getId()]);

            //se a categoria remota não tiver sido baixada ainda, aborta
            if (is_null($remoteCategoryEtt)) {
                return;
            }

            $remoteCategoryEtt = $this->exec($remoteCategoryEtt, $token);

            //se não conseguiu integrar a categoria pai, aborta
            if (!$remoteCategoryEtt) {
                return;
            }
        }

        //se a categoria do PS não foi criada ainda, cria ela antes de atualizar os dados
        if ($category->getPsCategory() === null) {
            $cat = new Category;
            $this->em->persist($cat);


            if ($remoteCategory->getData()->getCategoriaPai() && $remoteCategory->getData()->getCategoriaPai()->getId()) {
                $cat->setIdParent($remoteCategoryEtt->getPsCategory()->getId());
            } else {
                $cat->setIdParent(\Configuration::get("PS_HOME_CATEGORY"));
            }

            $category->setPsCategory($cat);


            //cria os objetos multi-idiomas
            $langs = $this->em->getRepository(Lang::class)->findAll();
            foreach ($langs as $lang) {
                $cl =     new CategoryLang;
                $cl
                ->setLang($lang)
                ->setCategory($cat)
                ->setName($remoteCategory->getData()->getDescricao())
                ->setLinkRewrite("");

                $this->em->persist($cl);
                $this->em->flush();
                $cat->addLang($cl);
            }
        } else {
            $cat = $category->getPsCategory();
        }

 
        //atualiza o nome da categoria
        foreach ($cat->getLangs() as $catLang) {
            $catLang->setName($remoteCategory->getData()->getDescricao());
        }

        return $category;
    }
}