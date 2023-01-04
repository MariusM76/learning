<?php

include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';

$address = new Address();
$address->firstName = $_POST['first_name'];
$address->lastName = $_POST['last_name'];
$address->phone = $_POST['phone'];
$address->city = $_POST['city'];
$address->state = $_POST['state'];
$address->adress = $_POST['adress'];
$address->userId = $_POST['user_id'];
$address->save();


//
//$data = [
//    'firstName' => $_POST['first_name'],
//    'lastName' => $_POST['last_name'],
//    'phone' => $_POST['phone'],
//    'city' => $_POST['city'],
//    'state' => $_POST['state'],
//    'adress' => $_POST['adress'],
//    'userId' => $_POST['user_id'],
//];
//
//insert('adresses',$data);
echo "<script>location.href='main.php';</script>";
//header("Location: admin.php");