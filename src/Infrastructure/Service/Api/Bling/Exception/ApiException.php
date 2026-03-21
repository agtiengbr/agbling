<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Exception;

class ApiException extends \Exception
{
    private $type;
    private $description;
    private $redirectUrl;

    public function __construct($message, $type, $description, $redirectUrl, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->type = $type;
        $this->description = $description;
        $this->redirectUrl = $redirectUrl;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }
}
