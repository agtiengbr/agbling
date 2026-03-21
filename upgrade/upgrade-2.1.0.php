<?php

function upgrade_module_2_1_0($module)
{
    require_once _PS_MODULE_DIR_ . 'agbling/classes/AgBlingApiRequest.php';

    $class = new AgBlingApiRequest;
    $class->createMissingColumns();

    return true;
}