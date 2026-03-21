<?php
namespace AGTI\Bling\Infrastructure\Service\Api\Bling\Categories\Products\GetCategory;

use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\Category;

class GetProductsCategoryServiceResponseSuccess
{
    /**
     * @var Category
     */
    private $data;

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData(Category $data)
    {
        $this->data = $data;

        return $this;
    }
}