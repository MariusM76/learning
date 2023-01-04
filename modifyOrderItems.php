<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';


$Order = new Order($_GET['orderId']);
$orderItems = $Order->getOrderItems();
//var_dump($orderItems);die;

?>


<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h3>Order no. <?php echo $Order->getId();?> / Edit order items:</h3>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Parent ID</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                foreach ($orderItems as $orderItem):
                $i=$i +1 ;
                ?>
                <tr>
                    <form action="processModifyOrderItem.php?$itemId=<?php echo $orderItem->getId() ?>" method="post">
                    <th scope="row"><?php echo $i;?></th>
                    <td><div class="mb-3">
<!--                            <label hidden for="orderId" id="orderId" name ="orderId" class="form-label" value="--><?php //echo $Order->getId() ?><!--"></label>-->
                            <input disabled="true" type="" class="form-control" id="productId" name ="productId" placeholder="Product ID" value="<?php echo $orderItem->getProduct()->getId();?>">
                        </div>
                    </td>
                    <td><div class="mb-3">
                            <input disabled type="text" class="form-control" id="name" name ="name" placeholder="Product Name" value="<?php echo $orderItem->getProduct()->name;?>">
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <input min="1"  type="number" class="form-control" id="quantity" name ="quantity" placeholder="Quantity" required value="<?php echo $orderItem->quantity;?>">
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <input min="1"  type="text" class="form-control" id="price" name ="price" placeholder="Price" required value="<?php echo $orderItem->price;?>">
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <input  type="number" class="form-control" id="parentId" name ="parentId" placeholder="Parent ID" value="<?php echo $orderItem->parentId;?>">
                        </div>
                    </td>
                    <td>
                        <button type="submit"  class="btn btn-success">Update</button>
                    </td>
                    <td>
                        <a href="deleteOrderItem.php?$itemId=<?php echo $orderItem->getId() ?>" type="submit"  class="btn btn-danger">Delete</a>
                    </td>
<!--                        --><?php //var_dump($_POST); die;?>
                    </form>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <a href="admin.php"><button class="btn btn-primary" type="submit">Back to admin page</button></a>
            <a href="updateOrder.php"><button class="btn btn-primary" type="submit">Back to orders page</button></a>
        </div>
    </div>