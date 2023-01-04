<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

?>

<div class="container" id="choose_order">
    <div class="row mt-4">
        <div class="col-12">
                <form action="processDeleteOrder.php" method="post">
                    <h3>Choose order to delete:</h3>
                    <div class="mb-3">
                        <label for="order_id" id="order_id" class="form-label"></label>
                        <select id="order_id" type="number" class="form-control" name="order_id" >
                            <?php
                            $i=0;
                            foreach(Order::findAll() as $order):
                                $i=$i+1;
                                $user = new User($order->userId);
                                $deliveryMethod = new Product($order->delivery_method);
                                $address = new Address($order->address);
                                $paymentMethod = new Product($order->payment_method);
                                ?>
                                <option  value="<?php echo $order->getId(); ?>"><?php echo $i.".Order ID: ".$order->getId().", Client: ".$user->firstName." ".$user->lastName.", Cart ID: ".$order->cartId.", Delivery Method: ".$deliveryMethod->getName().", Address: ".$address->adress; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
                <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
