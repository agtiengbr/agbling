<?php

//a integraçao entre os produtos do PS e do Bling
class AgBlingProduct extends AgObjectModel
{
    public static $definition = array(
        'table'     => 'agbling_product',
        'primary'   => 'id_agbling_product',
        'multilang' => false,
        'fields'    => array(
            'id_agbling_product' => array('type' => self::TYPE_INT,'validate' => 'isInt'),
            'sku' => array('type' => self::TYPE_STRING, 'db_type' => 'varchar(64)', 'required' => true),
            'id_remote' => array('type' => self::TYPE_INT, 'db_type' => 'bigint'),
            'published'=> array('type' => self::TYPE_BOOL, 'db_type' => 'bool', 'default' => 0),
            'in_ps'=> array('type' => self::TYPE_BOOL, 'db_type' => 'bool', 'default' => 0),
            'date_last_sync' => ['type' => self::TYPE_DATE, 'db_type' => 'datetime']
        ),
        'indexes' => [
            [
                'name' => 'uniqueness',
                'fields' => ['sku'],
                'prefix' => 'unique'
            ],
            [
                'name' => 'idx_published',
                'fields' => ['published']
            ]
        ]
    );

    public $id_agbling_product;
    public $sku;
    public $published;
    public $in_ps;
    public $date_last_sync;

    public static function publishSku(string $sku)
    {
        $col = new PrestaShopCollection('AgBlingProduct');
        $col->where('sku', '=', $sku);
        $obj = $col->getFirst();

        if (!Validate::isLoadedObject($obj)) {
            $obj = new AgBlingProduct;
            $obj->sku = $sku;
        }

        $obj->published = 1;
        $obj->save();
    }

    public static function getFromSku(string $sku):AgBlingProduct
    {
        $col = new PrestaShopCollection('AgBlingProduct');
        $col->where('sku', '=', $sku);
        
        $r = $col->getFirst();
        return new AgBlingProduct(@$r->id);
    }
}