<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Auth\RefreshToken;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\ValueObject\ApiToken;

class RefreshTokenService extends BaseService
{

    public function getApiEndpoint()
    {
        return "oauth/token";
    }

    public function exec(ApiToken $token)
    {
        $this->send(
            "POST",
            [],
            "grant_type=refresh_token&refresh_token=" . $token->getRefreshToken(),
            [
                'Authorization' => 'Basic ' . base64_encode('2d8840b0b9f3094491b1d3a8f95184cf7a2eb480:d06f91c51f7e987324a03b02caf789470173ea262a8bfd477f5c97f386a5'),
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        );

        if ($this->getRequest()->getHttpCode() == '200') {
            $dt = json_decode($this->getRequest()->getResponse());
            return (new ApiToken)
                ->setToken($dt->access_token)
                ->setRefreshToken($dt->refresh_token)
                ->setExpirationDate(new \DateTime("+46 minutes"));
        }
    }
}