<?php

namespace AGTI\Bling\Form;

use AGTI\Bling\Application\Service\ApiApplicationTrait;
use AGTI\Bling\Application\Service\ListPaymentModes;
use AGTI\Bling\Application\Service\GetContasContabeis;
use AGTI\Bling\Entity\AgBlingOrderState;
use AGTI\Bling\Entity\Orders as EntityOrders;
use AGTI\Bling\Entity\OrderState;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\PaymentMode;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContaContabil;
use AGTI\Bling\ValueObject\Configuration as EntityConfiguration;
use AGTI\Cliente\Form\Form;
use HelperForm;

class Orders extends Form
{
    use ApiApplicationTrait;

    protected $submitButton = 'agbling-order-submit';
    private $configuration;
    private $idLang;

    public function renderHtml()
    {
        try {
            $em = $this->module->get('doctrine.orm.entity_manager');
            $repo = $em->getRepository(EntityOrders::class);
            $psPaymentModes = $repo->getPaymentModes();
            $psOrderStates = $em->getRepository(OrderState::class)->findAll(); // Obtenha os estados dos pedidos do PrestaShop

            $token = $this->module->get(\AGTI\Bling\ValueObject\ApiToken::class);
            if (is_null($token)) {
                return;
            }

            $service = $this->module->get(ListPaymentModes::class);
            $blingPaymentModes = $service->exec($token);

            $blingPaymentModesQuery = array_map(function (PaymentMode $payment) {
                return [
                    'id' => $payment->getId(),
                    'name' => $payment->getDescricao()
                ];
            }, $blingPaymentModes);

            $blingPaymentModesQuery[] = [
                'id' => 0,
                'name' => 'Mapeamento não configurado'
            ];

            //ordena os pagamentos em ordem alfabética, mantendo o ID 0 no início
            usort($blingPaymentModesQuery, function ($a, $b) {
                if ($a['id'] == 0) {
                    return -1;
                }

                if ($b['id'] == 0) {
                    return 1;
                }

                return $a['name'] <=> $b['name'];
            });

            // Obter contas contábeis da API Bling
            $contasContabeisService = $this->module->get(GetContasContabeis::class);
            $contasContabeis = $contasContabeisService->exec($token);

            $contasContabeisQuery = array_map(function (ContaContabil $conta) {
                return [
                    'id' => $conta->getId(),
                    'name' => $conta->getDescricao()
                ];
            }, $contasContabeis);

            $contasContabeisQuery[] = [
                'id' => 0,
                'name' => 'Mapeamento não configurado'
            ];

            //ordena as contas contábeis em ordem alfabética, mantendo o ID 0 no início
            usort($contasContabeisQuery, function ($a, $b) {
                if ($a['id'] == 0) {
                    return -1;
                }

                if ($b['id'] == 0) {
                    return 1;
                }

                return $a['name'] <=> $b['name'];
            });

            $inputs = [];

            // Adiciona um bloco informativo usando a propriedade 'information'
            $information = 'Este formulário permite o mapeamento entre formas de pagamento do PrestaShop e do Bling. Essa informação será utilizada para mapear corretamente os recebíveis gerados pelo pedido de venda.';

            //ordena as opções de pagamento do PS em ordem alfabética
            usort($psPaymentModes, function ($a, $b) {
                return $a['payment'] <=> $b['payment'];
            });
            foreach ($psPaymentModes as $payment) {
                $inputs[] = [
                    'type' => 'select',
                    'label' => $payment['payment'],
                    'name' => 'payment_' . $payment['payment'],
                    'options' => [
                        'id' => 'id',
                        'name' => 'name',
                        'query' => $blingPaymentModesQuery
                    ]
                ];
            }

            $forms = [[
                'form' => [
                    'legend' => ['title' => 'Formas de Pagamento'],
                    'description' => $information,
                    'input' => $inputs,
                    'submit' => ['title' => 'Salvar', 'name' => $this->submitButton],
                ]
            ]];

            // Adiciona um novo formulário para mapear as formas de pagamento para contas contábeis
            $inputs = [];
            foreach ($psPaymentModes as $payment) {
                $inputs[] = [
                    'type' => 'select',
                    'label' => 'Conta Contábil para ' . $payment['payment'],
                    'name' => 'conta_contabil_' . $payment['payment'],
                    'options' => [
                        'id' => 'id',
                        'name' => 'name',
                        'query' => $contasContabeisQuery
                    ]
                ];
            }

            $forms[] = [
                'form' => [
                    'legend' => ['title' => 'Contas Contábeis'],
                    'description' => 'Este formulário permite o mapeamento entre formas de pagamento do PrestaShop e contas contábeis do Bling.',
                    'input' => $inputs,
                    'submit' => ['title' => 'Salvar', 'name' => $this->submitButton],
                ]
            ];

            // Estados de Pedido: exibir UM painel de acordo com a configuração
            if ((int)$this->configuration->getSendOrders() === 1) {
                // QUANDO enviar pedidos estiver ATIVO: exibir PS -> Bling
                $inputs = [];

                $blingOrderStates = array_map(function($row){
                    return ['id' => $row->getId(), 'name' => $row->getNome()];
                }, $em->getRepository(AgBlingOrderState::class)->findAll());

                $blingOrderStates[] = [
                    'id' => 0,
                    'name' => 'Mapeamento não configurado'
                ];

                // Ordena estados do Bling alfabeticamente, mantendo 0 no topo
                usort($blingOrderStates, function ($a, $b) {
                    if ($a['id'] == 0) { return -1; }
                    if ($b['id'] == 0) { return 1; }
                    return $a['name'] <=> $b['name'];
                });

                // Para cada estado do PrestaShop, escolher um estado do Bling
                foreach ($psOrderStates as $state) {
                    $lang = $state->getLangById($this->idLang);
                    if ($lang) {
                        $inputs[] = [
                            'type' => 'select',
                            'label' => $lang->getName(),
                            'name' => 'order_state_' . $state->getIdOrderState(),
                            'options' => [
                                'id' => 'id',
                                'name' => 'name',
                                'query' => $blingOrderStates
                            ]
                        ];
                    }
                }
                $forms[] = [
                    'form' => [
                        'legend' => ['title' => 'Estados de Pedido (PS → Bling)'],
                        'description' => 'Para cada estado do PrestaShop, selecione o estado correspondente no Bling.',
                        'input' => $inputs,
                        'submit' => ['title' => 'Salvar', 'name' => $this->submitButton],
                    ]
                ];
            } else {
                // QUANDO enviar pedidos estiver DESATIVADO: exibir Bling -> PS
                $inputs = [];

                // Opções de estados do PrestaShop
                $psOrderStatesOptions = [];
                foreach ($psOrderStates as $state) {
                    $lang = $state->getLangById($this->idLang);
                    if ($lang) {
                        $psOrderStatesOptions[] = [
                            'id' => $state->getIdOrderState(),
                            'name' => $lang->getName(),
                        ];
                    }
                }

                $psOrderStatesOptions[] = [
                    'id' => 0,
                    'name' => 'Mapeamento não configurado'
                ];

                // ordenar por nome, mantendo 0 no topo
                usort($psOrderStatesOptions, function ($a, $b) {
                    if ($a['id'] == 0) { return -1; }
                    if ($b['id'] == 0) { return 1; }
                    return $a['name'] <=> $b['name'];
                });

                // Lista de estados do Bling
                $blingOrderStates = array_map(function($row){
                    return ['id' => $row->getId(), 'name' => $row->getNome()];
                }, $em->getRepository(AgBlingOrderState::class)->findAll());

                // ordenar por nome
                usort($blingOrderStates, function ($a, $b) {
                    return $a['name'] <=> $b['name'];
                });

                // Para cada estado do Bling, selecionar um estado do PrestaShop
                foreach ($blingOrderStates as $blingState) {
                    $inputs[] = [
                        'type' => 'select',
                        'label' => $blingState['name'],
                        'name' => 'order_state_bling_' . $blingState['id'],
                        'options' => [
                            'id' => 'id',
                            'name' => 'name',
                            'query' => $psOrderStatesOptions
                        ]
                    ];
                }

                $forms[] = [
                    'form' => [
                        'legend' => ['title' => 'Estados de Pedido (Bling → PS)'],
                        'description' => 'Para cada estado do Bling, selecione o estado correspondente no PrestaShop.',
                        'input' => $inputs,
                        'submit' => ['title' => 'Salvar', 'name' => $this->submitButton],
                    ]
                ];
            }


            $form = $this->getHelperForm();
            $this->fillForm($form);

            return $form->generateForm($forms);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function postProcess()
    {
        if (\Tools::isSubmit($this->submitButton)) {
            $this->persistData();
        }
    }

    protected function fillForm(HelperForm $form)
    {
        $mappings = $this->configuration->getMappings();

        $em = $this->module->get('doctrine.orm.entity_manager');
        $repo = $em->getRepository(EntityOrders::class);
        $psPaymentModes = $repo->getPaymentModes();
        $psOrderStates = $em->getRepository(OrderState::class)->findAll(); // Obtenha os estados dos pedidos do PrestaShop

        //itera por todos os inputs do form
        foreach ($psPaymentModes as $paymentMode) {
            $form->fields_value['payment_' . $paymentMode['payment']] = $mappings->getPaymentMapping(str_replace(' ', '_', $paymentMode['payment']));
            $form->fields_value['conta_contabil_' . $paymentMode['payment']] = $mappings->getContaContabilMapping(str_replace(' ', '_', $paymentMode['payment']));
        }

        if ((int)$this->configuration->getSendOrders() === 1) {
            // Painel PS -> Bling: preencher diretamente pelos mapeamentos existentes
            foreach ($psOrderStates as $state) {
                $lang = $state->getLangById($this->idLang);
                if ($lang) {
                    $form->fields_value['order_state_' . $state->getIdOrderState()] = $mappings->getOrderStateMapping($state->getIdOrderState());
                }
            }
        } else {
            // Painel Bling -> PS: inverter os mapeamentos existentes para exibir a seleção
            $psToBling = [];
            foreach ($psOrderStates as $state) {
                $psToBling[$state->getIdOrderState()] = $mappings->getOrderStateMapping($state->getIdOrderState());
            }

            $blingStates = $this->module->get('doctrine.orm.entity_manager')->getRepository(AgBlingOrderState::class)->findAll();
            foreach ($blingStates as $blingState) {
                $selectedPs = 0;
                foreach ($psOrderStates as $state) {
                    if (!empty($psToBling[$state->getIdOrderState()]) && (int)$psToBling[$state->getIdOrderState()] === (int)$blingState->getId()) {
                        $selectedPs = $state->getIdOrderState();
                        break;
                    }
                }
                $form->fields_value['order_state_bling_' . $blingState->getId()] = $selectedPs;
            }
        }
    }

    protected function persistData()
    {
        $mappings_array = [];

        //itera pelo array $_REQUEST por todos os parametros que iniciem em payment_
        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'payment_') === 0) {
                $mappings_array[substr($key, 8)] = $value;
            }
        }

