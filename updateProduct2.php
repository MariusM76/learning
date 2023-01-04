<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$updProduct = $_POST;
$data = findOneBY('products', 'id', $updProduct['product_id']);

?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <h3>Update product: </h3>
                <form action="processUpdateProduct.php?id=<?php echo $updProduct['product_id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input disabled type="text" class="form-control" value="<?php echo $data['id']?>" id="name"
                               name="id" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?php echo $data['name']?>" id="name"
                               name="name" placeholder="Enter product name:">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" value="<?php echo $data['price'] ?>"
                               name="price" placeholder="Enter product price:">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"
                                  placeholder="Enter product description:"><?php echo $data['description'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" value="<?php echo $data['code'] ?>"
                               name="code" placeholder="Enter product code:">
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" class="form-control" id="discount"
                               value="<?php echo $data['discount'] ?>" name="discount"
                               placeholder="Enter product discount:">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select type="number" class="form-control" id="category_id" name="category_id"
                                placeholder="Select category:">
                            <?php foreach (findAll('categories') as $category): ?>
                                <?php if ($data['category_id'] == $category['id']): ?>
                                    <option selected="selected"
                                            value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vendor" class="form-label">Vendor</label>
                        <select type="number" class="form-control" id="vendor_id" name="vendor_id"
                                placeholder="Select vendor:">
                            <?php foreach (findAll('vendors') as $vendor): ?>
                                <?php if ($data['vendor_id'] == $vendor['id']): ?>
                                    <option selected="selected"
                                            value="<?php echo $vendor['id']; ?>"><?php echo $vendor['name']; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $vendor['id']; ?>"><?php echo $vendor['name']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight</label>
                        <input type="number" class="form-control" id="weight" value="<?php echo $data['weight'] ?>"
                               name="weight" placeholder="Enter product weight:">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select type="number" class="form-control" id="type" name="type" placeholder="Select type:">
                            <option value="product">product</option>
                            <option value="service">service</option>
                            <option value="delivery">delivery</option>
                            <option value="cart_delivery">cart_delivery</option>
                            <option value="payment">payment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                               placeholder="Select your image:">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>