<?php

class Category extends Base
{
    public $name;


    public function getProducts(){

        $products = [];
        $productCategories = Product::findBy('categoryId',$this->getId());
        if (!$productCategories) {
            $productCategories = null;
        } else {
            foreach ($productCategories as $productbycat) {

                $products[] = new Product($productbycat->getId());
            }
        }
        return $products;
    }

    public static function getTableName()
    {
        return 'categories';
    }
}