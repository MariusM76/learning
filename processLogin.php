<?php

include 'parts/header.php';
include 'functions.php';


$loginData = $_POST;

$loginEmail = $loginData['email'];
$loginpass = $loginData['pass'];


$userData = User::findBy('email',$loginEmail);
?>

<div class="modal" id="modal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal1">WARNING</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Invalid E-mail
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php



if ($userData!=NULL) {
    $dbUser = new User($userData[0]->getId());
    if ($dbUser->password == $loginpass ) {
        $_SESSION['authUser'] = $dbUser->firstName.' '.$dbUser->lastName;
        $_SESSION['role'] = $dbUser->role;
        $_SESSION['id'] = $dbUser->getId();
        $_SESSION['cart_id']=$dbUser->getCart()->getId();


        if ($_SESSION['role']=='admin'){
            header('Location: admin.php');
        } else {
            header('Location: main.php');
        }
    } else {
        echo '.<div>"Incorrect password. Please try again";</div>.';
        header('Location: login.php');
    }
    } else {

    echo '
    <script>
    var modalObj = document.getElementById("modal1");
    var spanObj = document.getElementsByClassName("close")[0];
    modalObj.style.display = "block";
    spanObj.onclick = function()
    {
        modalObj.style.display = "none";
    }
    window.omclick = function(event)
    {
        if (event.target==modalObj)
        {
            modalObj.style.display = "none";
        }
    }
</script>
    ';

    header('Location: main.php');
    }
?>

