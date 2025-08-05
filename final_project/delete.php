<?php
session_start();
if(!isset($_SESSION['user_id'])){
    die("Access Denied!");
}
require './includes/database.php';
require './includes/user.php';

$db = (new Database()) -> getConnection();
$user = new User($db);

if(isset($_SESSION['user_id'])){
    if ($_SESSION['user_id'] == $_GET['id']) {
        $user->delete($_GET['id']);;
        session_start();
        session_destroy();
        header('Location: index.php');
        exit;
    }
    $user->delete($_GET['id']);;
}

header('Location: dashboard.php');
exit;

?>