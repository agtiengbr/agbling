<?php

namespace AGTI\Bling\Repository;

use AGTI\Bling\Entity\AgblingAccountsReceivable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AgblingAccountsReceivableRepository extends EntityRepository
{
    /**
     * Retorna os recebíveis vinculados a pedidos do PrestaShop cujo estado atual tenha a flag Paid como true e que não estejam pagos ainda.
     *
     * @return AgblingAccountsReceivable[]
     */
    public function findUnpaidReceivablesForPaidOrders()
    {
        return $this->createQueryBuilder('ar')
            ->innerJoin('ar.blingOrder', 'bo')
            ->innerJoin('bo.psOrder', 'po')
            ->innerJoin('po.currentState', 'cs')
            ->where('cs.paid = :paid')
            ->andWhere('ar.situacao != :situacao')
            ->setParameter('paid', true)
            ->setParameter('situacao', 2)
            ->getQuery()
            ->getResult();
    }
}
