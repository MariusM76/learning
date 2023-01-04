<?php
include 'functions.php';

$idToDelete = new Product($_POST['product_id']);

//var_dump($idToDelete);die;


if ($idToDelete->getImages()->getId()!=null){
    $imageToDelete = new Image($idToDelete->getImages()->getId());
    $imageToDelete->delete();
}

$idToDelete->delete();

//    findOneBY('images','product_id',$idToDelete );

//if ($imageToDelete!=NULL || $imageToDelete!=FALSE ){
//    delete('images',$imageToDelete['id']);
//
//}

//$productToDelete = findOneBY('products','id',$idToDelete['product_id']);
//if ($productToDelete!=NULL || $productToDelete!=FALSE) {
//    delete('products', $idToDelete['product_id']);
//}

header('Location: admin.php');
