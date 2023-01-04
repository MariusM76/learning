<?php
include 'functions.php';

$category_id = $_GET['id'];
$newCategoryName = $_POST;

$updateCategory = new Category($category_id);
$updateCategory->name = $newCategoryName['category_id'];
$updateCategory->save();

header("Location: admin.php");

