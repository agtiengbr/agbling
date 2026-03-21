<?php

namespace AGTI\Bling\Form;

use AGTI\Bling\ValueObject\Configuration as VBConfiguration;
use AGTI\Cliente\Form\Form;
use HelperForm;

class Configuration extends Form
{
    protected $submitButton = 'agbling-configuration-submit';
    private $configuration;
    
    public function renderHtml()
    {
        $inputs = [
            // [
            //     'type' => 'switch',
            //     'label' => 'Atualizar as categorias dos produtos baixados do Bling',
            //     'desc' => 'Se você ativar essa opção, você não poderá atualizar as categorias dos produtos no PrestaShop. As categorias serão espelhadas conforme configuradas no Bling.',
            //     'name' => 'AGBLING_SYNC_CATEGORY',
            //     'values' => array(
            //         array(
            //             'id'    => 'AGBLING_SYNC_CATEGORY_on',
            //             'value' => 1,
            //             'label' => 'Sim',
            //         ),
            //         array(
            //             'id'    => 'AGBLING_SYNC_CATEGORY_off',
            //             'value' => 0,
            //             'label' => 'Não',
            //         ),
            //     )
            // ],
            [
                'type' => 'switch',
                'label' => 'Sincronizar a Descrições e o título dos Produtos:',
                'desc' => 'Se você ativar essa opção, a descrição e  o título dos produtos do PrestaShop serão sempre atualizadas para refletir o texto configurado no Bling.',
                'name' => 'AGBLING_SYNC_PRODUCT_DESCRIPTION',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_SYNC_PRODUCT_DESCRIPTION_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_SYNC_PRODUCT_DESCRIPTION_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ],
            [
                'type' => 'text',
                'label' => 'ID do Primeiro Pedido a ser enviado ao Bling:',
                'name' => 'AGBLING_ID_FIRST_ORDER_TO_SEND',
            ],
            [
                'type' => 'switch',
                'label' => 'Sincronizar dados dos produtos:',
                'desc' => 'Se ativado, os dados dos produtos do PrestaShop serão sincronizados com os do Bling através do SKU do produto.',
                'name' => 'AGBLING_SYNC_PRODUCT_DATA',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_SYNC_PRODUCT_DATA_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_SYNC_PRODUCT_DATA_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ],
            [
                'type' => 'switch',
                'label' => 'Sincronizar estoque:',
                'desc' => 'Se ativado, o estoque dos produtos será sincronizado com o Bling através do SKU do produto.',
                'name' => 'AGBLING_SYNC_STOCK',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_SYNC_STOCK_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_SYNC_STOCK_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ],
            [
                'type' => 'switch',
                'label' => 'Enviar pedidos para o Bling:',
                'desc' => 'Se desativado, os pedidos do PrestaShop não serão enviados para o Bling.',
                'name' => 'AGBLING_SEND_ORDERS',
                'values' => array(
                    array(
                        'id'    => 'AGBLING_SEND_ORDERS_on',
                        'value' => 1,
                        'label' => 'Sim',
                    ),
                    array(
                        'id'    => 'AGBLING_SEND_ORDERS_off',
                        'value' => 0,
                        'label' => 'Não',
                    ),
                )
            ]
        ];


        // if (\Shop::isFeatureActive()) {
        //     $inputs[] = [
        //         'type' => 'switch',
        //         'label' => 'Tratar as multilojas como lojas isoladas',
        //         'name' => 'AGBLING_ISOLATE_MULTISHOP',
        //         'desc' => 'Se ativada, produtos com o mesmo SKU em cada conta configurada no Bling gerarão produtos diferentes no PrestaShop; se desativada, o mesmo produto será compartilhado entre todas as multilojas.',
        //         'values' => array(
        //             array(
        //                 'id'    => 'AGBLING_ISOLATE_MULTISHOP_on',
        //                 'value' => 1,
        //                 'label' => 'Sim',
        //             ),
        //             array(
        //                 'id'    => 'AGBLING_ISOLATE_MULTISHOP_off',
        //                 'value' => 0,
        //                 'label' => 'Não',
        //             ),
        //         )
        //     ];
        // }

        $forms = [[
            'form' => [
                'legend' => ['title' => 'Produtos'],
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
        $form->fields_value['AGBLING_PRODUCT_ORIGIN'] = $this->configuration->getProductOrigin();
        $form->fields_value['AGBLING_ID_FIRST_ORDER_TO_SEND'] = $this->configuration->getIdFirstOrderToSend();
        $form->fields_value['AGBLING_SYNC_PRODUCT_DESCRIPTION'] = $this->configuration->getSyncProductDescription();
        $form->fields_value['AGBLING_SYNC_PRODUCT_DATA'] = $this->configuration->getSyncProductData();
        $form->fields_value['AGBLING_SYNC_STOCK'] = $this->configuration->getSyncStock();
        $form->fields_value['AGBLING_SEND_ORDERS'] = $this->configuration->getSendOrders();
    }
 
    protected function persistData()
    {
        $this->configuration->setProductOrigin(\Tools::getValue('AGBLING_PRODUCT_ORIGIN'));
        $this->configuration->setIdFirstOrderToSend(\Tools::getValue('AGBLING_ID_FIRST_ORDER_TO_SEND'));
        $this->configuration->setSyncProductDescription(\Tools::getValue('AGBLING_SYNC_PRODUCT_DESCRIPTION'));
        $this->configuration->setSyncProductData(\Tools::getValue('AGBLING_SYNC_PRODUCT_DATA'));
        $this->configuration->setSyncStock(\Tools::getValue('AGBLING_SYNC_STOCK'));
        $this->configuration->setSendOrders(\Tools::getValue('AGBLING_SEND_ORDERS'));
    }

    /**
     * Set the value of configuration
     *
     * @return  self
     */ 
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }
}