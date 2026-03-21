<?php

class AgBlingAccountsReceivable extends ObjectModel
{
    public $id;
    public $bling_id;
    public $data_emissao;
    public $valor;
    public $data_vencimento;
    public $situacao;

    public static $definition = [
        'table' => 'agbling_accounts_receivable',
        'primary' => 'id',
        'fields' => [
            'bling_id' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'data_emissao' => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'required' => true],
            'valor' => ['type' => self::TYPE_FLOAT, 'validate' => 'isPrice', 'required' => true],
            'data_vencimento' => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'required' => true],
            'situacao' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
        ],
    ];
}
