<?php

class CartItem extends Base
{
    public $cartId;

    public $productId;

    public $quantity;

    public $parentId;


    public function getCart()
    {
    return new Cart($this->cartId);
    }
    public function getProduct()
    {
        $product = new Product($this->productId);
        if ($product->type == 'service') {
            $productEW = new ProductEW($this->productId);
            $productEW->parentProduct = $this->getParentProduct();
            return $productEW;
        }

        if ($product->type == 'delivery') {
            $productDelivery = new ProductDelivery($this->productId);
            $productDelivery->cart = $this->getCart();
            return $productDelivery;
        }
        return $product;
    }

    public function getParentProduct()
    {
        return new Product($this->parentId);
    }

    public function searchProductId()
    {
     $searchProductId = findOneBY('cart_items','product_id',$this->productId);
     return $searchProductId;
    }

    public function getTotal()
    {
    return $this->quantity * $this->getProduct()->getFinalPrice();
    }

    public static function getTableName()
    {
        return 'cart_items';
    }
}
