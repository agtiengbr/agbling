<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Pedidos;

class ListOrdersResponse
{
    private $data;
    private $hasMorePages;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function hasMorePages()
    {
        return $this->hasMorePages;
    }

    public function setHasMorePages($hasMorePages)
    {
        $this->hasMorePages = $hasMorePages;
        return $this;
    }
}
