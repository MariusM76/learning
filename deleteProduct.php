<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$categories = Category::findAll();
$products = Product::findAll();
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="#"  method="post" >
                <h3>Choose product to delete:</h3>
                <div class="mb-3" id="category_id">
                    <label for="category" class="form-label">Choose Category</label>
                    <select type="number" class="form-control"  name ="category_id">
                        <?php foreach(Category::findAll() as $category): ?>
                            <option  value="<?php echo $category->getId(); ?>"><?php echo $category->name; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <a href="#"><button class="btn btn-primary type="submit" name="sub">Submit</button></a>
            </form>

            <?php
            $selectedCategory = 1;
            if ($_POST!=NULL){
                $selectedCategory = $_POST['category_id'];
            }
            $compareCategory = Category::findOneBY('id',$selectedCategory);
            ?>

            <form action="processProductToDelete.php" method="post">
                <div class="col-12">
                    <form action="processProductToDelete.php" method="post" id="product_id" enctype="multipart/form-data">
                        <div class="mb-3" id="product_id">
                            <label for="product" class="form-label">Choose Product</label>
                            <select type="text" class="form-control" name ="product_id"">
                            <?php
                            foreach(Product::findAll() as $product):
                                if ($compareCategory->getId()==$product->categoryId):
                                    ?>
                                    <option  value="<?php echo $product->getId(); ?>"><?php echo $product->name; ?></option>
                                <?php endif; endforeach;?>
                            </select>
                        </div>
                        <a href="#"><button type="submit" class="btn btn-primary">Submit</button></a>
                    </form>
                </div>
            </form>
            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>