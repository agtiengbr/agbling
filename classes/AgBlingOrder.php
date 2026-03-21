<?php

//a integraçao entre os produtos do PS e do Bling
class AgBlingOrder extends AgObjectModel
{
    public static $definition = array(
        'table'     => 'agbling_order',
        'primary'   => 'id_agbling_order',
        'multilang' => false,
        'fields'    => array(
            'id_agbling_order' => array('type' => self::TYPE_INT,'validate' => 'isInt'), //bigint!
            'id_ps' => ['type' => self::TYPE_INT, 'db_type' => 'int unsigned'],
            'id_remote'=> array('type' => self::TYPE_INT, 'db_type' => 'bigint', 'default' => 0),
        ),
        'indexes' => [
            [
                'fields' => ['id_ps'],
                'prefix' => 'unique',
                'name' => 'uniqueness'
            ]
        ]
    );

    public $id_agbling_product;
    public $id_ps;
    public $in_remote;
    public $send_to_bling;
}