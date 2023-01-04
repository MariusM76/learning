<?php
include 'parts/header.php';
include 'functions.php';
include 'mainmenu.php';
?>
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="card text-center">
                <div class="card-header">
                    <div class="border border-top-0 border-start-0 border-end-0 border-danger mt-3"><h3>ADMIN PANEL</h3></div>
                    <ul class="nav nav-tabs card-header-tabs justify-content-around mt-5">
                        <li class="nav-item list-group-flush">
                            <div class="dropdown-center">
                                <button class="btn btn-warning dropdown-toggle mb-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage products
                                </button>
                                <ul class="dropdown-menu list-group-flush">
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="insertproduct.php">Add product</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="updateproduct.php">Update product</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="deleteProduct.php">Delete product</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown-center">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage categories
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="insertCategory.php">Add category</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="updateCategory.php">Update category</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="deleteCategory.php">Delete category</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown-center">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage users
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="insertUser.php">Add user</a></li>
                                    <li ><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="updateUser.php">Update user</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="deleteUser.php">Delete user</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="showUsers.php">Show users</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown-center">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage addresses
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="insertAddress.php">Add address</a></li>
                                    <li ><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="viewAdresses.php">View adresses</a></li>
                                    <li ><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="updateAddress.php">Update adresses</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="deleteAddress.php">Delete addreses</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown-center">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage orders
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="viewOrders.php">View orders</a></li>
                                    <li ><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="updateOrder.php">Update order</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="list-group-item list-group-item-action list-group-item-info"><a class="dropdown-item" href="deleteOrder.php">Delete order</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Welcome admin!!</h5>
                    <p class="card-text">You can select an option from menus</p>
                    <a href="searchProductCategorySales"><button type="submit" class="btn btn-dark">Sales statistics</button></a>
                    <a href="main.php" class="btn btn-primary">Go to main page</a>
                </div>
            </div>
        </div>
    </div>
</div>