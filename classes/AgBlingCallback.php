<?php
class AgBlingCallback extends AgObjectModel
{
    public static $definition = [
        'table' => 'agbling_callback',
        'primary' => 'id_agbling_callback',
        'fields' => [
            'id_agbling_callback' => array('type' => self::TYPE_INT,'validate' => 'isInt'),
            'type' => ['type'=> self::TYPE_STRING, 'db_type' => 'varchar(32)'],
            'id_object' => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(32)'],
            'processed' => ['type' => self::TYPE_BOOL, 'db_type' => 'boolean'],
            'qty_tentatives' => ['type' => self::TYPE_INT, 'db_type' => 'int'],
            'date_add' => ['type' => self::TYPE_DATE, 'db_type' => 'datetime'],
            'date_next_tentative' => ['type' => self::TYPE_DATE, 'db_type' => 'datetime']
        ]
    ];

    public $id_agbling_callback;
    public $type;
    public $id_object;
    public $processed;
    public $qty_tentatives;
    public $date_add;
    public $date_next_tentative;

    public static function getNext()
    {
        $sql = new DbQuery;
        $sql->from('agbling_callback')
            ->where('processed=0')
            ->where('date_next_tentative < "' . date('Y-m-d H:i:s') . '"')
            ->orderBy('date_next_tentative ASC')
            ->select('id_agbling_callback');

        $id = Db::getInstance()->getValue($sql);
        $obj = new AgBlingCallback($id);

        return $obj;
    }
}