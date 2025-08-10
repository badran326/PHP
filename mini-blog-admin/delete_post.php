<?php
session_start();
if(!isset($_SESSION['user_id'])){
    die("Access Denied!");
}
require './inc/db.php';
require './inc/blog_admin.php';
require './inc/user.php';

$db = (new db()) -> getConnection();
$blog = new BlogAdmin($db);
$user = new User($db);

if(isset($_GET['id'])){
    if ($_SESSION['user_id'] == $_GET['id']) {
        $user->delete($_GET['id']);;
        session_start();
        session_destroy();
        header('Location: index.php');
        exit;
    }
    $user->delete($_GET['id']);;
}

header('Location: posts.php');
exit;

?>