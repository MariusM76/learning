<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$catid = $_GET['catpage'];
$category = new Category($catid);

?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h2><?php echo $category->name;?></h2>
        </div>
        <?php
        $productCategories = $category->getProducts();
        if (!$productCategories) {
            $productCategories = null;
        } else {
            foreach ($productCategories as $product) {
                $product->card();
            }
        }
        ?>
    </div>
</div>