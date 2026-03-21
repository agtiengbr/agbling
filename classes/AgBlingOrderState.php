<?php

class AgBlingOrderState extends ObjectModel
{
    public $id;
    public $id_modulo_sistema;
    public $id_empresa;
    public $nome;
    public $valor;
    public $cor;
    public $interna;
    public $id_herdado;
    public $id_remote;

    public static $definition = [
        'table' => 'ag_bling_order_state',
        'primary' => 'id',
        'fields' => [
            'id_modulo_sistema' => ['type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true],
            'id_empresa' => ['type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true],
            'nome' => ['type' => self::TYPE_STRING, 'validate' => 'isString', 'required' => true, 'size' => 255],
            'valor' => ['type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 255],
            'cor' => ['type' => self::TYPE_STRING, 'validate' => 'isColor', 'required' => true, 'size' => 7],
            'interna' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'id_herdado' => ['type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true],
            'id_remote' => ['type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true],
        ],
    ];
}
