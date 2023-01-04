<?php
include 'functions.php';

$data = $_POST;
$files = $_FILES;

//var_dump($data);die;

if ($files['image']['tmp_name']!=NULL){
    copy ($files['image']['tmp_name'],'images/'.$files['image']['name']);
}

$productId = new Product();
$productId->name = $data['name'];
$productId->price = $data['price'];
$productId->description = $data['description'];
$productId->code = $data['code'];
$productId->discount = $data['discount'];
$productId->categoryId = $data['categoryId'];
$productId->vendorId = $data['vendorId'];
$productId->save();


//$productId = insert('products', $data);

$image = new Image();
if  ($image->file==NULL){
    $image->file = 'no_image.png';
} else {
    $image->file = $files['image']['name'];
}
$image->productId = $productId->getId();
//var_dump($image);die;
$image->save();

//$image = [
//    'file' => $files['image']['name'],
//    'productId' =>$productId,
//    ];
//if ($image['file']==NULL){
//    $image['file'] = 'no_image.png';
//}

//insert('images',$image);

header('Location: admin.php');
