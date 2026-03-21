<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Auth\RefreshToken;

class RefreshTokenResponseSuccess
{
    private $accessToken;
    private $refreshToken;
    private $expirationDate;

    /**
     * Get the value of expirationDate
     */ 
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set the value of expirationDate
     *
     * @return  self
     */ 
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get the value of refreshToken
     */ 
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set the value of refreshToken
     *
     * @return  self
     */ 
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get the value of accessToken
     */ 
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set the value of accessToken
     *
     * @return  self
     */ 
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }
}