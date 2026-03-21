<?php
namespace AGTI\Bling\ValueObject;

use AGTI\Bling\Infrastructure\Mapping\AddressNumberMapping;
use AGTI\Bling\Infrastructure\Mapping\CNPJMapping;
use AGTI\Bling\Infrastructure\Mapping\CompanyNameMapping;
use AGTI\Bling\Infrastructure\Mapping\CPFMapping;
use AGTI\Bling\Infrastructure\Mapping\IEMapping;
use AGTI\Bling\Infrastructure\Mapping\RGMapping;

class Mappings
{
    private $cpf;
    private $rg;
    private $cnpj;
    private $ie;
    private $companyName;

    /** @var AddressNumberMapping */
    private $addressNumber;

    /**
     * @var array Mapeamentos de pagamento, onde a chave é o modo de pagamento do PrestaShop e o valor é o mapeamento correspondente no Bling.
     */
    private $paymentMappings;

    /**
     * @var array Mapeamentos de contas contábeis, onde a chave é o modo de pagamento do PrestaShop e o valor é o mapeamento correspondente no Bling.
     */
    private $contaContabilMappings;

    /**
     * @var array Mapeamentos de estados de pedidos, onde a chave é o ID do estado de pedido do PrestaShop e o valor é o mapeamento correspondente no Bling.
     */
    private $orderStateMappings;

    /**
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        if (is_null($this->cpf)) {
            return new CPFMapping;
        }

        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of rg
     */ 
    public function getRg()
    {
        if (is_null($this->rg)) {
            return new RGMapping;
        }

        return $this->rg;
    }

    /**
     * Set the value of rg
     *
     * @return  self
     */ 
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get the value of cnpj
     */ 
    public function getCnpj()
    {
        if (is_null($this->cnpj)) {
            return new CNPJMapping;
        }

        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */ 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get the value of ie
     */ 
    public function getIe()
    {
        if (is_null($this->ie)) {
            return new IEMapping;
        }

        return $this->ie;
    }

    /**
     * Set the value of ie
     *
     * @return  self
     */ 
    public function setIe($ie)
    {
        $this->ie = $ie;

        return $this;
    }

    /**
     * Get the value of companyName
     */ 
    public function getCompanyName()
    {
        if (is_null($this->companyName)) {
            return new CompanyNameMapping;
        }
        
        return $this->companyName;
    }

    /**
     * Set the value of companyName
     *
     * @return  self
     */ 
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get the value of addressNumber
     */ 
    public function getAddressNumber()
    {
        if (is_null($this->addressNumber)) {
            return new AddressNumberMapping;
        }
        
        return $this->addressNumber;
    }

    /**
     * Set the value of addressNumber
     *
     * @return  self
     */ 
    public function setAddressNumber($addressNumber)
    {
        $this->addressNumber = $addressNumber;

        return $this;
    }

    public function getPaymentMapping($psPaymentMode) {
        if (isset($this->paymentMappings[$psPaymentMode])) {
            return $this->paymentMappings[$psPaymentMode];
        }
    }

    /**
     * Set mapeamentos de pagamento, onde a chave é o modo de pagamento do PrestaShop e o valor é o mapeamento correspondente no Bling.
     *
     * @param  array  $paymentMappings  Mapeamentos de pagamento, onde a chave é o modo de pagamento do PrestaShop e o valor é o mapeamento correspondente no Bling.
     *
     * @return  self
     */ 
    public function setPaymentMappings($paymentMappings)
    {
        $this->paymentMappings = $paymentMappings;

        return $this;
    }

    public function getContaContabilMapping($psPaymentMode) {
        if (isset($this->contaContabilMappings[$psPaymentMode])) {
            return $this->contaContabilMappings[$psPaymentMode];
        }
    }

    /**
     * Set mapeamentos de contas contábeis, onde a chave é o modo de pagamento do PrestaShop e o valor é o mapeamento correspondente no Bling.
     *
     * @param  array  $contaContabilMappings  Mapeamentos de contas contábeis, onde a chave é o modo de pagamento do PrestaShop e o valor é o mapeamento correspondente no Bling.
     *
     * @return  self
     */ 
    public function setContaContabilMappings($contaContabilMappings)
    {
        $this->contaContabilMappings = $contaContabilMappings;

        return $this;
    }

    public function getOrderStateMapping($psOrderStateId) {
        if (isset($this->orderStateMappings['order_state_' . $psOrderStateId])) {
            return $this->orderStateMappings['order_state_' . $psOrderStateId];
        }
    }

    /**
     * Set mapeamentos de estados de pedidos, onde a chave é o ID do estado de pedido do PrestaShop e o valor é o mapeamento correspondente no Bling.
     *
     * @param  array  $orderStateMappings  Mapeamentos de estados de pedidos, onde a chave é o ID do estado de pedido do PrestaShop e o valor é o mapeamento correspondente no Bling.
     *
     * @return  self
     */ 
    public function setOrderStateMappings($orderStateMappings)
    {
        $this->orderStateMappings = $orderStateMappings;

        return $this;
    }
}