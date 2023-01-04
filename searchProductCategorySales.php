<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$categories = Category::findAll();
$vendors = Vendor::findAll();
$products = Product::findAll();


?>


<div class="container-fluid">
    <div>
        <a href="admin.php"><button type="submit" class="btn btn-success mt-2">Back to admin page</button></a>
        <a href="main.php"><button type="submit" class="btn btn-info mt-2">Back to main page</button></a>
    </div>
    <div class="row d-flex justify-content-center mt-2">
        <div class="col-6 ">
            <div class="text-center mt-3 mb-3"><h2> SALES REPORTS </h2></div>

            <div class="card ">
                <div class="card-body">
                    <form action="searchProductCategorySales.php" method="post" class="mt-4">
                        <div class="mb-3" id="category">
                            <label for="category" class="form-label" placeholder="Category: ">Sales by category / Select category:</label>
                            <select type="text" class="form-control"  name ="category" >
                                <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category->getId(); ?>"><?php echo $category->name; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mb-4">Sumbit</button>
                        </div>
                    </form>

                    <?php
                    $salesOrderItemsValueByCategory = 0;
//                        var_dump($salesCategoryId);die;
                        if (isset($_POST['category']) && $_POST['category']!=NULL) {
                            $salesCategoryId = $_POST['category'];
                            $salesOrderItems = Orderitem::findAll();

                            foreach ($salesOrderItems as $salesOrderItem){
                                $productData = new Product($salesOrderItem->productId);
                                if ($productData->categoryId==$salesCategoryId) {
                                    $salesOrderItemsValueByCategory = $salesOrderItem->quantity * $salesOrderItem->price + $salesOrderItemsValueByCategory;
                                }
                            }
//                            var_dump($salesOrderItemsValue);die;
                        }
                    ?>

                    <div>
                        <?php if ($salesOrderItemsValueByCategory>0):
                            $category = Category::findBy('id',$_POST['category']);
                            ?>
                            <h3>Total sales for <?php echo $category['0']->name; ?>: <?php echo $salesOrderItemsValueByCategory ?> RON</h3>
                        <?php endif ?>
                    </div>

                </div>
            </div>


        <div class="text-center mt-3 mb-3"> OR </div>

            <div class="card ">
                <div class="card-body">
                    <form action="searchProductCategorySales.php" method="post" class="mt-4">

                        <div class="mb-3">
                            <label for="vendor" class="form-label" placeholder="Vendor: ">Sales by vendor / Select vendor:</label>
                            <select type="text" class="form-control"  name ="vendor" >
                                <?php foreach($vendors as $vendor): ?>
                                    <option  value="<?php echo $vendor->getId(); ?>"><?php echo $vendor->name; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary mb-4">Sumbit</button>
                        </div>
                    </form>

                    <?php
                    $salesOrderItemsValueByVendor = 0;
//                    var_dump($_POST);die;
                    if (isset($_POST['vendor']) && $_POST['vendor']!=NULL) {
                        $salesVendorId = $_POST['vendor'];
                        $salesOrderItems = Orderitem::findAll();

                        foreach ($salesOrderItems as $salesOrderItem){
                            $productData = new Product($salesOrderItem->productId);
                            if ($productData->vendorId==$salesVendorId) {
                                $salesOrderItemsValueByVendor = $salesOrderItem->quantity * $salesOrderItem->price + $salesOrderItemsValueByVendor;
                            }
                        }
//                            var_dump($salesOrderItemsValue);die;
                    }
                    ?>

                    <div>
                        <?php if ($salesOrderItemsValueByVendor>0):
                        $vendor = Vendor::findBy('id',$_POST['vendor']);
                        ?>
                            <h3>Total sales for <?php echo $vendor['0']->name; ?>:  <?php echo $salesOrderItemsValueByVendor ?> RON</h3>
                        <?php endif ?>
                    </div>
                </div>
            </div>


            <div class="text-center mt-3 mb-3"> OR </div>

            <div class="card ">
                <div class="card-body">
                    <form action="searchProductCategorySales.php" method="post" class="mt-4">

                        <div class="mb-3">
                            <label for="product" class="form-label" placeholder="Product: ">Sales by product / Select product:</label>
                            <select type="text" class="form-control"  name ="product" >
                                <?php foreach($products as $product): ?>
                                    <option  value="<?php echo $product->getId(); ?>"><?php echo $product->name; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary mb-4">Sumbit</button>
                        </div>
                    </form>

                    <?php
                    $salesOrderItemsValueByProduct = 0;
                    //                    var_dump($_POST);die;
                    if (isset($_POST['product']) && $_POST['product']!=NULL) {
                        $salesVendorId = $_POST['product'];
                        $salesOrderItems = Orderitem::findAll();

                        foreach ($salesOrderItems as $salesOrderItem){
                            $productData = new Product($salesOrderItem->productId);
                            if ($productData->vendorId==$salesVendorId) {
                                $salesOrderItemsValueByProduct = $salesOrderItem->quantity * $salesOrderItem->price + $salesOrderItemsValueByProduct;
                            }
                        }
//                            var_dump($salesOrderItemsValue);die;
                    }
                    ?>

                    <div>
                        <?php if ($salesOrderItemsValueByProduct>0):
                            $product = Product::findBy('id',$_POST['product']);
                            ?>
                            <h3>Total sales for <?php echo $product['0']->name; ?>:  <?php echo $salesOrderItemsValueByProduct ?> RON</h3>
                        <?php endif ?>
                    </div>

                </div>
            </div>

            <div class="text-center mt-3 mb-3"> OR </div>

            <div class="card">
                <div class="card-body">
                    <div class="mt-2 mb-2">Sales by keyword: </div>
                    <form method="post" action="searchProductCategorySales.php">
                        <input type="text" name="search"/>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>

                    <?php
                    $totalSalesOfSearch=0;

                    if (isset($_POST['search']) && $_POST['search']!=NULL) {
                        $salesBySearch = $_POST['search'];
                        $query = query("SELECT * FROM products WHERE name LIKE '%$salesBySearch%' OR description LIKE '%$salesBySearch%';");

                        $sales = Orderitem::findAll();

                        foreach ($query as $searchProduct){
                            $searchProductObjs[] = new Product($searchProduct['id']);
                        }

                        for ($i=0;$i<count($sales);$i++){
                            foreach ($searchProductObjs as $samsungProductObj){
                                if($sales[$i]->productId==$samsungProductObj->getId()){
                                    $totalSalesOfSearch = $sales[$i]->price + $totalSalesOfSearch;
                                }
                            }
                        }
                    }
                    ?>

                    <div>
                        <?php if (isset($_POST['search']) && $_POST['search']!=null): ?>
                            <h3>Total sales for <b>"<?php echo $_POST['search']; ?>"</b>:  <?php echo $totalSalesOfSearch ?> RON</h3>
                        <?php endif ?>
                    </div>


            </div>

</div>