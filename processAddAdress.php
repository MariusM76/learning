<?php
include 'functions.php';

$address = new Address();
$address->firstName = $_POST['first_name'];
$address->lastName = $_POST['last_name'];
$address->phone = $_POST['phone'];
$address->city = $_POST['city'];
$address->state = $_POST['state'];
$address->adress = $_POST['adress'];
$address->userId = $_SESSION['id'];
$address->save();

//$data = [
//    'firstName' =>  $_POST['first_name'],
//    'lastName' => $_POST['last_name'],
//    'phone' => $_POST['phone'],
//    'city' => $_POST['city'],
//    'state' => $_POST['state'],
//    'adress' => $_POST['adress'],
//    'userId' => $_SESSION['id'],
//];
//insert('adresses', $data);
header('Location: order.php');