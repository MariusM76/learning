<?php

class Cart extends Base
{
    public $userId;


    public function getUser()
    {
        return new User($this->userId);
    }

    public function getCartitems()
    {
        $allCartItemsDetails=[];
        $cartItemsIds = CartItem::findBy('cartId',$this->getId());
        foreach($cartItemsIds as $cartItemData ){
            $cartItemsObj = new CartItem($cartItemData->getId());
            $allCartItemsDetails[] = $cartItemsObj;
        }
        return $allCartItemsDetails;
    }

    public function getCartItemIDs($id){
        $cartItemIds = CartItem::findBY('cartId',$this->getId());
        return $cartItemIds;
    }

    public function add($producId, $parentId=null)
    {
        $id = $this->getId();
        if (is_null($parentId)) {
            $sql = "SELECT * FROM cart_items WHERE productId= $producId  AND cartId= $id ";
            $cartItems = query($sql);
        } else {
            $sql = "SELECT * FROM cart_items WHERE productId= $producId AND parentId=$parentId AND cartId= $id ";
            $cartItems = query($sql);
        }


        if (count($cartItems) > 0) {
            $cartItem = new CartItem($cartItems[0]->getId());
            $cartItem->quantity = $cartItem->quantity + 1;
            $cartItem->save();
        } else {
            $cartItem = new CartItem();
            $cartItem->cartId = $this->getId();
            $cartItem->productId = $producId;
            $cartItem->quantity = 1;
            if (!is_null($parentId)) {
                $cartItem->parentId = $parentId;
            }
//            var_dump($cartItem);die;
            $cartItem->save();
        }
    }

//        if(count($cartItem)>0){
//            $data = [
//                'quantity' => $cartItem[0]['quantity']+1,
//            ];
//            update('cart_items',$data,$cartItem[0]['id']);
//        } else {
//                $data = [
//                    'cartId' => $this->id,
//                    'productId' => $producId,
//                    'quantity' => 1,
//                    ];
//
//                if(!is_null($parentId)){
//                    $data [ 'parentId'] = $parentId;
//                }
//                insert('cart_items',$data);
//            }
//    }

    public function getFinalPriceTotal()
    {
        $finalTotal=0;
        foreach ($this->getCartitems() as $cartItem){
            $finalTotal+=$cartItem->getTotal();
        }
        return $finalTotal;
    }

    public function getTotalCartQty()
    {
        $total=0;
        foreach($this->getCartitems() as $cartItem){
            $total+=$cartItem->quantity;
        }
        return $total;
    }

    public function getWeight()
    {
    $totalWeight = 0;
    foreach($this->getCartitems() as $cartItem){
        $totalWeight+= $cartItem->getProduct()->weight;
    }
    return $totalWeight;
    }

    public function deleteCartItems()
    {
        $cartItems = $this->getCartitems();
        foreach ($cartItems as $cartItem){
            delete('cart_items',$cartItem->getId());
        }
    }

    public static function getTableName()
    {
        return 'carts';
    }

    public function getCartTotalValue()
    {
        $totalCartValue = 0;
        foreach($this->getCartitems() as $cartItem){
            $totalItemValue =  $cartItem->quantity * $cartItem->price;
            $totalCartValue = $totalCartValue + $totalItemValue;
        }
        return $totalCartValue;
    }

}