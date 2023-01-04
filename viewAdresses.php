<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$addresses = Address::findAll();
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
                <h3>View all addresses:</h3>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Address ID</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Address</th>
                    <th scope="col">User ID</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                foreach ($addresses as $addressDetails):
                $i=$i +1 ;
//                $addressDetails = new Address($address['id']);
                ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $addressDetails->getId();?></td>
                    <td><?php echo $addressDetails->firstName;?></td>
                    <td><?php echo $addressDetails->lastName;?></td>
                    <td><?php echo $addressDetails->phone;?></td>
                    <td><?php echo $addressDetails->city;?></td>
                    <td><?php echo $addressDetails->state;?></td>
                    <td><?php echo $addressDetails->adress;?></td>
                    <td><?php echo $addressDetails->userId;?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a href="admin.php"><button class="btn btn-primary" type="submit">Back to admin page</button></a>
        </div>
    </div>