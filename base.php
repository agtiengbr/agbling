<?php

use AGTI\Bling\Application\Service\MarkAsPaidApplicationService;
use AGTI\Bling\EntityManager\OrderEntityManager;
use AGTI\Bling\Enum\BlingOrderStatus;
use AGTI\Bling\Form\Authentication;
use AGTI\Bling\Form\Categories;
use AGTI\Bling\Form\Configuration as FormConfiguration;
use AGTI\Bling\Form\Customer;
use AGTI\Bling\Form\Orders;
use AGTI\Bling\Infrastructure\Serializer\Serializer;
use AGTI\Bling\ValueObject\Configuration as VBConfiguration;
use AGTI\Bling\Infrastructure\Mapping\AddressNumberMapping;
use AGTI\Bling\Infrastructure\Mapping\AgBlingOrderStatusReverseMapping;
use AGTI\Bling\Infrastructure\Mapping\CarrierMapping;
use AGTI\Bling\Infrastructure\Mapping\CNPJMapping;
use AGTI\Bling\Infrastructure\Mapping\CompanyNameMapping;
use AGTI\Bling\Infrastructure\Mapping\CPFMapping as MappingCPFMapping;
use AGTI\Bling\Infrastructure\Mapping\IEMapping;
use AGTI\Bling\Infrastructure\Mapping\PaymentModeMapping;
use AGTI\Bling\Infrastructure\Mapping\PersonTypeMapping;
use AGTI\Bling\Infrastructure\Mapping\RGMapping;
use AGTI\Bling\ValueObject\Mappings;
use AGTI\Cliente\Form\Mapping;
use AGTI\Cliente\Mapping\OrderStatusMapping;
use AGTI\Cliente\Presenter\Tab;
use AGTI\Cliente\Presenter\Tabs;
use AGTI\Bling\Application\Service\OrderStatusUpdater;
use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\Entity\AgBlingOrderState;
use AGTI\Bling\Entity\Orders as EntityOrders;
use AGTI\Bling\Entity\OrderState;
use AGTI\Bling\ValueObject\ApiToken;

require_once _PS_MODULE_DIR_ . 'agcliente/vendor/autoload.php';
require_once _PS_MODULE_DIR_ . 'agcliente/lib/AgModule.php';
require_once _PS_MODULE_DIR_ . 'agbling/vendor/autoload.php';

class BaseAgBling extends AgModule
{
    protected $workers = [
        [
            'name' => 'downloadNewProducts',
            'controller' => 'downloadNewProducts',
            'delay' => 900
        ],
        [
            'name' => 'downloadStocks',
            'controller' => 'downloadStocks',
            'delay' => 900
        ],
        [
            'name' => 'renewToken',
            'controller' => 'renewToken',
            'delay' => 300
        ],
        [
            'name' => 'downloadNewCategories',
            'controller' => 'downloadNewCategories',
            'delay' => 300
        ],
        [
            'name' => 'syncProductsToPs',
            'controller' => 'syncProductsToPs',
            'delay' => 1200
        ],
        [
            'name' => 'sendNewOrders',
            'controller' => 'sendNewOrders',
            'delay' => 1200
        ],
        [
            'name' => 'cleanrequests',
            'controller' => 'cleanRequests',
            'delay' => 86400
        ],
        [
            'name' => 'callback',
            'controller' => 'callback',
            'delay' => 300,
            'querystring' => 'proccess=1'
        ],
        [
            'name' => 'downloadOrders',
            'controller' => 'downloadOrders',
            'delay' => 900
        ],
        [
            'name' => 'getAccountsReceivable',
            'controller' => 'getAccountsReceivable',
            'delay' => '900'
        ],
        [
            'name' => 'MarkAllReceivablesAsPaid',
            'controller' => 'MarkAllReceivablesAsPaid',
            'delay' => '900'
        ],
    ];

