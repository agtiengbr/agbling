<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Application\Utils\ValidateApiResponse as UtilsValidateApiResponse;
use AGTI\Bling\Entity\AgBlingApiRequest;
use Doctrine\ORM\EntityManagerInterface;

trait ApiApplicationTrait
{
    protected function postApiRequest(AgBlingApiRequest $r, EntityManagerInterface $manager)
    {

        $manager->persist($r);
        $manager->flush();

        (new UtilsValidateApiResponse)->validate($r);
    }
}