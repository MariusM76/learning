<?php
include 'parts/header.php';
include 'functions.php';


$addressToDelete = new Address($_POST['address_id']);
$addressToDelete->delete();
header("Location: admin.php");