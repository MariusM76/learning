<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$id = $_GET['id'];
$product = new Product($id);

?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h1><?php echo $product->name?></h1>
            <h2><?php echo $product->getCategory()->name?></h2>
        </div>
        <?php
        $productCategories = findBy('products','id',$id);
        if (!$productCategories) {
            $productCategories = null;
        } else {
            $product->card();
            }
        ?>
    </div>

    <div class="row mt-4">
        <div class="col-12 mt-4 mb-2">
            <h2>Produse similare</h2>
        </div>
        <?php
            foreach (array_slice($product->getCategory()->getProducts(),0,5) as $similarProduct){
                if($similarProduct->id != $product->id ) {
                $similarProduct -> card();
                }
            }
        ?>

    </div>
</div>