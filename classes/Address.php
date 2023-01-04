<?php

class Address extends Base
{
    public $firstName;

    public $lastName;

    public $phone;

    public $city;

    public $state;

    public $adress;

    public $userId;

    public static function getTableName()
    {
        return 'adresses';
    }

}