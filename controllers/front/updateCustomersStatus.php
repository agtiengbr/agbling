<?php

use AGTI\Bling\Entity\Contact;
use AGTI\Bling\EntityManager\ContactEntityManager;
use AGTI\Bling\Exception\NotFoundException;
use AGTI\Bling\Service\ServiceArgs\GetContact as ServiceArgsGetContact;
use AGTI\Bling\Service\GetContact;

class agblingupdateCustomersStatusModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        /** @var AgClienteWorker */
        $id_worker = Tools::getValue('id_agworker');

        global $agti_worker;
        $agti_worker = new AgClienteWorker($id_worker);

        $contacts = ContactEntityManager::getAllEntitiesFromShop($this->context->shop->id);
        foreach ($contacts as $contact) {
            $this->handleContact($contact);
        }
    }

    protected function handleContact(Contact $contact)
    {
        $args = new ServiceArgsGetContact;
        if ($contact->getTipo() == 'F') {
            $args->setCpfcnpj($contact->getCpf());
        } else {
            $args->setCpfcnpj($contact->getCnpj());
        }

        $om = ContactEntityManager::findObjectModelByEmail($contact->getEmail(), $this->context->shop->id);

        try {
            $service = new GetContact;
            $service->setApiKey($this->config->getToken());
            $service->exec($args);

            \Db::getInstance()->insert('agbling_customer', ['id_agbling_customer' => $om->id, 'in_bling' => 1]);
            \Db::getInstance()->update('agbling_customer', ['in_bling' => 1], 'id_agbling_customer=' . (int)$om->id);
        } catch (NotFoundException $e) {
            \Db::getInstance()->insert('agbling_customer', ['id_agbling_customer' => $om->id, 'in_bling' => 0]);
            \Db::getInstance()->update('agbling_customer', ['in_bling' => 0], 'id_agbling_customer=' . (int)$om->id);
        }
    }
}