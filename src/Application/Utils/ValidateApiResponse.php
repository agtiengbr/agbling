<?php

namespace AGTI\Bling\Application\Utils;

use AGTI\Bling\Application\Exception\HttpCodeException;
use AGTI\Bling\Application\Exception\UnauthorizedHttpException;
use AGTI\Bling\Entity\AgBlingApiRequest;

class ValidateApiResponse
{
    public function validate(AgBlingApiRequest $r)
    {
        if ($r->getHttpCode() == 401) {
            throw new UnauthorizedHttpException("A API retornou falha de autenticação.");
        }
        

        if ($r->getHttpCode() < 200 || $r->getHttpCode() >= 300) {
            throw new HttpCodeException("A API retornou código HTTP de erro.", $r->getHttpCode());
        }
    }
}