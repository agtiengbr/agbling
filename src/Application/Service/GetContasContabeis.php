<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Infrastructure\Service\Api\Bling\ContasContabeis\GetContasContabeisService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContasContabeisArgs;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\ContaContabil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetContasContabeis
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;
    private $serializer;

    public function __construct(GetContasContabeisService $apiService, EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->apiService = $apiService;
        $this->em = $em;
        $this->serializer = $serializer;
        $this->cacheFile = _PS_CACHE_DIR_ . 'contas_contabeis_cache.json';
    }

    public function exec($apiToken)
    {
        $this->apiService->setToken($apiToken);

        $pagina = 1;
        $limite = 100;
        $args = new ContasContabeisArgs($pagina, $limite);

        $contasContabeis = [];

        do {

            $args = new ContasContabeisArgs();
            $args->setPagina($pagina)->setLimite($limite);

            $this->apiService->setToken($apiToken);
            $response = $this->apiService->exec($args);
            
            if ($response) {
                $contasContabeis = array_merge($contasContabeis, $response);
                $pagina++;
            } else {
                break;
            }
        } while (!empty($response));

        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        return $contasContabeis;
    }
}
