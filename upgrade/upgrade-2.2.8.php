<?php

function upgrade_module_2_2_8($module)
{
    // id_agbling_order is the module's local primary key. It must be generated
    // locally; id_remote remains the value received from Bling.
    return Db::getInstance()->execute(
        'ALTER TABLE `' . _DB_PREFIX_ . 'agbling_order` '
        . 'MODIFY `id_agbling_order` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT'
    );
}
