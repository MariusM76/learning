<?php

class ProductPayment extends Product
{
    public $parentProduct;

    public function getFinalPrice()
    {
        $price = $this->parentProduct->price ;
        return $price;
    }

    public static function getTableName()
    {
        return 'products';
    }
}