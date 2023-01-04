<?php

include 'functions.php';

$data = $_POST;
$files = $_FILES;
$errorMessage = '';
$emailExists = User::findOneBY('email',$_POST['email']);
if($emailExists){
    $errorMessage = 'duplicated email';
}
//var_dump($files);die;

$firstNameExists = User::findOneBY('firstName',$_POST['first_name']);
$lastNameExists = User::findOneBY('lastName',$_POST['last_name']);
if($firstNameExists && $lastNameExists){
    $errorMessage .= '<br> name already in use';
}

if($errorMessage != ''){
    $_SESSION['errorMessage'] = $errorMessage;
    header('Location: insertUser.php');
    die;
}


if ($files['avatar']['tmp_name']!=NULL){
    copy ($files['avatar']['tmp_name'],'C:/wamp64/www/tema20/images/'.$files['avatar']['tmp_name']);
    $image = $files['avatar']['tmp_name'];
} else {
    $image = 'userAvatarNull.png';
}

$user = new User();
$user->firstName =  $data['first_name'];
$user->lastName =  $data['last_name'];
$user->email =  $data['email'];
$user->password =  $data['password'];
$user->role =  $data['role'];
$user->save();

$avatar = new Avatar();
$avatar->image = $image;
$avatar->userId = $user->id;
$avatar->save();

//if ($image['file']==NULL){
//    $image['file'] = 'userAvatarNull.png';
//} else {
//    $image['file'] = $files['avatar']['name'];
//}

//$image = [
//    'file' => $files['avatar']['name'],
//    'user_id' =>$user->id,
//];
//
//if ($image['file']==NULL){
//    $image['file'] = 'userAvatarNull.png';
//}

//if ($files['avatar']['tmp_name']==NULL){
//    $files['avatar']['tmp_name'] = 'C:/wamp64/www/tema20/images/userAvatarNull.png';
//}

//insert('avatars',$image);
header('Location: main.php');