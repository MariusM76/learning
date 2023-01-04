<?php

include 'functions.php';

$cateoryToDelete = new Category($_POST['id']);

$cateoryToDelete->delete();

header("Location: admin.php");