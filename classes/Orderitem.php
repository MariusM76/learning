<?php

class Orderitem extends Base
{
    public $productId;

    public $orderId;

    public $quantity;

    public $price;

    public $parentId;


    public function getProduct()
    {
//        $product = new Product($this->productId);
        return new Product($this->productId);
    }

    public static function getTableName()
    {
        return 'order_items';
    }

}