<?php

include 'parts/header.php';
include 'functions.php';


$orderItem = new Orderitem($_GET['$itemId']);

$itemsInOrder = Orderitem::findBy('orderId',$orderItem->orderId);


if (count($itemsInOrder)==1){
    $orderToDelete = new Order($orderItem->orderId);
    $orderToDelete->delete();
}

header("Location: updateOrder.php");