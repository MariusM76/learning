<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="processInsertAddress.php" method="post">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name:"
                           value="">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name:"
                           value="">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone:" value="">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City:" value="">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State:</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="State:" value="">
                </div>
                <div class="mb-3">
                    <label for="adress" class="form-label">Address:</label>
                    <textarea type="text" class="form-control" id="adress" name="adress" placeholder="Address:"
                              value="">
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID:</label>
                    <select type="text" id="user_id" class="form-control" name="user_id">
                        <?php
                        $users = User::findAll();
                        foreach ($users as $user):
                            ?>

                            <option value="<?php echo $user->getId() ?>"><?php echo $user->firstName . ", " . $user->lastName ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

