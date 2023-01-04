<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';
?>

<div class="container">
    <div class="row mt-4">
        <?php if (getAuthUser() && $_SESSION['role'] == 'admin'): ?>
            <div class="ml-3">
                <a href="admin.php" class="btn btn-info ml-3">Go to admin panel</a>
<!--                <a href="searchProductCategorySales"><button type="submit" class="btn btn-dark">Sales statistics</button></a>-->
            </div>
        <?php endif; ?>
        <div class="col-12 mt-4 mb-2">
            <h2>Cele mai noi produse</h2>
        </div>
        <?php
            $newproductsIds = query("SELECT * FROM products WHERE (type ='product' OR type ='delivery') ORDER BY id DESC LIMIT 4;");
            foreach ($newproductsIds as $newProductID){
            $product = new Product($newProductID['id']);
            $product -> card();
            }
         ?>
    </div>

    <div class="row">
        <div class="col-12 mt-4 mb-2">
            <h2>Cele mai vandute produse</h2>
        </div>
        <?php
        $product = new Product(5);
        $product -> card();
        $product = new Product(2);
        $product -> card();
        $product = new Product(3);
        $product -> card();
        $product = new Product(4);
        $product -> card();
        ?>
    </div>
</div>



<?php include 'footer.php'?>

