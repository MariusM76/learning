<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$userId = $_SESSION['id'];
$cartId = $_SESSION['cart_id'];

$cart = new Cart($cartId);
$cartTotalValue = $cart->getFinalPriceTotal();
$deliveryCost = 0;
$paymentCost = 0;



$toastDelivery = '
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-body">
    Hello, world! This is a toast message.
    <div class="mt-2 pt-2 border-bottom">
      <button type="button" class="btn btn-primary btn-sm">Take action</button>
      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</button>
    </div>
  </div>
</div>
';


if(isset($_POST['delivery'])){
    if(!empty($_POST['delivery'])) {
        echo '  ';
    } else {
        echo $toastDelivery;
    }
}

if(isset($_POST['payment'])){
    if(!empty($_POST['payment'])) {
        echo '  ';
    } else {
        echo $toastDelivery;
    }
}

if(isset($_POST['adress'])){
    if(!empty($_POST['adress'])) {
        echo '  ';
    } else {
        echo $toastDelivery;
    }
}

$costData = $_POST;


if ($costData==null){
    $costData = null;
} else {
    if (!isset($costData['delivery'])) {
        echo $toastDelivery;
    } else {
        $cart_deliverys = Product::findBy( 'type', 'cart_delivery');

        foreach ($cart_deliverys as $cart_delivery) {
            if ($costData['delivery'] == $cart_delivery->name) {
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
    if (!isset($costData['payment'])) {
        echo $toastDelivery;
    } else {
        $cart_payments = Product::findBy('type', 'payment');

        foreach ($cart_payments as $cart_payment) {

            if ($costData['payment'] == $cart_payment->name) {
                $paymentProduct = new ProductNormalDelivery($cart_payment->getId());

                $paymentCost = $paymentProduct->price;

            }
        }
    }

}

$userData = new User($userId);
$userAdress = $userData->getAdresses();


if(!isset($userAdress) || $userAdress==null ){
    echo "<script>location.href='addAdress.php';</script>";
} else {
    $adress = $userAdress;
}


if (isset($userAdress) && count($userAdress)>=2){
    $crtAdress = $userAdress[0]->adress.', '.$userAdress[0]->city.','.$userAdress[0]->state;
    $adressId =  $userAdress[0]->getId();
} else{
    $crtAdress = $userAdress[0]->getId();
}


$grandTotal = $cartTotalValue + $deliveryCost + $paymentCost;

?>

<div class="container">
    <div class="float-end">
        <table class="table table-success table-striped">
            <tr><div class="fs-4 text-decoration-underline">Summary:</div></tr>
            <tr><div class="fs-5">Total cart: <span class="col-md-3 offset-md-0 text-end"><?php echo $cartTotalValue; ?></span> RON</div></tr>
            <tr><div class="fs-5">Delivery cost: <?php echo $deliveryCost?> RON</div></tr>
            <tr><div class="fs-5">Payment cost:<?php echo $paymentCost?> RON </div></tr>
            <th scope="row"><div class="fs-4">Grand total: <?php echo $grandTotal?> RON</div></th>
        </table>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-8">
<!--            <form action="#" method="post">-->
            <ol class="list-group list-group-numbered">
                <form action="#" method="post">
                <li class="list-group-item mt-2 fs-5 active">Delivery option

                    <ul class="list-group mt-4">
                        <li class="list-group-item">
                            <input class="form-check-input me-1"  type="radio" name="delivery" value="Courier" id="firstRadio"
                            <?php
                            if (isset($_POST['delivery']) && $_POST['delivery']=='Courier'){
                                echo "checked";
                            } ?>
                            >
                            <label class="form-check-label"  for="firstRadio">Normal courier delivery</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="radio" name="delivery" value="Easybox" id="secondRadio"
                                <?php
                                if (isset($_POST['delivery']) && $_POST['delivery']=='Easybox'){
                                    echo "checked";
                                } ?>
                            >
                            <label class="form-check-label" for="secondRadio">Easybox </label>
                        </li>
                    </ul>
                </li>

                <li class="list-group-item mt-4 fs-5 active">Payment options
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="radio" name="payment" value="Card" id="firstRadio"
                                <?php
                                if (isset($_POST['payment']) && $_POST['payment']=='Card'){
                                    echo "checked";
                                } ?>
                            >
                            <label class="form-check-label" for="firstRadio">Card online (free)</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="radio" name="payment" value="Bank" id="secondRadio"
                                <?php
                                if (isset($_POST['payment']) && $_POST['payment']=='Bank'){
                                    echo "checked";
                                } ?>
                            >
                            <label class="form-check-label" for="secondRadio">Bank transfer (might have extra fees)</label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="radio" name="payment" value="Cash" id="thirdRadio"
                                <?php
                                if (isset($_POST['payment']) && $_POST['payment']=='Cash'){
                                    echo "checked";
                                } ?>
                            >
                            <label class="form-check-label" for="thirdRadio">Cash on delivery (+10 RON)</label>
                        </li>
                    </ul>
                </li>
                    <button type="submit" class="btn btn-danger mt-3">Calculate total to pay</button>

                    <li class="list-group-item mt-4 fs-5 active">Choose/Create invoicing adress
                        <div class="input-group mt-3 mb-3">
                            <select class="form-select fs-5" name="adress" id="inputGroupSelect01">
                                <?php
                                if(isset($userAdress) && count($userAdress)>=1):
                                    foreach ($userAdress as $userAdr):
                                        $crtAdress = $userAdr->adress.', '.$userAdr->city.','.$userAdr->state;
                                        ?>
                                        <option value="<?php echo $userAdr->getId();?>"><?php echo $crtAdress;?></option>
                                    <?php endforeach;endif;?>
<!--                                <option value="2">Add adress</option>-->
                            </select>

                        </div>
                    </li>


                    <button type="submit" formaction="processOrderToInvoice.php" class="btn btn-danger mt-3">View invoice</button>
                </form>
            </ol>
        </div>
    </div>
</div>


<?php include 'footer.php'?>
