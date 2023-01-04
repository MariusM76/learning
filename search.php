<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';


$query = "SELECT * FROM products";

$filters = [];



$vendorIds = searchArray($_GET,'vendor');
$categoryIds = searchArray($_GET,'category');
$priceRanges = searchArray($_GET,'price_range');

$filtersArray = [];
$filtersString1 = '';
$filtersString2 = '';
$filtersString3 = '';
$filters1 = [];
$filters2 = [];
$filters3=[];

if (isset($_GET['search'])){
    $search = $_GET['search'];
    $filtersArray[] = "name LIKE '%$search%' OR description LIKE '%$search%'";
} else {
    $filtersArray[] = "name LIKE '%'";
}


foreach ($vendorIds as $vendor){
    $filters1[] = "vendorId =".$vendor;
}

if (count($filters1)> 1){
    $filtersString1 = "(".implode(' OR ',$filters1).")"." AND type = 'product' ";
} elseif(count($filters1) == 1) {
    $filtersString1 = $filters1[0]." AND type = 'product' ";;
}
if($filtersString1 !== ''){
    $filtersArray[] = $filtersString1;
}

foreach ($categoryIds as $category){
        $filters2[] = "categoryId =".$category;
}
if(count($filters2) > 1){
    $filtersString2 = "(".implode(' OR ',$filters2).")";
} elseif(count($filters2) == 1) {
    $filtersString2 = $filters2[0];
}
if($filtersString2 !== ''){
    $filtersArray[]=$filtersString2;
}

foreach ($priceRanges as $priceRange){
        if($priceRange =='1-100'){
            $filters3[] = "price >= 1 AND price <= 100";
        }
        if($priceRange=='101-500'){
            $filters3[] = "price >= 101 AND price <= 500";
        }
        if($priceRange=='501-2000'){
            $filters3[] = "price >= 501 AND price <= 2000";
        }
        if($priceRange=='>2000'){
            $filters3[] = "price >2000";
        }
}
if (count($filters3)>1){
    $filtersString3 = "(".implode(' OR ',$filters3).")";
} elseif(count($filters3)==1) {
    $filtersString3 = $filters3[0];
}
if($filtersString3 !== ''){
    $filtersArray[]=$filtersString3;
}

$filters = implode(" AND ",$filtersArray);
$query.=" WHERE ".$filters;
$searchedProducts = query($query);
$products = [];

if ($searchedProducts == NULL) {
    $searchedProducts = [];
?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Rezultatul cautarii</h1>
                </div>
                <div class="modal-body">
                   There are no products
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
    </script>
<?php
} else {
    foreach ($searchedProducts as $searchedProduct) {
        $products[] = new Product($searchedProduct['id']);
    }
}

?>


<div class="container">
    <form method="get" action="search.php">
        <div class="row">
            <div class="col-3 mt-5">
                <h3>Vendor</h3>
                <?php
                $allvendors= Vendor::findAll();
                foreach ($allvendors as $ven):
                    $vendorObj = new Vendor($ven->getId())
                    ?>
                    <input type="checkbox" name="vendor<?php echo $vendorObj->getId() ?>" value="<?php echo $vendorObj->getId() ?>"
                    <?php
                    foreach ($vendorIds as $vendor){
                        if ($vendor!=null && $vendor==$vendorObj->getId()){
                            echo "checked";
                        }
                    }
                    ?>
                    />
                    <?php echo $vendorObj->name ?> </br>
                <?php endforeach; ?>
            </div>
            <div class="col-3 mt-5">
                <h3>Category</h3>
                <?php
                $allcategories= Category::findAll();
                foreach ($allcategories as $cat):
                    $categoryObj = new Category($cat->getId())
                    ?>
                    <input type="checkbox" name="category<?php echo $categoryObj->getId() ?>" value="<?php echo $categoryObj->getId() ?>"
                    <?php
                    foreach ($categoryIds as $category){
                        if ($category==$categoryObj->getId()){
                            echo "checked";
                        }
                    }
                    ?>
                    /><?php echo $categoryObj->name ?> </br>
                <?php endforeach; ?>
            </div>
            <div class="col-3 mt-5">
                <h3>Price</h3>
                <input type="checkbox" name="price_range1" value="1-100"/
                <?php
                foreach ($priceRanges as $priceRange){
                    if ($priceRange=="1-100"){
                        echo "checked";
                    }
                }
                ?>
                >1-100<br />
                <input type="checkbox" name="price_range2" value="101-500"
                    <?php
                    foreach ($priceRanges as $priceRange){
                        if ($priceRange=="101-500"){
                            echo "checked";
                        }
                    }
                    ?>
                />101-500<br />
                <input type="checkbox" name="price_range3" value="501-2000"
                    <?php
                    foreach ($priceRanges as $priceRange){
                        if ($priceRange=="501-2000"){
                            echo "checked";
                        }
                    }
                    ?>
                />501-2000<br />
                <input type="checkbox" name="price_range4" value=">2000"
                    <?php
                    foreach ($priceRanges as $priceRange){
                        if ($priceRange==">2000"){
                            echo "checked";
                        }
                    }
                    ?>
                />>2000<br />
            </div>
            <div class="col-3 mt-5">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12 mt-4">
            <h2>Search</h2>
        </div>
        <?php
            foreach ($products as $product) {
                $product->card();
            }
        ?>
    </div>
</div>

