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
    $user->delete($_GET['id']);;
}

header('Location: index.php');
exit;

?>