<?php
session_start();
if(!isset($_SESSION['user_id'])){
    die("Access Denied!");
}
require './includes/database.php';
require './includes/content.php';

$db = (new Database()) -> getConnection();
$content = new Content($db);

if(isset($_SESSION['user_id'])){
    $content->delete($_GET['id']);;
}

header('Location: dashboard.php');
exit;

?>