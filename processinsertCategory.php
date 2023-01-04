<?php
include 'functions.php';

$newCategory = new Category();
$newCategory->name = $_POST['name'];
$newCategory->save();

//var_dump($_POST);die;
//
//insert ('categories',$data);
header('Location: admin.php');