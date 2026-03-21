<?php
namespace AGTI\Bling\Infrastructure\Factory;

use AGTI\Bling\Entity\Shop as EntityShop;
use Doctrine\ORM\EntityManagerInterface;

class Shop
{
    public static function getCurrent(EntityManagerInterface $em)
    {
        return $em->getRepository(EntityShop::class)->findOneBy(['id' => \Context::getContext()->shop->id]);
    }
}