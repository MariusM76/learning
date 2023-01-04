<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';
?>
<div class="container">
    <div class="row">
        <h4>Add adress details: </h4>
    </div>
<div class="row mt-4">
    <div class="col-12">
        <form action="processAddAdress.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="first_name" class="form-label">First name</label>
                <input type="text" class="form-control" id="first_name" name ="first_name" placeholder="Enter first name:">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last name</label>
                <input type="text" class="form-control" id="last_name" name ="last_name" placeholder="Enter last name:">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" id="phone" name ="phone" placeholder="Enter phone number:">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name ="city" placeholder="Enter city:">
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name ="state" placeholder="Enter state:">
            </div>
            <div class="mb-3">
                <label for="adress" class="form-label">Adress</label>
                <textarea class="form-control" id="adress" name ="adress" placeholder="Enter adress:"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
<!--            <a href="order.php"><button type="submit" class="btn btn-danger mt-3">Back to order page</button></a>-->
        </form>
    </div>
</div>

</div>

<?php


?>