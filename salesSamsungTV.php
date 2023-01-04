<?php
include 'functions.php';

$query = query("SELECT * FROM products WHERE name LIKE '%SAMSUNG%' OR description LIKE '%SAMSUNG%';");

foreach ($query as $samsungProduct){
    $samsungProductObjs[] = new Product($samsungProduct['id']);
}

$sales = Orderitem::findAll();

$totalSalesOfSamsung=0;

for ($i=0;$i<count($sales);$i++){
    foreach ($samsungProductObjs as $samsungProductObj){
        if($sales[$i]->productId==$samsungProductObj->getId()){
            $totalSalesOfSamsung = $sales[$i]->price + $totalSalesOfSamsung;
        }
    }
}
echo $totalSalesOfSamsung;