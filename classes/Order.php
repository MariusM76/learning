<?php

class Order extends Base
{

    public $userId;

    public $cartId;

    public $deliveryMethod;

    public $addressId;

    public $paymentMethod;


    public function getOrderItems()
    {
        $orderItems = Orderitem::findBy('orderId', $this->getId());
//        $orderItems[] = new Orderitem();
        return $orderItems;
    }

    public function getAdress()
    {
        $address = new Address($this->addressId);
        return $address;
    }

    public function  getDeliveryMethod()
    {
        $deliveryMethod = new Product($this->deliveryMethod);
        return $deliveryMethod->name;
    }

    public function  getPaymentMethod()
    {
        $paymentMethod = new Product($this->paymentMethod);
        return $paymentMethod->name;
    }

    public static function getTableName()
    {
        return 'orders';
    }

    public function getTotalOrderValue()
    {
        $totalOrderValue = 0;
        foreach($this->getOrderItems() as $orderItem){
            $totalOrderItem = $orderItem->quantity*$orderItem->price;
            $totalOrderValue = $totalOrderValue + $totalOrderItem;
        }
        return $totalOrderValue;
    }
}