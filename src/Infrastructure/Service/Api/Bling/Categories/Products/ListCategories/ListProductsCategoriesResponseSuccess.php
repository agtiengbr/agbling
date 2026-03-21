<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\ListCategories;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Category;

class ListProductsCategoriesResponseSuccess
{
    /**
     * @var Category[]
     */
    private $data;

    /**
     * Get the value of data
     *
     * @return  Category[]
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param  Category[]  $data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}