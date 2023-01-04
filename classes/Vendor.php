<?php

class Vendor extends Base
{
    public $name;

    public function getProducts(){

        $products = [];
        $productList = Product::findBy('vendorId',$this->getId());
        if (!$productList) {
            $productCategories = null;
        } else {
            foreach ($productList as $productItem) {
                if($productItem->type=='product' )
                $products[] = new Product($productItem->getId());
            }
        }
        return $products;
    }

    public static function getTableName()
    {
        return 'vendors';
    }
}