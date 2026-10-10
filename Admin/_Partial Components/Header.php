<?php
ob_start();
session_start();
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/timeout.php');
include_once($filepath.'/Database.php');
include_once($filepath.'/Format.php');
include_once($filepath.'/CRUD.php');
include_once($filepath.'/Method.php');
spl_autoload_register(function($class){
include_once "_Partial Components/".$class.".php";
});
$db = new Database();
$fm = new Format();
$usr = new CRUD();
$exm = new Method();


// if(isset($_SESSION['Username'])){ 
//     $Username = $_SESSION['Username'];
//     $UsersByUsername = $exm->getUsersByUsername($Username);
//     $row = $UsersByUsername->fetch_assoc();
//     if($row['Role_ID']=='2'){
//         header('Location: ../sign in.php');
//     }
// }
// else{
//     header('Location: ../index.php');
// }
// if(!isset($_SESSION['Username'])){
//    header('Location: ../sign in.php');
// }
// $totalUsers = $exm->getAllUsers();
$TotalContact = $exm->getContact();

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
  
    <meta charset="utf-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link href ="./../assetsCSS/bootstrap.min.css" rel=" stylesheet">
    <link href ="./../assets/CSS/bootstrap.css" rel=" stylesheet" />
    <link href="./../assets/CSS/animated.css" rel="stylesheet" >
    <link href = "./CSS/quiz_admin_panel.css" rel = "Stylesheet" type = "text/css"/>
    <link href = "./CSS/side_panel.css" rel = "Stylesheet" type = "text/css"/>
    <link href = "./CSS/navbar.css" rel = "Stylesheet" type = "text/css"/>
    <link href = "./CSS/sidebar.css" rel = "Stylesheet" type = "text/css"/>
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  
    
    <!-- <link href ="./../CSS/bootstrap - Copy.css" rel=" stylesheet" /> -->

    <!-- Bootstrap -->
    <link href="./../assets/img/Graduation Cap_48px.png" rel="icon" type="image/png" >
    <link href="./../assets/CSS/font-awesome.css" rel="stylesheet" >
    <link href="./../assets/CSS/font-awesome.min.css" rel="stylesheet" >
  
    <script src = "./js/AdminOnlineQuiz.js"></script>
    <script src="./js/AjaxSearch.js"></script>
    <script src = "./js/bootstrap3-typeahead.min.js"></script>
    <script src="./../assets/js/bootstrap.bundle.min.js"></script>
</head>
<body >
<nav class="navbar navbar-expand-lg navbar-dark bg-primary top-navbar">

<div class="container-fluid">

<a class="navbar-brand d-flex align-items-center" href="index.php">

<img src="../img/Graduation Cap_52px.png"
     width="32"
     class="me-2">

<span>Online Quiz</span>

</a>

<button class="navbar-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#topNavbar">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="topNavbar">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link active" href="index.php">
<i class="fa-solid fa-house me-1"></i>
Home
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="About.php">
<i class="fa-solid fa-circle-info me-1"></i>
About
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../index.php">
<i class="fa-solid fa-list me-1"></i>
View Quizzes
</a>
</li>

</ul>

<ul class="navbar-nav ms-auto">

...
Language dropdown

...

User dropdown

</ul>

</div>

</div>

</nav>