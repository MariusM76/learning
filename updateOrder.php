<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

?>

<div class="container" >
    <div class="row mt-4">
        <div class="col-12">
            <div >
                <form action="#" method="post">
                    <h3>Choose order to edit:</h3>
                    <div class="mb-3">
                        <label for="order_id" class="form-label"></label>
                        <select type="number" id="order_id" class="form-control"  name ="order_id" >
                            <?php
                            $i=0;
                            foreach(Order::findAll() as $order):
                                $i=$i+1;
                                $user = new User($order->userId);
                                $deliveryMethod = new Product($order->deliverMethod);
                                $address = new Address($order->addressId);
                                $paymentMethod = new Product($order->paymentMethod);
                            ?>
                                <option  value="<?php echo $order->getId(); ?>"><?php echo $i.".Order ID: ".$order->getId().", Client: ".$user->firstName." ".$user->lastName.", Cart ID: ".$order->cartId.", Delivery Method: ".$deliveryMethod->getName().", Address: ".$address->adress; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Modify Order</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--<script>-->
<!--    // alert($('#order_id').val());-->
<!--    $(document).ready(function(){-->
<!--        $('#order_id').on("change", function (){-->
<!--            if ($('#order_id').val()>0){-->
<!--                // alert($('#order_id').val());-->
<!--                $('#choose_order').hide();-->
<!--                $('#updateOrder').show();-->
<!--                // $('#choose_order').css('display','block');-->
<!--                // $('#updateOrder').css('display','none');-->
<!--                // $('#order_id').hide();-->
<!--            } else {-->
<!--                // alert($('#order_id').val());-->
<!--                // $('#choose_order').css("display","none");-->
<!--                // $('#updateOrder').css('display','block');-->
<!--                // $('#order_id').show();-->
<!--                $('#choose_order').css('display','block');-->
<!--                $('#updateOrder').css('display','none');-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->

<div class="container" id="updateOrder">
    <div class="row mt-4">
        <div class="col-12">
            <?php
            if ($_POST!=null):
            $order = new Order($_POST['order_id']);
            ?>
            <h3>Update order: </h3>
                <a href="modifyOrderItems.php?orderId=<?php echo$_POST['order_id']?>" type="button"class="btn btn-info">Modify Order Items</a>
            <form action="updateOrder.php" method="post">
                <h4>Update order details: </h4>
                <div class="mb-3">
                    <label for="order_id" class="form-label">ID</label>
                    <input disabled  type="text" class="form-control" id="order_id" name="order_id" placeholder="Order ID:" value="<?php echo $order->getId();?>">
                    <input hidden  type="text" class="form-control" id="order_id" name="order_id" placeholder="Order ID:" value="<?php echo $order->getId();?>">
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <select type="text" class="form-control" id="user_id" name="user_id" placeholder="Select user:">
                        <?php foreach (User::findAll() as $user):?>
                            <option value="<?php echo $user->getId();?>"><?php echo $user->firstName." ".$user->lastName; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

            </form>
            <?php
            if (isset($_POST['user_id'])) {
                $userData = new User($_POST['user_id']);
            }
            ?>
            <form action="processUpdateOrder.php?user_id=<?php if (isset($_POST['user_id'])) {echo $_POST['user_id'];};?>" method="post">
            <input type="number" hidden class="form-control" name="order_id" id="order_id" value="<?php echo $order->getId() ?>">
            <div class="col-12 mb-3 mt-3">
                <select type="text" class="form-control" id="address" name="address" placeholder="Select address:">
                    <?php
                    $userAddresses = $userData->getAdresses();
                    foreach ($userAddresses as $userAddress):
                    ?>
                    <option value="<?php echo $userAddress->getId();?>"><?php echo $userAddress->city." , ".$userAddress->adress; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

                <div class="mb-3">
                    <label for="delivery_method" class="form-label">Delivery method</label>
                    <select type="text" class="form-control" id="delivery_method" name="delivery_method" placeholder="Select delivery method:">
                        <?php foreach (Product::findBy('type','cart_delivery') as $cartDeliveryMethod):
                        ?>
                        <option value="<?php echo $cartDeliveryMethod->getId(); ?>"><?php echo $cartDeliveryMethod->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment method</label>
                    <select type="text" class="form-control" id="payment_method" name="payment_method" placeholder="Select payment method:">
                        <?php
                        foreach (Product::findBy('type','payment') as $cartPaymentMethod):
                            ?>
                            <option value="<?php echo $cartPaymentMethod->getId(); ?>"><?php echo $cartPaymentMethod->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>

        </form>
            <?php endif;?>

            <a href="admin.php"><button class="btn btn-primary mt-2">Back to admin page</button></a>
        </div>
    </div>
</div>
