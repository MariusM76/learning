<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="processUserToDelete.php"  method="post" >
                <h3>Choose user to delete:</h3>
                <div class="mb-3" id="category_id">
                    <label for="user" class="form-label"></label>
                    <select type="text" class="form-control"  name ="user">
                        <?php foreach(User::findAll() as $user): ?>
                            <option  value="<?php echo $user->getId(); ?>"><?php echo $user->firstName; ?>, <?php echo $user->lastName; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <a href="#"><button class="btn btn-primary type="submit">Submit</button></a>
            </form>
            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
