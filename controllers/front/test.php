<?php

use AGTI\Bling\Application\Service\DownloadNewProducts;
use AGTI\Bling\Application\Service\GetApiOrder;
use AGTI\Bling\Application\Service\SearchContactByDocument;
use AGTI\Bling\Application\Service\SendNewContact;
use AGTI\Bling\Application\Service\SendNewOrder;
use AGTI\Bling\Application\Service\UpdateContact;
use AGTI\Bling\Application\Service\CreateOrderState;
use AGTI\Bling\Entity\AgblingProduct;
use AGTI\Bling\Entity\Orders;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\GetCategory\GetProductsCategoryService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\GetCategory\GetProductsCategoryServiceArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts\ListProductsArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\ListProducts\ListProducts;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\ListCategories\ListProductsCategoriesService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\ListCategories\ListProductsCategoriesServiceArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque\ListaEstoquesService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Estoque\ListaEstoquesServiceArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Orders\CreateOrder\CreateOrderService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\GetProduct\GetProduct;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Produtos\GetProduct\GetProductArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\AccountsReceivable\GetAccountsReceivableService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\AccountsReceivableArgs;
use AGTI\Bling\Application\Service\GetContasContabeis;

class agblingtestModuleFrontController extends ModuleFrontController
{
    public function init()
    {
        parent::init();

        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);

        $em = $this->get('doctrine.orm.entity_manager');

        // Chamar o serviço da aplicação que obtém as contas contábeis
        $getContasContabeisService = $this->get(GetContasContabeis::class);
        $getContasContabeisService->exec($token);
exit();
        // $s = $this->get(ListProducts::class);
        // $s->setToken($token);

        // $args = new ListProductsArgs;

        // //últimos incluídos
        // $args->setCriteria(1);

        // $r = $s->exec($args);

        // $s = $this->get(DownloadNewProducts::class);
        // $s->exec($token);

        // $s = $this->get(AGTI\Bling\Application\Service\DownloadNewCategories::class);
        // $s->exec($token);

        // $s = $this->get(GetProduct::class);

        // $products =$em->getRepository(AgblingProduct::class)->findAll();

        // $args = new GetProductArgs;
        // $args->setId($products[0]->getIdRemote());
        // $s->setToken($token);
        // $r = $s->exec($args);

        // $s = $this->get(ListaEstoquesService::class);
        // $args = new ListaEstoquesServiceArgs;
        // $args->setIds([16171069606, 16079311820, 3]);
        
        // $s->setToken($token);
        // $r = $s->exec($args);

        // $s = $this->get(GetProductsCategoryService::class);
        // $s->setToken($token);

        // $args = new GetProductsCategoryServiceArgs;
        // $args->setId(8606500);

        // $r = $s->exec($args);
        // dump($r);

        // dump($r);

        // $s = $this->get(SendNewOrder::class);
        // $orders = $em->getRepository(Orders::class)->findAll();

        // $order = $orders[0];

        // // verifica se o contato já existe
        // $searchContact = $this->get(SearchContactByDocument::class);
        // $contact = $searchContact->exec($order->getCustomer(), $token);

        // if (is_null($contact)) {
        //     // cria o contato
        //     $sContact = $this->get(SendNewContact::class);
        //     $sContact->exec($order->getCustomer(), $token, $order);
        // } else {
        //     // atualiza o contato
        //     $sContact = $this->get(UpdateContact::class);
        //     $sContact->exec($order->getCustomer(), $contact, $token, $order);
        // }

        // $s->exec($order, $token);

        // $this->get(GetApiOrder::class)->exec(20491797181, $token);

        // Cria uma forma de pagamento no Bling chamada "PrestaShop - Aguardando Pagamento"
        // $createOrderStateService = $this->get(CreateOrderState::class);
        // $data = [
        //     'nome' => 'PrestaShop - Cancelado',
        // //     'idModuloSistema' => 98310,
        // //     'idHerdado' => 6,
        // //     'cor' => '#ffffff'
        // // ];
        // // $response = $createOrderStateService->exec($data, $token);

        // // List a page of 100 accounts receivable
        // $args = (new AccountsReceivableArgs())
        //     ->setPagina(1)
        //     ->setLimite(100)
        //     ->setSituacoes([])
        //     ->setTipoFiltroData('E')
        //     ->setDataInicial(new \DateTime('2025-01-01'))
        //     ->setDataFinal(new \DateTime('2025-02-14'));

        // $service = $this->get(GetAccountsReceivableService::class);
        // $service->setToken($token);
        // $response = $service->exec($args);

        // dump($response);

        
    }
}