<?php

class AdminAgBlingBillsController extends ModuleAdminController
{
    protected $bills;

    public function __construct()
    {
        parent::__construct();

        $this->bootstrap = true;
    }

    public function initPageHeaderToolbar()
    {
        parent::initPageHeaderToolbar();

        $this->page_header_toolbar_btn['config'] = array(
            'href' => $this->context->link->getAdminLink('AdminModules') . '&configure=agbling',
            'icon' => 'process-icon-cogs',
            'desc' => 'Contas a receber',
        );
    }

    public function initContent()
    {
        parent::initContent();

        $this->setTemplate("bills.tpl");
    }

    public function setMedia($isNewTheme=false)
    {
        parent::setMedia($isNewTheme);

        if (AgClienteConfig::isDebugMode()) {
            $this->addJs("https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js");
        } else {
            $this->addJs("https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js");
        }
        $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js');

        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/loading/progress-bar.vue.js");
        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/grid/table.js");
        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/grid/header.js");
        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/grid/body.js");

        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . '/views/js/admin_bills.vue.js');

        $bills = $this->getBills();

        Media::addJsDef([
            'agbling' => [
                'bills' => $this->presentBills($bills)
            ]
        ]);
    }

    protected function getBills()
    {
        $dbPrefix = _DB_PREFIX_;

        $sql = "SELECT ab.*,c.firstname, c.lastname, osl.name order_state,o.reference
        FROM {$dbPrefix}agbling_bill_to_receive ab
        LEFT JOIN {$dbPrefix}orders o ON o.id_order = ab.pedido
        LEFT JOIN {$dbPrefix}customer c ON c.id_customer = o.id_customer
        LEFT JOIN {$dbPrefix}order_state os ON os.id_order_state = o.current_state
        LEFT JOIN {$dbPrefix}order_state_lang osl ON osl.id_order_state = os.id_order_state AND osl.id_lang = {$this->context->language->id}
        ORDER BY ab.id_agbling_bill_to_receive DESC
        ";

        $dbData = Db::getInstance()->executeS($sql);

        return $dbData;
    }


    protected function presentBills($bills)
    {
        $ret = [];

        foreach ($bills as $bill) {
            $ret[] = [
                'id_bling'           => $bill['id_bling'],
                'situacao'           => $bill['situacao'],
                'dataEmissao'        => $bill['dataEmissao'],
                'vencimentoOriginal' => $bill['vencimentoOriginal'],
                'vencimento'         => $bill['vencimento'],
                'competencia'        => $bill['competencia'],
                'nroDocumento'       => $bill['nroDocumento'],
                'valor'              => Tools::displayPrice($bill['valor']),
                'saldo'              => Tools::displayPrice($bill['saldo']),
                'historico'          => $bill['historico'],
                'categoria'          => $bill['categoria'],
                'idFormaPagamento'   => $bill['idFormaPagamento'],
                'portador'           => $bill['portador'],
                'linkBoleto'         => $bill['linkBoleto'],
                'vendedor'           => $bill['vendedor'],
                'ocorrencia'         => $bill['ocorrencia'],
                'cliente'            => $bill['firstname']." ".$bill['lastname'],
                'estadoPs'            => $bill['order_state'],
                'pedido'             => $bill['reference']
            ];
        }

        return $ret;
    }

}