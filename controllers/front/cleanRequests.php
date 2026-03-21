<?php

class agblingcleanRequestsModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        Db::getInstance()->delete('agbling_request', 'date_add<"' . date("Y-m-d H:i:s", strtotime("-7 days")) . '"');
        exit();
    }
}