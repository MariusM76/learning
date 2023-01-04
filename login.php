<?php
include 'parts/header.php';
session_start();

?>
<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-5 text-center">
            <div class="card ">
                <div class="card-body">
                    <form action="processLogin.php" method="post" class="mt-4">
                    <div class="form-floating mb-3 mt-2 col align-self-center">
                        <input type="email"  class="form-control" name="email" id="email" placeholder="name@example.com">
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating ">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                        <label for="pass">Password</label>
                    </div>
                        <button type="submit" class="btn btn-primary mt-2">Login</button>
                    </form>
                    <div>
                        <a href="insertUser"><button type="submit" class="btn btn-primary mt-2">Create account</button></a>
                        <a href="main.php"><button type="submit" class="btn btn-primary mt-2">Back to main page</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
