<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Situations;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Situation;

class GetSituationResponseSuccess
{
    /**
     * @var Situation
     */
    private $data;

    /**
     * @return Situation
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param Situation $data
     * @return self
     */
    public function setData(Situation $data)
    {
        $this->data = $data;
        return $this;
    }
}
