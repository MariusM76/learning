<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';


$userId = $_SESSION['id'];
$cartId = $_SESSION['cart_id'];
$data = $_POST;

$currentCart = new Cart($cartId);
$cartItems = $currentCart->getCartitems();

$adressId=$data['adress'];
$keys = array_keys($data);
$delievryId = $keys[1];
$paymentId = $keys[2];

$orderData = new Order();
$orderData->userId = $userId;
$orderData->cartId = $cartId;
$orderData->deliveryMethod = $delievryId;
$orderData->addressId = $adressId;
$orderData->paymentMethod = $paymentId;
$orderData->save();

foreach ($cartItems as $cartItem){

    $productData = new Product($cartItem->productId);
    $orderItem = new Orderitem();
    $orderItem->productId = $productData->getId();
    $orderItem->orderId = $orderData->getId();
    $orderItem->quantity = $cartItem->quantity;
    $orderItem->price =  $productData->getFinalPrice();

    if ($cartItem->parentId){
        $orderItem->parentId = $cartItem->parentId;

    }
    $orderItem->save();

    $cartItemToDelete = new CartItem($cartItem->getId());
    $cartItemToDelete->delete();
}


echo "<script>location.href='main.php';</script>";
//header("Location: main.php");

