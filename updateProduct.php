<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$categories = findAll('categories');
$products = findAll('products');


?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="#"  method="post">
                <div class="mb-3" id="category_id">
                    <label for="category" class="form-label">Choose Category</label>
                    <select type="text" class="form-control"  name ="category_id">
                        <?php foreach(findAll('categories') as $category): ?>
                                <option  value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <a><button class="btn btn-primary" type="submit">Submit</button></a>
            </form>

            <?php
            $selectedCategory = 1;
            if ($_POST!=NULL){
                $selectedCategory = $_POST['category_id'];
            }
            $compareCategory = findOneBY('categories','id',$selectedCategory);
            ?>

            <div class="col-12">
                <form action="updateProduct2.php" method="post">
                    <div class="mb-3" id="product_id">
                        <label for="product_id" class="form-label">Choose Product</label>
                        <select type="text" class="form-control" name ="product_id">
                            <?php
                            foreach($products as $product):
                                    if ($compareCategory['id']==$product['categoryId']):
                                    ?>
                                        <option  value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                            <?php endif;endforeach; ?>
                        </select>
                    </div>
                    <a href="#"><button type="submit" class="btn btn-primary">Submit</button></a>
                </form>
                <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'?>