    protected $main_tab = 'AdminParentModulesSf';
    protected $tabs = array(
        array(
            "name"      => "Bling",
            "className" => "agbling",
            "active"    => 1,
            "childs"    => array(
                array(
                    "name"      => "Produtos",
                    "className" => "AdminAgBlingProducts",
                    "active"    => 1
                ),
                array(
                    "name"      => "Pedidos",
                    "className" => "AdminAgBlingOrders",
                    "active"    => 1
                ),
                array(
                    "name"      => "Requisições API",
                    "className" => "AdminAgBlingRequest",
                    "active"    => 1
                )
            )
        )
    );

    protected $hooks = [
        'actionOrderStatusUpdate',
        'actionPaymentConfirmation'
    ];

    public function __construct()
    {
        $this->name                   = 'agbling';
        $this->version                = '2.2.4';
        $this->bootstrap              = true;
        $this->author                 = 'AGTI';
        $this->need_instance          = 1;
        $this->ps_versions_compliancy = array('min' => '1.7.6', 'max' => '9.99');

        parent::__construct();
    }

    public function install()
    {
        $r = parent::install();
        if ($r) {
            Db::getInstance()->execute("ALTER TABLE " . _DB_PREFIX_ . 'agbling_order CHANGE id_agbling_order id_agbling_order bigint');
        }

        return $r;
    }

    public function getContent()
    {
        
        $tabs = new Tabs;

        //form de autenticaçao
        $form = new Authentication($this);
        $form->postProcess();

        $tab = new Tab;
        $tab->setTitle("Autenticação com a API")
            ->setIcon("cogs")
            ->setid("auth")
            ->setBody($form->renderHtml())
            ->setActive(true);


        $tabs->addTab($tab);

        $form = new FormConfiguration($this);
        $config = $this->get(VBConfiguration::class);
        $form->setConfiguration($config);
        $form->postProcess();

        
        
        $tab = new Tab;
        $tab->setTitle("Modo de Operação")
            ->setIcon("cogs")
            ->setid("opmode")
            ->setBody($form->renderHtml())
        ;

        $tabs->addTab($tab);


        //Clientes
        try {
            /** @var Mappings */
            $mappings = $this->get(Mappings::class);

            $mapping = new Mapping($this);

            //mapeamento de campos
            $mapping->addPanel(
                'Mapeamento de Campos',
                // new PersonTypeMapping(),
                $mappings->getCpf(),
                $mappings->getRg(),
                $mappings->getCompanyName(),
                $mappings->getCnpj(),
                $mappings->getIe()
                // new AddressNumberMapping()
            );

            //mapeamento de status
            // $mappings = [];
            // foreach (BlingOrderStatus::getAll() as $name) {
            //     $id = BlingOrderStatus::getCodeByName($name);
            //     $mappings[] = (new OrderStatusMapping)->setConfigName("agbling_os_$id")->setLabel($name);
            // }

            // $args = array_merge(['Mapeamento de Status'], $mappings);
            // call_user_func_array([$mapping, 'addPanel'], $args);


            // $mappings = [];
            // foreach (OrderState::getOrderStates($this->context->language->id) as $status) {
            //     $mappings[] = (new AgBlingOrderStatusReverseMapping)->setConfigName("agbling_os_reverse_{$status['id_order_state']}")->setLabel($status['name']);
            // }
            // $args = array_merge(['Mapeamento de Status Reverso'], $mappings);
            // call_user_func_array([$mapping, 'addPanel'], $args);      

            // $mapping->addPanel("Mapeamento de Transportadoras", new CarrierMapping());


            // $mappings = [];
            // foreach (OrderEntityManager::getPsPaymentModes() as $paymentMode) {
            //     $mappings[] = (new PaymentModeMapping)->setConfigName("agbling_os_reverse_{$paymentMode}")->setLabel($paymentMode);
            // }
            // $args = array_merge(['Mapeamento de Meios de Pagamento'], $mappings);
            // call_user_func_array([$mapping, 'addPanel'], $args);


            
            $mapping->postProcess();
        
            $tab = new Tab;
            $tab->setTitle('Clientes')
                ->setIcon('user')
                ->setId('agbling_fields_mapping')
                ->setBody($mapping->renderHtml());
            $tabs->addTab($tab);
        } catch (Exception $e) {}

        //Pedidos
        $form = new Orders($this);
        $form->setIdLang($this->context->language->id);
        $form->setConfiguration($config);
        $form->postProcess();

        $body = $form->renderHtml();
        
        if ($body) {
            $tab = new Tab;
            $tab->setTitle("Pedidos")
                ->setIcon("shopping-cart")
                ->setId("orders")
                ->setActive(false)
                ->setBody($body);
            $tabs->addTab($tab);
        }


        //manutençao
        $tab = new Tab;
        $tab->setTitle("Manutenção")
        ->setIcon("help")
        ->setId("support")
        ->setActive(false)
        ->setBody(agcliente::renderMaintanceTab($this));
        $tabs->addTab($tab);

        
        //suporte
        $tab = new Tab;
        $tab->setTitle("Suporte")
            ->setIcon("help")
            ->setId("support")
            ->setActive(false)
            ->setBody(agcliente::renderHelpTab($this));

        $tabs->addTab($tab);

        $serializer = $this->get(Serializer::class);
        Configuration::updateValue("AGBLING_CONFIG", $serializer->serialize($config, 'json'));
        return $tabs->render();
    }

