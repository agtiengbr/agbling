<?php

use AGTI\Bling\Utils\SkuGenerator\SkuGeneratorFactory;
use AGTI\Bling\EntityManager\VariationEntityManager;

class AdminAgBlingProductsController extends ModuleAdminController
{
    protected $products;
    protected $qtyProducts;

    public function __construct()
    {
        $this->bootstrap        = true;
        $this->table            = 'agbling_product';
        $this->className        = 'AgBlingProduct';
        $this->identifier       = 'id_agbling_product';
        $this->list_no_link     = true;
        $this->_defaultOrderBy  = 'date_last_sync';
        $this->_defaultOrderWay = 'ASC';


        parent::__construct();

        $this->bootstrap = true;
    }

    public function init()
    {
        parent::init();

        $this->fields_list = [
            'id_agbling_product' => [
                'title' => 'ID'
            ],
            'sku' => [
                'title' => 'SKU'
            ],
            'id_remote' => [
                'title' => 'ID Bling'
            ],
            'in_ps' => [
                'title' => 'Integrado ao PrestaShop',
                'type' => 'boolean',
                'active' => 'in_ps'
            ],
            'date_last_sync' => [
                'title' => 'Data da última Sincronização',
                'type' => 'datetime'
            ]
        ];
    }
}