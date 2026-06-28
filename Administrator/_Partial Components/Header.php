<?php
ob_start();
session_start();
$filepath = realpath(dirname(__FILE__));
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="index.php">

            <img src="../assets/img/Graduation Cap_52px.png"
                 width="30"
                 class="me-2">

            Online Quiz

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="About.php">
                        <i class="fa fa-info"></i>
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../index.php">
                        <i class="fa fa-list"></i>
                        View Quizzes
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto">

                <!-- Language -->

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">

                        Language

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="index.php">
                                English
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="Dari/index.php">
                                Dari
                            </a>
                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>