    public function hookActionOrderStatusUpdate($params)
    {
        //envia atualizacao de estado do pedido        
        try { 
            $em = $this->get('doctrine.orm.entity_manager');
            $order = $em->getRepository(EntityOrders::class)->findOneBy(['id' => $params['id_order']]);
            $newOrderStatus = $params['newOrderStatus'];

            /** @var OrderStatusUpdater $orderStatusUpdater */
            $orderStatusUpdater = $this->get(OrderStatusUpdater::class);
            $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);

            // Get the mapped status from PrestaShop to Bling
            $mappings = $this->get(Mappings::class);
            $blingStatus = $mappings->getOrderStateMapping($newOrderStatus->id);

            if ($blingStatus) {
                $orderState = $em->getRepository(AgBlingOrderState::class)->findOneBy(['id' => $blingStatus]);
                if ($orderState) {
                    $orderStatusUpdater->updateOrderStatus($order, $orderState->getIdRemote(), $token);
                } else {
                    \Logger::addLog("Ocorreu um erro ao enviar a atualização de estado do pedido - estado não encontrado.", 2, null, 'Order', $order->getId(), true);
                }
            } else {
                \Logger::addLog("Ocorreu um erro ao enviar a atualização de estado do pedido - estado não mapeado.", 2, null, 'Order', $order->getId(), true);
            }
        } catch (Exception $e) {
            \Logger::addLog("agbling - Ocorreu um erro ao enviar a atualização de estado do pedido - {$e->getMessage()}.", 3, null, 'Order', $params['id_order'], true);
        }
    }

    public function hookActionPaymentConfirmation($params)
    {
        try {
            $em = $this->get('doctrine.orm.entity_manager');
            $entityOrder = $em->getRepository(EntityOrders::class)->findOneBy(['id' => $params['id_order']]);
            $agblingOrder = $em->getRepository(AgblingOrder::class)->findOneBy(['psOrder' => $entityOrder]);

            if (!$agblingOrder) {
                \Logger::addLog("agbling - Não foi possível dar baixa no pagamento do pedido porque ele não foi enviado ao Bling ainda.", 2, 0, 'Order', $params['id_order'], true);
                return;
            }
            $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);

            //obtem o pedido do Bling associado a $agblingOrder
            $accountsReceivable = $agblingOrder->getAccountsReceivable();
            /** @var MarkAsPaidApplicationService $markAsPaidApplicationService */
            $markAsPaidApplicationService = $this->get(MarkAsPaidApplicationService::class);

            foreach ($accountsReceivable as $account) {
                $markAsPaidApplicationService->exec($token, new \DateTime, false);
            }
        } catch (Exception $e) {
            \Logger::addLog("agbling - Ocorreu um erro ao processar a confirmação de pagamento - {$e->getMessage()}.", 3, null, 'Order', $params['id_order'], true);
        }
    }
}