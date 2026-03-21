<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\ValueObject\ApiToken;
use Doctrine\ORM\EntityManagerInterface;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Auth\RefreshToken\RefreshTokenService;


class RefreshToken
{
    use ApiApplicationTrait;

    private $apiService;
    private $token;
    private $em;

    public function __construct(EntityManagerInterface $em, \AGTI\Bling\ValueObject\ApiToken $token, RefreshTokenService $apiService)
    {
        $this->em = $em;
        $this->apiService = $apiService;
        $this->token = $token;
    }

    public function exec(\AGTI\Bling\ValueObject\ApiToken $token = null)
    {
        if (is_null($token)) {
            $token = $this->apiService->exec($this->token);
        }
        
        $this->postApiRequest($this->apiService->getRequest(), $this->em);

        return $token;
    }
}