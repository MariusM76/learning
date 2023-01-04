<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';
?>

<div class="container">
    <div class="row mt-4">
        <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        <div class="col-12 mt-4 mb-2">
            <h3>USERS :</h3>
        </div>
        <?php
        $usersByIds = query('SELECT id FROM users ORDER BY id DESC ;');
        foreach ($usersByIds as $users){
            showUserCard($users['id']);
        }
        ?>
    </div>
</div>
<?php include 'footer.php'?>
