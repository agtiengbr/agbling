<?php

use AGTI\Bling\Utils\SkuGenerator\SkuGeneratorFactory;
use AGTI\Bling\EntityManager\VariationEntityManager;

class AdminAgBlingOrdersController extends ModuleAdminController
{
    protected $orders;
    protected $qtyOrders;

    public function __construct()
    {
        parent::__construct();

        $this->bootstrap = true;
    }

    public function initContent()
    {
        parent::initContent();

        if (Tools::getIsSet('action')) {
            switch (Tools::getValue('action')) {
                case 'refreshGridData':
                    $this->getProducts(null, null, $this->parseFilters());
                    echo json_encode([
                        'success' => 1,
                        'products' => $this->presentProducts($this->products),
                        'qtyProducts' => $this->qtyProducts
                    ]);
                case 'sendToBling':
                    Db::getInstance()->update('agbling_order', ['send_to_bling' => 1], 'id_ps=' . (int)Tools::getValue('id_ps'));

                    $orders = $this->getOrders();
                    echo json_encode(['success' => true, 'orders' => $this->presentOrders($orders)]);
                    exit();
                case 'dontSendToBling':
                    Db::getInstance()->update('agbling_order', ['send_to_bling' => 0], 'id_ps=' . (int)Tools::getValue('id_ps'));

                    $orders = $this->getOrders();
                    echo json_encode(['success' => true, 'orders' => $this->presentOrders($orders)]);
                    exit();
            }
        }

        $this->setTemplate("orders.tpl");
    }

    public function setMedia($isNewTheme=false)
    {
        parent::setMedia($isNewTheme);

        // if (AgClienteConfig::isDebugMode()) {
            $this->addJs("https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js");
        // } else {
        //     $this->addJs("https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js");
        // }
        $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js');

        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/loading/progress-bar.vue.js");
        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/grid/table.js");
        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/grid/header.js");
        $this->addJs(_PS_MODULE_DIR_ . "agcliente/views/js/component/grid/body.js");

        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . '/views/js/component/orderActions.vue.js');
        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . '/views/js/admin_orders.vue.js');
        $orders = $this->getOrders();

        Media::addJsDef([
            'agbling' => [
                'orders' => $this->presentOrders($orders),
                'qtyOrders' => $this->qtyOrders
            ]
        ]);
    }

    protected function getOrders($page=1, $limit=300000, $filters=[])
    {
        $dbPrefix = _DB_PREFIX_;

        $sql = "SELECT o.*, c.firstname, c.lastname, osl.name order_state, bo.id_agbling_order, bo.send_to_bling, bo.in_bling
        FROM {$dbPrefix}agbling_order bo
        LEFT JOIN {$dbPrefix}orders o ON o.id_order = bo.id_ps
        LEFT JOIN {$dbPrefix}customer c ON c.id_customer = o.id_customer
        LEFT JOIN {$dbPrefix}order_state os ON os.id_order_state = o.current_state
        LEFT JOIN {$dbPrefix}order_state_lang osl ON osl.id_order_state = os.id_order_state AND osl.id_lang = {$this->context->language->id}
        ORDER BY o.date_add DESC
        ";

        $dbData = Db::getInstance()->executeS($sql);

        return $dbData;
    }

    protected function presentOrders($orders)
    {
        $ret = [];

        foreach ($orders as $order) {
            $ret[] = [
                'id_bling' => $order['id_agbling_order'],
                'id_ps' => $order['id_order'],
                'reference' => $order['reference'],
                'customer' => $order['firstname'] . ' ' . $order['lastname'],
                'value' => Tools::displayPrice($order['total_paid_tax_incl']),
                'date_add' => $order['date_add'],
                'order_state' => $order['order_state'],
                'send_to_bling' => (int)$order['send_to_bling'],
                'in_bling' => (int)$order['in_bling']
            ];
        }

        return $ret;
    }

    protected function parseFilters():array
    {
        $ret = [];
        return $ret;
    }
}