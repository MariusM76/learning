<?php

class ProductEW extends Product
{
    public $parentProduct;


    public function getFinalPrice()
    {
        $ewFinalPrice = $this->parentProduct->getFinalPrice() * $this->discount/100;
        return $ewFinalPrice;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name.'('.$this->parentProduct->name.')';
    }

    public static function getTableName()
    {
        return  'products';
    }

}