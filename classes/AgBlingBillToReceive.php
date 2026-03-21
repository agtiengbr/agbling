<?php

//a integraçao entre os produtos do PS e do Bling
class AgBlingBillToReceive extends AgObjectModel
{
    public static $definition = array(
        'table'     => 'agbling_bill_to_receive',
        'primary'   => 'id_agbling_bill_to_receive',
        'multilang' => false,
        'fields'    => array(
            'id_agbling_bill_to_receive' => ['type' => self::TYPE_INT,'validate' => 'isInt'],
            'id_bling'                   => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'situacao'                   => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'dataEmissao'                => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'db_type'  => 'date'],
            'vencimentoOriginal'         => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'db_type'  => 'date'],
            'vencimento'                 => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'db_type'  => 'date'],
            'competencia'                => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'db_type'  => 'date'],
            'nroDocumento'               => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'valor'                      => ['type' => self::TYPE_FLOAT, 'db_type' => 'float'],
            'saldo'                      => ['type' => self::TYPE_FLOAT, 'db_type' => 'float'],
            'historico'                  => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'categoria'                  => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'idFormaPagamento'           => ['type' => self::TYPE_STRING,'validate' => 'isInt', 'db_type' => 'int'],
            'portador'                   => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'linkBoleto'                 => ['type' => self::TYPE_STRING,'db_type' => 'varchar(2048)'],
            'vendedor'                   => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'pagamento'                  => ['type' => self::TYPE_STRING,'db_type' => 'varchar(280)'],
            'ocorrencia'                 => ['type' => self::TYPE_STRING,'db_type' => 'varchar(120)'],
            'cliente'                    => ['type' => self::TYPE_INT,'validate' => 'isInt', 'db_type' => 'int'],
            'pedido'                     => ['type' => self::TYPE_INT,'validate' => 'isInt', 'db_type' => 'int'],
            'dataPagamento'              => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'db_type'  => 'date']

        ),
    );

    public $id_agbling_bill_to_receive;
    public $id_bling;
    public $situacao;
    public $dataEmissao;
    public $vencimentoOriginal;
    public $vencimento;
    public $competencia;
    public $nroDocumento;
    public $valor;
    public $saldo;
    public $historico;
    public $categoria;
    public $idFormaPagamento;
    public $portador;
    public $linkBoleto;
    public $vendedor;
    public $pagamento;
    public $ocorrencia;
    public $cliente;
    public $pedido;
    public $dataPagamento;

}