<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
                <form action="#" method="post">
                    <h3>Choose address to edit:</h3>
                    <div class="mb-3">
                        <label for="address_id" class="form-label"></label>
                        <select type="number" id="address_id" class="form-control"  name ="address_id" >
                            <?php
                            $i=0;
                            foreach(Address::findAll() as $address):
                                $i=$i+1;
                            ?>
                            <option  value="<?php echo $address->getId() ?>"><?php echo $i.".Address ID: ".$address->getId().", Client: ".$address->firstName." ".$address->lastName.", User ID: ".$address->userId; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['address_id'])){
    $addressData = new Address($_POST['address_id']);
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form action="processUpdateAddress.php" method="post">
                <div class="mb-3">
                    <label for="address_id" class="form-label">ID</label>
                    <input disabled  type="text" class="form-control" id="address_id" name="address_id" placeholder="address_id ID:" value="<?php echo $addressData->getId();?>">
                    <input hidden  type="text" class="form-control" id="address_id" name="address_id" placeholder="address_id ID:" value="<?php echo $addressData->getId();?>">
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name:" value="<?php echo $addressData->firstName;?>">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name:" value="<?php echo $addressData->lastName;?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone:" value="<?php echo $addressData->phone;?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City:" value="<?php echo $addressData->city;?>">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State:</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="State:" value="<?php echo $addressData->state;?>">
                </div>
                <div class="mb-3">
                    <label for="adress" class="form-label">Address:</label>
                    <textarea type="text" class="form-control" id="adress" name="adress" placeholder="Address:" value="<?php echo $addressData->adress;?>"><?php echo $addressData->adress;?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID:</label>
                    <input disabled type="text" class="form-control" id="user_id" name="user_id" placeholder="User ID:" value="<?php echo $addressData->userId;?>">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php }; ?>

