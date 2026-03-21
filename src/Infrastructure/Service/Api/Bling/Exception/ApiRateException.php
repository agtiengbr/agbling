<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Exception;

class ApiRateException extends \Exception
{
    public function __construct($message = "Limite de requisições diárias atingido. Aguarde alguns minutos antes de tentar novamente.", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}