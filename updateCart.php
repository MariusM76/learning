<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$userId = $_SESSION['id'];
$cartId = $_SESSION['cart_id'];

$cart = new Cart($cartId);
$cartItemsData = $cart->getCartitems();

?>

    <div class="container">
        <div class="row mt-4">
            <form action="processUpdateCart.php" method="post">
            <div class="col-12">

                    <div class="mb-3" id="#">
                        <h3>Edit cart: </h3>
                        <ol class="list-group list-group-numbered">
                            <?php
                            $valueCart = 0;
                            foreach ($cartItemsData as $cartitem):
                            $item = new Product($cartitem->productId);
                            ?>
                            <li class="list-group-item ">
                                <form >
                                    <label for="product_name" class="form-label"><h4><?php echo $item->getName(); ?></h4></label>
                                    <input type="text" class="form-control visually-hidden"
                                           id="#" value=""
                                           name="">
                                    <ol class="list-group list-group-horizontal">
                                        <div class="mb-3">
                                            <label for="<?php echo $item->getId(); ?>"
                                                   class="form-label">Quantity:</label>
                                            <input min="1" type="number" class="form-control" id="<?php echo $item->getId();?>"
                                                   value="<?php echo $cartitem->quantity; ?>" name="<?php echo $item->getId();?>"
                                                   placeholder="Enter quantity:">
                                        </div>
                                        <div class="mb-3">
                                            <label for="#" class="form-label">Item price:</label>
                                            <input type="number" class="form-control" id="#"
                                                   value="<?php echo $item->getFinalPrice(); ?>"
                                                   name="#" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="#" class="form-label">Total price:</label>
                                            <input type="number" class="form-control" id="quantity"
                                                   value="<?php echo $item->getFinalPrice()*$cartitem->quantity; $valueCart = $valueCart + $item->getFinalPrice()*$cartitem->quantity;?>"
                                                   name="#" disabled>
                                        </div>
                                        <div class="colspan-4"></br>
                                            <a href="deleteCartItem.php?productId=<?php echo $cartitem->productId;?>" class="btn btn-danger">X</a>
                                        </div>
                                    </ol>
                                    <?php endforeach; ?>
                                    <a href="processUpdateCart.php">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </a>
                                </form>
                            </li>
                        </ol>
                    </div>
                    <div>
                        <h3>Total de plata: <?php echo $valueCart;?> lei</h3>
                    </div>

            </div>
            </form>
        </div>
    </div>

<?php include 'footer.php' ?>