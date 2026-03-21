<?php

class AgBlingCategory extends AgObjectModel
{
    public static $definition = array(
        'table'     => 'agbling_category',
        'primary'   => 'id_agbling_category',
        'multilang' => false,
        'fields'    => array(
            'id_agbling_category' => array('type' => self::TYPE_INT,'validate' => 'isInt'),
            'id_category' => array('type' => self::TYPE_INT,'validate' => 'isInt', 'db_type' => 'int'),
            'id_bling' => array('type' => self::TYPE_INT,'validate' => 'isInt', 'db_type' => 'int'),
            'id_bling_parent_category'=> array('type' => self::TYPE_INT,'validate' => 'isInt', 'db_type' => 'int'),
        )
    );

    public $id_agbling_category;
    public $id_category;
    public $id_bling;
    public $id_bling_parent_category;

}