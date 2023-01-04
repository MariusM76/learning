<?php
include 'functions.php';

$userToDelete = new User($_POST['user']);
$addressesToDelete = $userToDelete->getAdresses();

if(count($addressesToDelete)>1){
    foreach ($addressesToDelete as $addressToDelete){
        $addressToDelete = new Address($addressToDelete['id']);
        $addressToDelete->delete();
    }
} elseif ($addressesToDelete==1){
    $addressToDelete = new Address($addressesToDelete['id']);
    $addressToDelete->delete();
}

$userToDelete->delete();

header("Location: admin.php");