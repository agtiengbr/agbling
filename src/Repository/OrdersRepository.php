<?php
namespace AGTI\Bling\Repository;

use Doctrine\ORM\EntityRepository;
use AGTI\Bling\ValueObject\Configuration;

class OrdersRepository extends EntityRepository
{
    public function getOrdersToSend(Configuration $config, $ids)
    {
        $query = $this->createQueryBuilder('o');

        // A row in agbling_order means that this order was already processed,
        // including orders deliberately blocked after a permanent API error.
        // Keep this condition conjunctive: using OR here reintroduced orders
        // whenever the Doctrine relation was not available in the same query.
        if ($ids) {
            $query->andWhere($query->expr()->notIn('o.id', $ids));
        }


        if ($config->getIdFirstOrderToSend()) {
            $query->andWhere('o.id > :id')
                ->setParameter('id', $config->getIdFirstOrderToSend());
        }        

        //impede o envio de pedidos cujo endereço de entrega não existe
        //isso pode causar problemas com pedidos virtuais... não foi testado
        $query->innerJoin("o.addressInvoice", "ai");
        $query->innerJoin("o.addressDelivery", "ad");


        $data = $query->getQuery()
            ->setFirstResult(0)
            ->setMaxResults(100)
            ->getResult();
        
        return $data;
    }
    

    public function getPaymentModes()
    {
        //lista todos os diferentes meios de pagamento utilizados para fechar pedidos
        $query = $this->createQueryBuilder('o');
        $query->select('o.payment');
        $query->distinct();
        $data = $query->getQuery()->getResult();
        return $data;
    }
}
