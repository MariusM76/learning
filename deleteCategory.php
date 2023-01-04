<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="processCategoryToDelete.php"  method="post" >
                <h3>Choose category to delete:</h3>
                <div class="mb-3" id="category_id">
                    <label for="category" class="form-label">Choose Category</label>
                    <select type="number" class="form-control"  name ="id">
                        <?php foreach(Category::findAll() as $category): ?>
                            <option  value="<?php echo $category->getId(); ?>"><?php echo $category->name; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <a href="#"><button class="btn btn-primary type="submit">Submit</button></a>
            </form>
            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
