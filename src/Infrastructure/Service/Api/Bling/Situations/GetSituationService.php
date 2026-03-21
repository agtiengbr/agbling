<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Situations;

use AGTI\Bling\Infrastructure\Service\Api\Bling\BaseService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Situation;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Situations\GetSituationResponseSuccess;

class GetSituationService extends BaseService
{
    /**
     * @var int
     */
    private $id;

    public function getApiEndpoint()
    {
        return "situacoes/{$this->id}";
    }

    /**
     * Fetch a single situation by id
     *
     * @param int $id
     * @return Situation|null
     */
    public function exec($id)
    {
        $this->id = $id;

        $r = $this->send("GET");

        if ($r->getHttpCode() == 200) {
            /** @var GetSituationResponseSuccess $resp */
            $resp = $this->getSerializer()->deserialize($r->getResponse(), GetSituationResponseSuccess::class, 'json');
            return $resp->getData();
        }

        return null;
    }
}