        $mappings = $this->configuration->getMappings();
        $mappings->setPaymentMappings($mappings_array);

        // Adiciona os mapeamentos de contas contábeis
        $mappings_array = [];
        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'conta_contabil_') === 0) {
                $mappings_array[substr($key, 15)] = $value;
            }
        }
        $mappings->setContaContabilMappings($mappings_array);

        // Adiciona os mapeamentos de estados de pedido conforme o painel exibido
        if ((int)$this->configuration->getSendOrders() === 1) {
            // PS -> Bling: já vem no formato esperado
            $mappings_array = [];
            foreach ($_REQUEST as $key => $value) {
                if (strpos($key, 'order_state_') === 0 && strpos($key, 'order_state_bling_') !== 0) {
                    $mappings_array[$key] = $value;
                }
            }
            $mappings->setOrderStateMappings($mappings_array);
        } else {
            // Bling -> PS: converter para PS -> Bling
            $psToBling = [];
            foreach ($_REQUEST as $key => $value) {
                if (strpos($key, 'order_state_bling_') === 0) {
                    $blingId = (int)substr($key, strlen('order_state_bling_'));
                    $psId = (int)$value;
                    if ($psId > 0 && $blingId > 0) {
                        $psToBling['order_state_' . $psId] = $blingId;
                    }
                }
            }
            $mappings->setOrderStateMappings($psToBling);
        }
        $this->configuration->setMappings($mappings);
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

    /**
     * Set the value of idLang
     *
     * @return  self
     */ 
    public function setIdLang($idLang)
    {
        $this->idLang = $idLang;

        return $this;
    }
}