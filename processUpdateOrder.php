<?php
include 'parts/header.php';
include 'functions.php';

$userId = $_GET['user_id'];
//$userData = new User ($userId);

$orderData = new Order($_POST['order_id']);


if ($userId==$orderData->userId) {
//    $orderData->id = $userData->id;
    $orderData->deliveryMethod = $_POST['delivery_method'];
    $orderData->paymentMethod = $_POST['payment_method'];

//    $data ['userId'] = $userData->id;
//    $data ['cartId'] = $orderData->cartId;
//    $data ['addressId'] = $orderData->addressId;
//    $data ['deliveryMethod'] = $_POST['delivery_method'];
//    $data ['paymentMethod'] = $_POST['payment_method'];
} else {
    $userData = new User($userId);
    $orderData->id = $userData->id;
    $orderData->cartId = $userData->getCart()->id;
    $orderData->addressId = $_POST['address'];
    $orderData->deliveryMethod = $_POST['delivery_method'];
    $orderData->paymentMethod = $_POST['payment_method'];

//    $data ['userId'] = $userData->id;
//    $data ['cartId'] = $userData->getCart()->id;
//    $data ['addressId']=$_POST['address'];
//    $data ['deliveryMethod'] = $_POST['delivery_method'];
//    $data ['paymentMethod'] = $_POST['payment_method'];
}
$orderData->save();

//update('orders',$data,$_POST['order_id']);
header("Location: admin.php");
