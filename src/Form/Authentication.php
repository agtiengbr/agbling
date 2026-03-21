<?php

namespace AGTI\Bling\Form;

use AGTI\Bling\Entity\Configuration;
use AGTI\Bling\ValueObject\ApiToken;
use AGTI\Cliente\Form\Form;
use HelperForm;

class Authentication extends Form
{
    protected $submitButton = 'agbling-authentication-submit';

    public function renderHtml()
    {
        $token = $this->module->get(ApiToken::class);

        \Context::getContext()->smarty->assign([
            'authenticated' => !is_null($token) && !is_null($token->getToken()),
            'auth_url' => \Context::getContext()->link->getModuleLink('agbling', 'auth')
        ]);

        return $this->module->display($this->module->getPathUri(), 'configuration_form.tpl');
    }

    public function postProcess()
    {
        if (\Tools::isSubmit($this->submitButton)) {
            $this->persistData();
        }
    }


    protected function fillForm(HelperForm $form)
    {
        
    }
 
    protected function persistData()
    {
    }
}