<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="processinsertProduct.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name ="name" placeholder="Enter product name:">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name ="price" placeholder="Enter product price:">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name ="description" placeholder="Enter product description:"></textarea>
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="code" name ="code" placeholder="Enter product code:">
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" class="form-control" id="discount" name ="discount" placeholder="Enter product discount:">
                </div>
                <div class="mb-3">
                    <label for="categoryId" class="form-label">Category</label>
                    <select type="number" class="form-control" id="categoryId" name ="categoryId" placeholder="Select category:">
                        <?php foreach(Category::findAll() as $category): ?>
                        <option value="<?php echo $category->getId(); ?>"><?php echo $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vendorId" class="form-label">Vendor</label>
                    <select type="number" class="form-control" id="vendorId" name ="vendorId" placeholder="Select vendor:">
                        <?php foreach(Vendor::findAll() as $vendor): ?>
                            <option value="<?php echo $vendor->getId(); ?>"><?php echo $vendor->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name ="image" placeholder="Select your image:">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
<?php include 'footer.php'?>

