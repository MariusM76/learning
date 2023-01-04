<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$id = $_GET['id'];
$vendor = new Vendor($id);
?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h2>Vendor: <?php echo $vendor->name?></h2>
        </div>
        <?php
//        $productCategories = findBy('products','vendorId',$id);
        $productCategories= findByMultipleConditions('products',['vendorId'=> $id, 'type'=>'product']);
//        $productCategories2= findByMultipleConditions('products',['vendorId'=> $id, 'type'=>'product', 'price'=> '>10000']);
//        var_dump($productCategories2);die;
        if (!$productCategories) {
            $productCategories = null;
        } else {
            foreach ($vendor->getProducts() as $product) {
            $product->card();
            }
        }
        ?>
    </div>
</div>