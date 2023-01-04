<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$users = User::findAll();
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="#"  method="post" >
                <div class="mb-3" id="user">
                    <label for="user" class="form-label"><h4>Choose User to update: </h4></label>
                    <select type="number" class="form-control" name ="user">
                        <?php foreach($users as $user): ?>
                                <option  value="<?php echo $user->getId(); ?>"><?php echo $user->firstName;?>,<?php echo $user->lastName; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <a href="#"><button class="btn btn-primary type="submit">Submit</button></a>
            </form>

            <?php
            $user_id = 1;

            if ($_POST!=NULL) {
                $user_id = $_POST['user'];
            }
            $user = User::find($user_id);

            ?>

            <div class="container">
                <div class="row mt-4">
                    <div class="col-12">
                        <form action="processUpdateUser.php?id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" value="<?php echo $user->firstName?>" id="firstName"
                                       name="firstName" placeholder="Enter first name:">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastName" value="<?php echo $user->lastName ?>"
                                       name="lastName" placeholder="Enter last name:">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="<?php echo $user->email ?>"
                                       name="email" placeholder="Enter email:">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" value="<?php echo $user->password ?>" name="password"
                                       placeholder="Enter password:">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select type="text" class="form-control" id="role" name ="role" placeholder="Select role:">
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar"
                                       placeholder="Select user avatar:">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'?>