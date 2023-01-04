<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$userId = $_SESSION['id'];
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12 mt-4 mb-2">
            <h2>Cart: </h2>
        </div>
        <div>
            <ol class="list-group list-group-numbered fs-5 fw-semibold ">
                <?php
                $cartId = $_SESSION['cart_id'];
                $cart = new Cart($cartId);
                if($cart->getCartitems()==null){?>
                    <h3>Cart is empty!</h3>
                <?php } else {
                  foreach ($cart->getCartitems() as $item):
                  ?>
                <li class="list-group-item ">
                    <img style="height: 50px" class="img-fluid" src="./images/<?php echo $item->getProduct()->getFirstImage()->file;?>" </img>
                    <span class="fw-bold fs-4"><?php echo $item->getProduct()->getName();?></span>
                    <ol class="list-group list-group-horizontal">
                        <li class="list-group-item ">
                            <span>Quantity: <?php echo $item->quantity ;?></span>
                        </li>
                        <li class="list-group-item">
                            <span>Item price: <?php echo formatPrice($item->getProduct()->getFinalPrice())?> RON </span>
                        </li>
                        <li class="list-group-item mb-4">
                            <span>Total price:
                                <?php echo formatPrice($item->getTotal()); ?>RON</span>
                        </li>
                    </ol>
                    <?php endforeach;?>
                </li>

            </ol>
            <div class="mb-2 col-md-3 offset-md-9 text-end">
                <h5>Total weight: <?php echo $cart->getWeight() ; ?> Kg</h5>
            </div>
            <div class="mb-5 col-md-3 offset-md-9 text-end">
                <h4>Total de plata: <?php echo formatPrice($item->getCart()->getFinalPriceTotal()) ; ?> RON</h4>
            </div>
            <div>
                <a href="updateCart.php"><button type="submit" class="btn btn-danger col-md-2 offset-md-10">Modify cart</button></a>
<!--                <div class="col-md-3 offset-md-3">-->
                <a href="order.php"><button type="submit" class="btn btn-info col-md-2 offset-md-10">Finalize shopping</button></a>
<!--                </div>-->
            </div>

            <?php } ?>
        </div>
        <div>
            <a href="main.php"><button type="submit" class="btn btn-primary mt-2">Back to main page</button></a>
        </div>
    </div>
</div>
<?php include 'footer.php'?>


