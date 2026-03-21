<?php

function upgrade_module_2_2_0($module)
{
    $module->remakeWorkers();

    $classes = [
        'AgBlingAccountsReceivable',
        'AgBlingBillToReceive',
        'AgBlingOrderState'
    ];

    foreach ($classes as $class) {
        require_once _PS_MODULE_DIR_ . 'agbling/classes/' . $class . '.php';
        $class = new $class;
        $class->createMissingColumns();
        $class->createIndexes();
    }

    return true;
}