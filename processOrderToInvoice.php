<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';


$userId = $_SESSION['id'];
$cartId = $_SESSION['cart_id'];
$data = $_POST;

$cart = new Cart($cartId);
$deliveryCost = 0;
$paymentCost = 0;
$clientData = new User($userId);
$adressId= $clientData->getAdresses()[0]->getId();


$invoiceAdress = new Address($adressId);

$crtCartItems = getCurrentCart()->getCartitems() ;

if (!isset($data['delivery'])) {
    echo '';
} else {
    $cart_deliverys = Product::findBy('type', 'cart_delivery');

    foreach ($cart_deliverys as $cart_delivery) {
        if ($data['delivery'] == $cart_delivery->name) {
            $deliveryProduct = new ProductNormalDelivery($cart_delivery->getId());

            if ($deliveryProduct->code == 'kg') {
                $deliveryWeight = getCurrentCart()->getWeight();
                $deliveryCost = $deliveryWeight * $deliveryProduct->price;
            }
            if ($deliveryProduct->code == '0') {
                $deliveryCost = $deliveryProduct->price;
            }
        }
    }
}

if (!isset($data['payment'])) {
    echo '';
} else {
    $cart_payments = Product::findBy('type', 'payment');

    foreach ($cart_payments as $cart_payment) {

        if ($data['payment'] == $cart_payment->name) {
            $paymentProduct = new ProductPayment($cart_payment->getId());
            $paymentCost = $paymentProduct->price;

        }
    }
}


$grandTotal = $deliveryCost + $paymentCost;


?>

<div class="container">
    <div class="row mt-4 justify-content-center">
        <form action="#" method="post">
        <div class="col-10">
            <h3 class="text-center">INVOICE</h3>
            <div class="row">
                <div class="col-10">
                    <div>SC MY SHOP SRL</div>
                    <div>J 12/1205/12.12.2006 </div>
                    <div>CUI RO1864205 </div>
                    <div>CONT RON: RO12BTRL12RONCRT15802149 </div>
                    <div>BANCA TRANSLVANIA </div>
                    <div>ADRESA: Str. Calomfiresc, nr. 20 </div>
                    <div>Timisoara, jud TIMIS </div>
                </div>
                <div class="col-2 text-right">
                    <input class="form-check-input" type="hidden" name="adress" value="<?php echo $invoiceAdress->getId(); ?>">
                    <div><?php echo $invoiceAdress->firstName.' '.$invoiceAdress->lastName ?> </div>
                    <div><?php echo $invoiceAdress->adress ?> </div>
                    <div><?php echo $invoiceAdress->city ?> </div>
                    <div><?php echo $invoiceAdress->state ?> </div>
                    <div><?php echo $clientData->email ?> </div>
                    <div>phone number: <?php echo $invoiceAdress->phone ?> </div>
                </div>
            </div>
            <table class="table table-light table-striped table-hover table-bordered border-primary table-responsive mt-4">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Product description</th>
                    <th scope="col">Price per unit</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $cartTotalValue=0;
                $i=0;
                foreach ($crtCartItems as $cartItem):
                    $productData = new Product($cartItem->productId);
                if ($cartItem->parentId!==null){
                    $ewParentID = $cartItem->parentId;
                }
                    $i = $i +1;
                ?>
                <tr>
                    <td scope="row"> <?php echo $i ?></td>
                    <td><?php
                        echo $productData->getName();
                        if (isset($ewParentID) && $ewParentID!=null){
                            $parentName = Product::findOneBY('id',$ewParentID );
                            echo " ( ".$parentName->name." )";
                        }
                        if ($productData->type=='delivery' || $productData->type=='cart_delivery'){
                            $crtCartIWeight = getCurrentCart()->getWeight();
                            echo " ( ".$crtCartIWeight."kg )";
                        }
                        $cartTotalValue = $cartTotalValue + $productData->getFinalPrice();
                        ?>
                    </td>
                    <td><?php echo $productData->description; ?></td>
                    <td><?php echo formatPrice($productData->getFinalPrice()); ?></td>
                    <td><?php echo $cartItem->quantity; ?></td>
                    <td><?php echo formatPrice($productData->getFinalPrice()*$cartItem->quantity); ?></td>
                </tr>
                <?php  endforeach; ?>

                <?php if ($deliveryCost): ?>
                <tr>
                    <td class="list-group-numbered" scope="row">#</td>
                    <input class="form-check-input" type="hidden" name="<?php echo $deliveryProduct->getId(); ?>" value="<?php echo $deliveryCost; ?>">
                    <td><?php echo $deliveryProduct->name; ?></td>
                    <td><?php echo $deliveryProduct->description; ?></td>
                    <td><?php echo ($deliveryCost); ?></td>
                    <td>1</td>
                    <td><?php echo ($deliveryCost); ?></td>

                </tr>
                <?php endif;?>
                <?php if ($paymentCost): ?>
                    <tr>
                        <td class="list-group-numbered" scope="row">#</td>
                        <input class="form-check-input" type="hidden" name="<?php echo $paymentProduct->getId(); ?>" value="<?php echo $paymentCost; ?>">
                        <td><?php echo $paymentProduct->name; ?></td>
                        <td><?php echo $paymentProduct->description; ?></td>
                        <td><?php echo ($paymentCost); ?></td>
                        <td>1</td>
                        <td><?php echo ($paymentCost); ?></td>

                    </tr>
                <?php endif;?>

                <tr>
                    <th scope="row">#</th>
                    <td colspan="4">TOTAL</td>
                    <td><?php  echo ($grandTotal + $cartTotalValue) ?></td>
                </tr>
                </tbody>

            </table>
            <a href="order.php" class="btn btn-warning mt-3">Back to order page</a>
            <button formaction="finalizeOrder.php" type="submit" class="btn btn-info mt-3 p-2"">Finalize order</button>
        </div>
    </form>
    </div>
</div>