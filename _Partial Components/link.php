<?php
ob_start();

include_once('./_Partial Components/Database.php');
include_once('./_Partial Components/Format.php');

include_once('./_Partial Components/CRUD.php');
spl_autoload_register(function($class){
include_once "_Partial Components/".$class.".php";
});

?>
<!DOCTYPE html>
<title> Sign in </title>
<head> 
  <meta name="viewport" content=" width=device-width, initial-scale=1" />
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/signin_style.css">
    <link rel="stylesheet" href="./assets/css/animated.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="./assets/img/Graduation Cap_48px.png">

    <!-- JavaScript -->
    <!-- <script src="./assets/js/jquery.js"></script> -->
    <!-- <script src="./assets/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="assets/js/online.quiz.js"></script> -->

</head>