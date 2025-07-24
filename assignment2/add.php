<?php
    $pageTitle = "Register | Authentication Part Tow";
    $pageDesc = "This page will allow the user to register to our application.";
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    }


?>