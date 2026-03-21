<?php

namespace AGTI\Bling\Form;

use AGTI\Bling\Entity\Configuration as EntityConfiguration;
use AGTI\Cliente\Form\Form;
use HelperForm;

class Customer extends Form
{
    protected $submitButton = 'agbling-customer-submit';

    public function renderHtml()
    {
        $inputs = [
            [
                'type' => 'switch',
                'label' => 'Baixar automaticamente os clientes do Bling para o PrestaShop',
                'name' => 'AGBLING_AUTO_DOWNLOAD_NEW_CUSTOMERS',
                'desc' => 'Essa opção fará a criação dos clientes em seu PrestaShop que estiverem no Bling e ainda não existirem em sua loja.',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_AUTO_DOWNLOAD_NEW_CUSTOMERS_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_AUTO_DOWNLOAD_NEW_CUSTOMERS_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ],
            [
                'type' => 'switch',
                'label' => 'Atualizar automaticamente os clientes do Bling para o PrestaShop',
                'name' => 'AGBLING_AUTO_DOWNLOAD_OLD_CUSTOMERS',
                'desc' => 'Essa opção fará a atualização dos clientes em seu PrestaShop conforme os seus dados sejam modificados no Bling',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_AUTO_DOWNLOAD_OLD_CUSTOMERS_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_AUTO_DOWNLOAD_OLD_CUSTOMERS_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ],
            [
                'type' => 'switch',
                'label' => 'Enviar automaticamente os clientes do PrestaShop para o Bling',
                'name' => 'AGBLING_AUTO_UPLOAD_NEW_CUSTOMERS',
                'desc' => 'Essa opção fará a criação dos clientes em seu PrestaShop que estiverem no PrestaSHop e ainda não existirem no Bling.',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_AUTO_UPLOAD_NEW_CUSTOMERS_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_AUTO_UPLOAD_NEW_CUSTOMERS_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ],
            [
                'type' => 'switch',
                'label' => 'Atualizar automaticamente os clientes do PrestaShop para o Bling',
                'name' => 'AGBLING_AUTO_UPLOAD_OLD_CUSTOMERS',
                'desc' => 'Essa opção atualizará automaticamente os produtos no Bling com os dados existentes em sua loja.',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_AUTO_UPLOAD_OLD_CUSTOMERS_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_AUTO_UPLOAD_OLD_CUSTOMERS_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ]
        ];

        $forms = [[
            'form' => [
                'legend' => ['title' => 'Clientes'],
                'input' => $inputs,
                'submit' => ['title' => 'Salvar', 'name' => $this->submitButton]
            ]
        ]];

        $form = $this->getHelperForm();
        $this->fillForm($form);

        return $form->generateForm($forms);
    }

    public function postProcess()
    {
        if (\Tools::isSubmit($this->submitButton)) {
            $this->persistData();
        }
    }


    protected function fillForm(HelperForm $form)
    {
        $config = new EntityConfiguration;
        $config->loadConfig();

        $form->fields_value['AGBLING_AUTO_DOWNLOAD_NEW_CUSTOMERS'] = $config->getAutoDownloadNewCustomers();
        $form->fields_value['AGBLING_AUTO_DOWNLOAD_OLD_CUSTOMERS'] = $config->getAutoDownloadOldCustomers();
        $form->fields_value['AGBLING_AUTO_UPLOAD_NEW_CUSTOMERS'] = $config->getAutoUploadNewCustomers();
        $form->fields_value['AGBLING_AUTO_UPLOAD_OLD_CUSTOMERS'] = $config->getAutoUploadOldCustomers();
    }
 
    protected function persistData()
    {
        $config = new EntityConfiguration;
        $config->loadConfig();

        $config->setAutoDownloadNewCustomers(\Tools::getValue('AGBLING_AUTO_DOWNLOAD_NEW_CUSTOMERS'));
        $config->setAutoDownloadOldCustomers(\Tools::getValue('AGBLING_AUTO_DOWNLOAD_OLD_CUSTOMERS'));
        $config->setAutoUploadNewCustomers(\Tools::getValue('AGBLING_AUTO_UPLOAD_NEW_CUSTOMERS'));
        $config->setAutoUploadOldCustomers(\Tools::getValue('AGBLING_AUTO_UPLOAD_OLD_CUSTOMERS'));
        
        $config->persist();
    }
}