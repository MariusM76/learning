
<nav class="navbar navbar-expand-lg bg-light sticky-sm-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav-item me-auto mb-2 mb-lg-0 pr-3">
                <a class="nav-link active" aria-current="page" href="main.php">Home</a>
            </ul>
            <ul class="navbar-nav me-auto pl-4 mb-2 mb-lg-0">
                 <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $allcategories= Category::findAll();
                        foreach ($allcategories as $cat):
                            $categoryObj = new Category($cat->getId())
                        ?>
                        <li><a class="dropdown-item" href="category.php?catpage=<?php echo $categoryObj->getId();?>"><?php echo $categoryObj->name?>(<?php echo count($categoryObj->getProducts()) ?>)</a></li>
                        <?php endforeach; ?>
                    </ul>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Vendors
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $allvendors= Vendor::findAll();
                        foreach ($allvendors as $ven):
                            $vendorObj = new Vendor($ven->getId())
                            ?>
                            <li><a class="dropdown-item" href="vendor.php?id=<?php echo $vendorObj->getId();?>"><?php echo $vendorObj->name?>(<?php echo count($vendorObj->getProducts()) ?>)</a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
            <li class="list-group-item">
                <form method="get" action="search.php">
                    <input type="text" name="search"/>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </li>
        <div class="collapse navbar-collapse span-6" id="navbarSupportedContent">

            <div class="col-9 text-end">
                <?php if (getAuthUser()): ?>
                    <?php echo "Welcome,  ".$_SESSION['authUser']."   " ?><a class="btn btn-outline-info mr-2" href="logout.php">Logout</a>
                        <a href="cart.php">
                            <i class="fa fa-shopping-cart fs-1 mt-1" aria-hidden="true">
                            <span class="position-absolute fs-6 badge rounded-pill bg-danger"><?php echo sumTotalCartItems();
                            ?></span>
                            </i>
                        </a>
                <?php else: ?>
                <form class="d-flex" >
                    <a href="login.php" class="btn btn-outline-success"  >Login</a>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</nav>