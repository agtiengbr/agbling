<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\ValueObject\ApiToken;
use AGTI\Bling\Application\Utils\ValidateApiResponse;
use Doctrine\ORM\EntityManagerInterface;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Auth\RefreshToken\RefreshTokenService;


class RefreshToken
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(EntityManagerInterface $em, RefreshTokenService $apiService)
    {
        $this->em = $em;
        $this->apiService = $apiService;
    }

    public function exec(ApiToken $token)
    {
        $renewedToken = $this->apiService->exec($token);
        (new ValidateApiResponse())->validate($this->apiService->getRequest());

        if (!$renewedToken instanceof ApiToken || !$renewedToken->getToken() || !$renewedToken->getRefreshToken()) {
            throw new \RuntimeException('O Bling não retornou tokens válidos na renovação.');
        }

        return $renewedToken;
    }

    public function recordRequest()
    {
        $this->postApiRequest($this->apiService->getRequest(), $this->em);
    }
}
