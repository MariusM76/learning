<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';
?>

<?php if(isset($_SESSION['errorMessage'])): ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Rezultatul cautarii</h1>
            </div>
            <div class="modal-body">
                <?php echo $_SESSION['errorMessage']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
    document.onreadystatechange = function () {
        myModal.show();
    };
</script>
<?php endif; unset($_SESSION['errorMessage']); ?>


<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="processinsertUser.php" method="post" enctype="multipart/form-data" >
                <h3>Insert user details:</h3>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name ="first_name" placeholder="Enter user first name:" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name ="last_name" placeholder="Enter user last name:" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name ="email" autocomplete="new-email" placeholder="Enter user e-mail:" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name ="password" autocomplete="new-password" placeholder="Enter user password:" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select type="text" class="form-control" id="role" name ="role" placeholder="Select category:">
                            <option value="user">user</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" class="form-control" id="avatar" name ="avatar" placeholder="Select user image:">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
<?php include 'footer.php'?>
