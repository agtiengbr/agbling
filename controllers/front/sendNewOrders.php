<?php

use AGTI\Bling\Application\Exception\HttpCodeException;
use AGTI\Bling\Application\Service\SearchContactByDocument;
use AGTI\Bling\Application\Service\SendNewContact;
use AGTI\Bling\Application\Service\SendNewOrder;
use AGTI\Bling\Application\Service\UpdateContact;
use AGTI\Bling\DataConverter\Order;
use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\ValueObject\Configuration;
use AGTI\Bling\Entity\Order as EntityOrder;
use AGTI\Bling\Entity\Orders;
use AGTI\Bling\EntityManager\OrderEntityManager;
use AGTI\Bling\Service\CreateOrder;
use AGTI\Bling\Service\ServiceArgs\CreateOrder as ServiceArgsCreateOrder;
use AGTI\Bling\Service\ServiceArgs\UpdateOrder;
use AGTI\Bling\Service\UpdateOrder as ServiceUpdateOrder;
use Doctrine\ORM\EntityManagerInterface;

class agblingsendnewordersModuleFrontController extends ModuleFrontController
{
    private $config;
    public function init()
    {
        parent::init();

        /** @var Configuration */
        $this->config = $this->get(Configuration::class);
        if ($this->config->getIdFirstOrderToSend() === null) {
            exit();
        }

        AgClienteLogger::createLogger(_PS_MODULE_DIR_ . 'agbling/logs/sendNewOrders.log', 1);

         /** @var AgClienteWorker */
        $id_worker = Tools::getValue('id_agworker');
        global $agti_worker;
        $agti_worker = new AgClienteWorker($id_worker);
        $agti_worker->save();
    }

    public function initContent()
    {
        parent::initContent();

        //busca os pedidos
        /** @var EntityOrder[] */
        $this->uploadOrders();
        exit();
    }

    protected function uploadOrders()
    {
        if (!$this->config->getSendOrders()) {
            AgClienteLogger::addLog("Envio de pedidos para o Bling está desativado.");
            exit();
        }

        $id_worker = Tools::getValue('id_agworker');
        global $agti_worker;
        $agti_worker = new AgClienteWorker($id_worker);
        /** @var EntityManagerInterface */
        $em = $this->get('doctrine.orm.entity_manager');


        //obtém os IDs dos pedidos já enviados ao bling
        $sql = new DbQuery;
        $sql->select('id_ps')
            ->from('agbling_order');

        $ids = array_map(function($r){
            return $r['id_ps'];
        }, Db::getInstance()->executeS($sql));
        
        $orders = $em->getRepository(Orders::class)->getOrdersToSend($this->config, $ids);
        AgclienteLogger::addLog("Encontrou " . count($orders) . " pedidos para enviar ao Bling.");

        foreach ($orders as $order) {
            $agti_worker->save();

            AgclienteLogger::addLog("Tentando enviar o pedido {$order->getId()}.");
            try {
                AgclienteLogger::addLog("Buscando token de acesso");
                $token = $this->get(AGTI\Bling\ValueObject\ApiToken::class);

                AgclienteLogger::addLog("Verificando se o contato já existe no Bling.");
                $searchContact = $this->get(SearchContactByDocument::class);
                $contact = $searchContact->exec($order->getCustomer(), $token);

                //verifica se o cliente já existe no bling
                if (is_null($contact)) {
                    AgclienteLogger::addLog("Criando novo contato.");
                    //cria o contato
                    $sContact = $this->get(SendNewContact::class);
                    $sContact->exec($order->getCustomer(), $token, $order);
                } else {
                    AgclienteLogger::addLog("Atualizando contato.");
                    //atualiza o contato
                    $sContact = $this->get(UpdateContact::class);
                    $sContact->exec($order->getCustomer(), $contact, $token, $order);
                }
                
                AgclienteLogger::addLog("Enviando o pedido.");
                /** @var SendNewOrder */
                $s = $this->get(SendNewOrder::class);
                $s->exec($order, $token);
                AgclienteLogger::addLog("Pedido enviado!.");

            } catch (HttpCodeException $e) {
                if ($e->getCode() != 429) {
                    //verifica se já existe um pedido no bling para este pedido do PrestaShop
                    $repo = $em->getRepository(AgblingOrder::class);
                    $bo = $repo->findOneBy(['psOrder' => $order]);

                    if (!$bo) {
                        $bo = new AgblingOrder;
                        $bo->setPsOrder($order);
                        $order->setBlingOrder($bo);

                        $em->persist($bo);
                    }


                    $bo->setSendToBling(false)
                        ->setIdRemote(-1);
                    $em->flush();
                }
            } catch (\Exception $e) {
                AgclienteLogger::addLog("Erro - {$e->getMessage()} - {$e->getTraceAsString()}");
            }

            sleep(1);            
            
        }

        exit();
    }
}