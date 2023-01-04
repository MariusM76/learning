<?php
include 'functions.php';

$userId = $_SESSION['id'];
$updatedCartData=$_POST;

//$cartId = getCurrentCart()->id;
$cartData = getCurrentCart()->getCartitems();

foreach ($updatedCartData as $productId=>$updatedqty){

    for ($i=0;$i<count(array_keys($cartData));$i++){

        if($productId==$cartData[$i]->productId){
            $cartData[$i]->productId = $productId;
            $cartData[$i]->quantity = $updatedqty;
            $cartData[$i]->save();
        }
    }
}


header('Location: main.php');
