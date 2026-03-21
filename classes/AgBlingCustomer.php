<?php
class AgBlingCustomer extends AgObjectModel
{
    public static $definition = [
        'table' => 'agbling_customer',
        'primary' => 'id_agbling_customer',
        'fields' => [
            'id_agbling_customer' => array('type' => self::TYPE_INT,'validate' => 'isInt'),
            'in_bling' => array('type' => self::TYPE_BOOL, 'db_type' => 'boolean')
        ]
    ];

    public $id_agbling_customer;
    public $in_bling;
}