<?php
include 'functions.php';


$userId = $_SESSION['id'];
$productToDelete = $_GET['productId'];

$currentCartItems = getCurrentCart()->getCartitems();

foreach ($currentCartItems as $cartItem){

    if ($productToDelete==$cartItem->productId){
        $cartItem->delete();
    }
}


header('Location: cart.php');
