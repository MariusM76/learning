<?php

include 'parts/header.php';
include 'functions.php';


$orderToDelete = new Order($_POST['order_id']);
$orderItemsToDelete = $orderToDelete->getOrderItems();


foreach($orderItemsToDelete as $orderTtemToDelete){
//    $orderTtemToDelete = new Orderitem($orderTtemToDelete['id']);
    $orderTtemToDelete->delete();
}

$orderToDelete->delete();

echo "<script>location.href='main.php';</script>";
//header("Location: admin.php");
