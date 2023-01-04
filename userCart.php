<?php

include 'functions.php';


$productId = $_GET['id'];

//$parentId = $_GET['parentId'];


if ($_SESSION['id']==null) {
    header("Location: login.php");
}

if(isset($_GET['parentId'])){
    $parentId = $_GET['parentId'];
} else {
    $parentId=null;
}

$searchUserCart = Cart::findOneBY('userId',$_SESSION['id']);


$addToCart ='';

if ($searchUserCart==NULL){
    $userCart = new Cart();
    $userCart->userId = $_SESSION['id'];
    $userCart->save();
} else {
    $cart = new Cart($searchUserCart->getId());
    $cart->add($productId, $parentId);
}

header("Location: main.php");

?>

