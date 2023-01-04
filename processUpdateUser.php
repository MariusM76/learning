<?php
include 'functions.php';

$userId = $_GET['id'];
$data = $_POST;
$files = $_FILES;

//var_dump($data);die;

$filepath = "C:/wamp64/www/tema20/images/".$files['avatar']['name'];
$userAvatarNull = "C:/wamp64/www/tema20/images/userAvatarNull.png";

if ($files['avatar']['name']==NULL){
    $files['avatar']['name'] = 'userAvatarNull.png';
}

$avatarId = Avatar::findby('userId',$userId);
//var_dump($avatarId);die;

if (!empty($avatarId) || count($avatarId)>1){
    foreach ($avatarId as $avatar){
        $avatar = new Avatar($avatar->getId());
        $avatar->delete();
    }
} elseif (count($avatarId)==1) {
    delete($avatarId['id']);
}

$avatar = new Avatar();
$avatar->image = $files['avatar']['name'];
$avatar->userId = $userId;
$avatar->save();

$user = new User($userId);
$user->fromArray($data);
//$user->firstName = $data['first_name'];
//$user->lastName =$data['last_name'];
//$user->email = $data['email'];
//$user->password = $data['password'];
//$user->role = $data['role'];
$user->save();

//copy($image['image'], $filepath);
//update('avatars',$image,$id);
//update('users',$data,$id);
header("Location: admin.php");
