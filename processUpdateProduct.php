<?php
include 'functions.php';
//include 'classes/Image.php';
//include 'classes/Product.php';

$id = $_GET['id'];
$data = $_POST;
$files = $_FILES;

$filepath = "C:/wamp64/www/tema20/images/".$files['image']['name'];

$imageId = findBy('images','productId',$id);

if (empty($files['image']['name'])) {
    $files['image']['name'] = 'no_image.png';
}

if (empty($files['image']['tmp_name'])) {
    $files['image']['tmp_name'] = 'no_image.png';
}

if (!empty($imageId)){
    foreach ($imageId as $matchImage) {
        $image = new Image ($matchImage['id']);
        $image->delete();
    }
}

$image = new Image();
$image->file = $files['image']['tmp_name'];
$image->productId = $id;
$image->save();


$updateDataProduct = new Product($id);
$updateDataProduct->name = $data['name'];
$updateDataProduct->price = $data['price'];
$updateDataProduct->description = $data['description'];
$updateDataProduct->code = $data['code'];
$updateDataProduct->discount = $data['discount'];
$updateDataProduct->categoryId = $data['category_id'];
$updateDataProduct->vendorId = $data['vendor_id'];
$updateDataProduct->weight = $data['weight'];
$updateDataProduct->type = $data['type'];

$updateDataProduct->save();


header('Location: admin.php');




