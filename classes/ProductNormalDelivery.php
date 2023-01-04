<?php

class ProductNormalDelivery extends Product
{
    /** @var Cart */
    public $cart;

    public function getFinalPrice()
    {
//        var_dump($this->cart);die;
        return $this->cart->getWeight() * $this->price;

    }

    public static function getTableName()
    {
        return 'products';
    }
}