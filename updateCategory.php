<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$categories = Category::findAll();

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="#"  method="post" >
                <h3>Choose category to edit:</h3>
                <div class="mb-3" id="category_id">
                    <label for="category" class="form-label"></label>
                    <select type="number" class="form-control"  name ="category" >
                        <?php foreach($categories as $category): ?>
                                <option  value="<?php echo $category->getId(); ?>"><?php echo $category->name; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <?php

    $category_id['category'] = $categories[0]->getId();
    if ($_POST!=NULL) {
        $category_id = $_POST;
    }

    $updateCategoryName = Category::findOneBY('id',$category_id['category'])->name;
    $updateCategoryId= Category::findOneBY('id',$category_id['category'])->getId();

    ?>
    <div class="row mt-4">
        <div class="col-12">
            <form action="processUpdateCategory.php?id=<?php echo $updateCategoryId; ?>"  method="post" >
                <div class="mb-3" id="category_id">
                    <label for="category_id" class="form-label">Edit category</label>
                    <input type="text" class="form-control" id="category_id" value="<?php echo $updateCategoryName; ?>" name="category_id" placeholder="Edit category:">
                </div>
                <a href="processUpdateCategory.php?id=<?php echo $updateCategoryId; ?>"><button class="btn btn-primary" type="submit">Submit</button></a>
            </form>
            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>


<?php
include 'footer.php'
?>