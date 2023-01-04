<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="processinsertCategory.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label"><h3>Enter new category name :</h3></label>
                    <input type="text" class="form-control" id="name" name ="name" placeholder="Enter category name:">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
<?php include 'footer.php'?>

