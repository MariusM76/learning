<?php

class User extends Base
{
    public $firstName;

    public $lastName;

    public $email;

    public $password;

    public $role;

    public function getCart()
    {
        $userCartId = Cart::findOneBY('userId',$this->getId());
        if($userCartId != null){
            return new Cart($userCartId->getId());
        } else {
            return new Cart();
        }
    }

    public function getAdresses()
    {
        $userAdressses = Address::findBy('userId',$this->getId());
        return $userAdressses;
    }

    public static function getTableName()
    {
        return 'users';
    }

}