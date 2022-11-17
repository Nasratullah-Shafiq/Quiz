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
    <!-- <link href = "./CSS/quiz_admin_panel.css" rel = "Stylesheet" type = "text/css"/> -->
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
<nav class="navbar navbar-expand-lg top-navbar">

    <div class="container-fluid">

        <!-- Left -->
        <div class="d-flex align-items-center">

            <a class="navbar-brand d-flex align-items-center" href="index.php">

                <img src="../assets/img/Graduation Cap_52px.png"
                     width="34"
                     class="me-2">

                <span class="fw-semibold">
                    Online Quiz
                </span>

            </a>

        </div>

        <!-- Mobile Button -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#topNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="topNavbar">

            <!-- Left Menu -->
            <ul class="navbar-nav ms-4">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="fa-solid fa-house me-2"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="About.php">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../index.php">
                        <i class="fa-solid fa-list-check me-2"></i>
                        View Quizzes
                    </a>
                </li>

            </ul>

            <!-- Right Menu -->
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Search -->
                <li class="nav-item me-3">
                    <div class="position-relative">
                        <input class="form-control search-box"
                               type="search"
                               placeholder="Search...">
                        <i class="fa-solid fa-search search-icon"></i>
                    </div>
                </li>

                <!-- Language -->
                <li class="nav-item dropdown me-2">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        <i class="fa-solid fa-language me-1"></i>
                        Language

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        <li>
                            <a class="dropdown-item" href="index.php">
                                🇺🇸 English
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="Dari/index.php">
                                🇦🇫 Dari
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="Pashto/index.php">
                                🇦🇫 Pashto
                            </a>
                        </li>


                    </ul>

                </li>

                <!-- ========================= -->
                <!-- AUTH SECTION (FINAL) -->
                <!-- ========================= -->

                <?php if (!isset($_SESSION['Username'])) { ?>

                    <!-- SIGN IN -->
                    <li class="nav-item ms-2">

                        <a class="nav-link d-flex align-items-center" href="../sign in.php">

                            <img src="../assets/img/placeholder-user.png"
                                 width="20"
                                 height="20"
                                 class="rounded-circle me-2">

                            Sign In

                        </a>

                    </li>

                <?php } else {

                    $Username = $_SESSION['Username'];

                    $UsersByUsername = $exm->getUsersByUsername($Username);
                    $row = $UsersByUsername->fetch_assoc();

                    $profile_img = $row['Image'];

                ?>

                    <!-- USER DROPDOWN -->
                    <li class="nav-item dropdown ms-2">

                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            <!-- PROFILE IMAGE -->
                            <img src="../assets/img/_ProfilePicture/<?php echo $profile_img; ?>"
                                 width="32"
                                 height="32"
                                 class="rounded-circle me-2"
                                 style="object-fit:cover;">
                                 <span class="online-dot"></span>

                            <!-- USERNAME -->
                            <span>
                                <?php echo $_SESSION['Username']; ?>
                            </span>

                        </a>

                        <!-- DROPDOWN -->
                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li>
                                <a class="dropdown-item" href="../Profile.php">
                                    <i class="fa fa-user me-2"></i>
                                    My Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item" href="Mail.php">
                                    <i class="fa fa-envelope me-2"></i>
                                    My Inbox

                                    <?php if ($TotalContact > 0) { ?>
                                        <span class="badge bg-dark ms-2">
                                            <?php echo $TotalContact; ?>
                                        </span>
                                    <?php } ?>
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-danger" href="../Logout.php">
                                    <i class="fa fa-power-off me-2"></i>
                                    Log Out
                                </a>
                            </li>

                        </ul>

                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>