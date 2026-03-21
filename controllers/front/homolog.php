<?php

use AGTI\Bling\Infrastructure\Service\Api\Bling\Homologacao\Produtos\HomologacaoProdutosService;

class agblinghomologModuleFrontController extends ModuleFrontController
{
    public function init()
    {
        parent::init();

        $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);
        
        $s = $this->get(HomologacaoProdutosService::class);
        $s->setToken($token);
        $r = $s->exec();
        dump($r);

        exit(); 
    }
}