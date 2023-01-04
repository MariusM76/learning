<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$orders = Order::findAll();

?>


<div class="container">
    <div class="row mt-4">
        <div class="col-12">
                <h3>Current orders:</h3>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">User name</th>
                    <th scope="col">Cart ID</th>
                    <th scope="col">Delivery method</th>
                    <th scope="col">Address</th>
                    <th scope="col">Payment method</th>
                    <th scope="col">Order items</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                foreach ($orders as $OrderDetails):
                $i=$i +1 ;
//                $OrderDetails = new Order($order['id']);
                $orderItems = $OrderDetails->getOrderItems();
                $user = new User($OrderDetails->userId);
                $deliveryMethod = new Product($OrderDetails->deliveryMethod);
                $address = new Address($OrderDetails->addressId);
                $paymentMethod = new Product($OrderDetails->paymentMethod);
                ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $OrderDetails->getId();?></td>
                    <td><?php echo $OrderDetails->userId;?></td>
                    <td><?php echo $user->firstName." ".$user->lastName;?></td>
                    <td><?php echo $OrderDetails->cartId;?></td>
                    <td><?php echo $deliveryMethod->getName();?></td>
                    <td><?php echo $address->adress;?></td>
                    <td><?php echo $paymentMethod->name;?></td>
                    <td>

                        <button type="button" id="myModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal-<?php echo $OrderDetails->getId();?>">
                            View order items
                        </button>

                        <div class="modal fade modal-xl" id="myModal-<?php echo $OrderDetails->getId();?>"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="myModal">Order no. <?php echo $OrderDetails->getId();?> / Order items: </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Order items ID</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            $orderItems = $OrderDetails->getOrderItems();
                                            $j=0;
                                            foreach ($orderItems as $orderItemData):
                                            $j = $j + 1;
//                                                $orderItemData = new Orderitem($orderItem->getId());
                                                $product = $orderItemData->getProduct();
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $j; ?></th>
                                                    <td><?php echo $product->getId();?></td>
                                                    <td><?php echo $product->getName();?></td>
                                                    <td><?php echo $orderItemData->orderId;?></td>
                                                    <td><?php echo $orderItemData->quantity;?></td>
                                                    <td><?php echo $product->getFinalPrice();?> RON</td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <th scope="row">#</th>
                                                <td><b>TOTAL ORDER:  </b></td>
                                                <td colspan="2"><?php echo $OrderDetails->getTotalOrderValue();?> RON</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a href="admin.php"><button class="btn btn-primary" type="submit">Back to admin page</button></a>
        </div>
    </div>


