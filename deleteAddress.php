<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
                <form action="processDeleteAddress.php" method="post">
                    <h3>Choose address to delete:</h3>
                    <div class="mb-3">
                        <label for="address_id" id="address_id" class="form-label"></label>
                        <select type="text" class="form-control" name="address_id" >
                            <?php
                            $i=0;
                            foreach(Address::findAll() as $address):
                                $i=$i+1;
                                ?>
                                <option  value="<?php echo $address->getId(); ?>"><?php echo $i.".Address ID: ".$address->getId().", Client: ".$address->firstName." ".$address->lastName.", City: ".$address->city.", State: ".$address->state.", Address: ".$address->adress.", User ID: ".$address->userId; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
                <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
