<?php

session_start();
include 'classes.php';


$mysql = mysqli_connect('127.0.0.1:3306', 'root', '','course18-shop');


function query($sql) {
    global $mysql;
    $query = mysqli_query($mysql, $sql);
    if($query===true){
        return true;
    }
    if ($query===false){
        die('Error on: '.$sql);
    }
    return  mysqli_fetch_all($query,MYSQLI_ASSOC);
}



function findByMultipleConditions($tableName, $conditions = []){
    $noOfConditions = count($conditions);
    $ccc = 0;
    $sql1 = "SELECT * FROM $tableName WHERE ";
    $sql2 = '';
    foreach ($conditions as $column=>$value) {
        $ccc = $ccc + 1;
        if ($ccc<$noOfConditions){
            $sql2 = $sql2.($column." = '".$value."' AND ");
        } else {
            $sql2 = $sql2.($column." = '".$value."' ;");
        }
    }
    $result = query($sql1.$sql2);
//    var_dump(($sql1.$sql2));die;
    return $result;

}

function findByColumn ($tableName, $column){
    $sql    = "SELECT * FROM $tableName WHERE $column ;";
    $result = query($sql);
    if (isset($result)) {
        return $result;
    } else {
        return false;
    }
}


function getAuthUser(){
    if (isset($_SESSION['authUser'])) {
        return $_SESSION['authUser'];
    } else {
        return false;
    }
}

function priceFormat ($price) {
    $intPart = intval($price);
    $floarPart = intval(($price - $intPart)*100);

    return "$intPart<sup>$floarPart</sup>";
}

function sumTotalCartItems()
{
    $userData = new User($_SESSION['id']);
    $userCart = $userData->getCart();
    $cartItemsObj = $userCart->getCartitems();

    $qty = [];
    foreach ($cartItemsObj as $totalUserItemsinCart){
        $qty[] = $totalUserItemsinCart->quantity;
    }
    $totalQty = array_sum($qty);
    return $totalQty;
}

function formatPrice($price){
    $intPart = intval($price);
    $floarPart = substr($price,-2);

    return $intPart."<sup>".$floarPart."</sup>";
}

function getCurrentCart(){
    if (isset($_SESSION['cart_id'])){
        $currentCart = new Cart($_SESSION['cart_id']);
        return $currentCart;
    }
}

function searchArray($array,$needle){
    $result = [];
    foreach ($array as $key => $value)
    {
        if (strpos($key,$needle)!== FALSE)
        {
            $result[]= $value;
        }
    }
    return $result;
}

function getDeliveryPrice($deliveryOptName){
    $delivPrice = findBy('products','name',$deliveryOptName)[0]['price'];
    if($delivPrice==null){
        $delivPrice = null;
    } else {
    return $delivPrice;
    }
    return $delivPrice;
}

function getEWParentProductId($id){
    $parentProductId = 0;
    if (getCurrentCart()!=null) {

        $parentProductSearch = CartItem::findBy('productId',$id);

        if ($parentProductSearch!=null) {
            $parentProductId = $parentProductSearch[0]->parentId;
        }
    } else {
        $ewOrderItem = Orderitem::findOneBY('productId',$id);
        if ($ewOrderItem!=null) {
            $parentProductId = $ewOrderItem->parentId;
        } else {
            $parentProductId = null;
        }
    }
    if ($parentProductId==null){
        return null;
    } else {
        return $parentProductId;
    }
}

function showUserCard($id) {
    $user = User::find($id);
    $image = Avatar::findOneBY('userId',$id);

    if (!isset($imageSet)){
        $imageSet = 'userAvatarNull.png';
    } else {
        $imageSet = $image['image'];
    }

    echo '<div class="col">
            <div class="card h-80" style="width: 18rem;">
                <img src="./images/'.$imageSet.'" class="card-img-top m-0" alt="'.$user->firstName.",".$user->lastName.'">
                <div class="card-body text-center">
                    <h6 class="card-title">
                        <a class="card-text text-decoration-none lh-1" href="#">
                            <p class="text-truncate text-decoration-none text-dark">'.$user->firstName.",".$user->lastName.'</p>
                        </a>
                    </h6>
                    <div class="mt-2 col text-center">
                            <div class="col">
                                <h6 class="mt-2 p-0 fs-6 text-dark">'.($user->role).'</h6>
                            </div>   
                    </div>
                </div>
            </div>
        </div>' ;
}