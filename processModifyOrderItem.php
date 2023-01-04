<?php

include 'parts/header.php';
include 'functions.php';

$orderItem = new Orderitem($_GET['$itemId']);
$orderItem->productId = $orderItem->getProduct()->getId();
$orderItem->quantity = $_POST['quantity'];
$orderItem->price = $_POST['price'];

if ($_POST['parentId']!=null) {
    $orderItem->parentId = $_POST['parentId'];
}

$orderItem->save();

header("Location: updateOrder.php");

