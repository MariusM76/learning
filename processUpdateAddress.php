<?php
include 'parts/header.php';
include 'functions.php';


$address = new Address($_POST['address_id']);
$address->firstName = $_POST['first_name'];
$address->lastName = $_POST['last_name'];
$address->phone = $_POST['phone'];
$address->city = $_POST['city'];
$address->state = $_POST['state'];
$address->adress = $_POST['adress'];
$address->save();

//$data = [
//    'id' => $_POST['address_id'],
//    'firstName' => $_POST['first_name'],
//    'lastName' => $_POST['last_name'],
//    'phone' => $_POST['phone'],
//    'city' => $_POST['city'],
//    'state' => $_POST['state'],
//    'adress' => $_POST['adress'],
//];
//
//update('adresses',$data,$_POST['address_id']);
header("Location: admin.php");