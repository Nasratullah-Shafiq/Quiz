<?php
ob_start();
session_start();
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');
include_once($filepath.'/Format.php');
include_once($filepath.'/Users.php');
include_once($filepath.'/Exam.php');
spl_autoload_register(function($class){
include_once "_Partial Components/".$class.".php";
});
$db = new Database();
$fm = new Format();
$usr = new Users();
$exm = new Exam();


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

    <link href ="./../CSS/bootstrap.min.css" rel=" stylesheet">
    <link href ="./../CSS/bootstrap.css" rel=" stylesheet" />
    <link href="./../CSS/animated.css" rel="stylesheet" >
    <link href = "./CSS/Quiz_Admin_Panel.css" rel = "Stylesheet" type = "text/css"/>
    <link href = "./../CSS/MyCarousel.css" rel = "Stylesheet" type = "text/css"/>
    
    <!-- <link href ="./../CSS/bootstrap - Copy.css" rel=" stylesheet" /> -->

    <!-- Bootstrap -->
    <link href="./../img/Graduation Cap_48px.png" rel="icon" type="image/png" >
    <link href="./../CSS/font-awesome.css" rel="stylesheet" >
    <link href="./../CSS/font-awesome.min.css" rel="stylesheet" >
    <link href="./../CSS/animated.css" rel="stylesheet" >
  
    <script src = "./js/AdminOnlineQuiz.js"></script>
    <script src="./js/AjaxSearch.js"></script>
    <script src = "./js/bootstrap3-typeahead.min.js"></script>
</head>
<body >
    <nav class="navbar navbar-inverse navbar-static-top" style = "background-color: rgb(0,112,192); border: none;">
      <div class="container-fluid" style = "margin-left: 1%; margin-right: 1%;">
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" id="btn-top-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
          <div class = "col-xs-3" id = "img-cup"><img src="../img/Graduation Cap_52px.png" alt="Logo" width="30px"></div>
          <div class = "col-xs-9" id = "div-quiz">Online Quiz</div> 
          </a>
           
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav" id="top-navbar">
            <li class="actie"><a href="index.php"><i class="fa fa-home"></i> Home </a></li>
            <li><a href="About.php" id="c"><i class="fa fa-info"></i> About </a></li>
            <li><a href="../index.php"><i class="fa fa-list"></i> View Quizes</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right" id = "top-navbar">
              <li class="dropdown dropdown-user">
                  <a href="javascrip:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                      <span class="username"> Language </span>
                      <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu" id="drop-down-language">
                      <li >
                          <a href="index.php" style="color: #fff;">
                              English </a>
                      </li>
                      <li class="divider"> </li>
                      <li>
                          <a href="Dari/index.php" style="color: #fff;">
                              Dari  </a>
                      </li>
                  </ul>
              </li>
          <?php
            if(!isset($_SESSION['Username'])){?>
            <li><a href="../sign in.php"><img alt="" class="img-circle" width="20px;" height = "20px" src="../img/placeholder-user.png" /> sign in </a></li>
                <?php }?>
            <li class="dropdown">
             
            <?php if(isset($_SESSION['Username'])){ 
                $Username = $_SESSION['Username'];
                $UsersByUsername = $exm->getUsersByUsername($Username);
                $row = $UsersByUsername->fetch_assoc();
                $profile_img = $row['Image'];
            ?>

            <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <?php echo "<img alt='' class='img-circle' width='30px;' height = '30px' src='../img/_ProfilePicture/$profile_img ' style = 'margin-top: -5px; margin-bottom: -5px;' />"; ?>
                        <span class="username username-hide-on-mobile"> 
                        <?php echo $_SESSION['Username']; ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default" id="dropdown-profile">
                        <li >
                            <a id = "dropdown-profile-admin" href="../Profile.php">
                            <i class="fa fa-user" ></i> My Profile </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a id = "dropdown-profile-admin" href="Mail.php">
                            <i class="fa fa-envelope" ></i> My inbox 
                            <?php if($TotalContact>0){
                                echo '<span class="badge" style="background-color: black;">'. $TotalContact .'</span>';
                            }
                            ?>
                            </a> 
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a id = "dropdown-profile-admin" href="../Logout.php">
                            <i class="fa fa-power-off"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
                    
            <nav class="nav-admin-panel-top"> 
                <div class="Accordion-container">
                        <div class="dashbord">
                            <a href="index.php"> Dashbord  </a>
                        </div>
                        <div class="set">
                            <a href="#"> Qestions <i class="fa fa-angle-left"> </i> </a>
                        
                            <div class="content">
                                <a href="Add-Questions.php?Question" class="nav-link ">       
                                    <li class="nav-item">
                                          <!-- <i class = "fa fa-book"></i> -->  Add Questions
                                    </li>
                                </a>
                                <a href="Manage-Questions.php?Question" class="nav-link ">
                                    <li class="nav-item">
                                            Manage Questions
                                    </li>
                                </a>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#"> Subjects <i class="fa fa-angle-left"> </i> </a>
                        
                            <div class="content">
                                <a href="Add-Subject.php" class="nav-link ">       
                                    <li class="nav-item">
                                          <!-- <i class = "fa fa-book"></i> -->  Add Subject
                                    </li>
                                </a>
                                <a href="Manage-Subject.php" class="nav-link ">
                                    <li class="nav-item">
                                            Manage Subject
                                    </li>
                                </a>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#"> Faculties <i class="fa fa-angle-left"> </i> </a>
                        
                            <div class="content">
                                <a href="Add-Faculty.php" class="nav-link ">       
                                    <li class="nav-item">
                                          <!-- <i class = "fa fa-book"></i> -->  Add Faculty
                                    </li>
                                </a>
                                <a href="Manage-Faculty.php" class="nav-link ">
                                    <li class="nav-item">
                                            Manage Faculty
                                    </li>
                                </a>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#"> Teachers <i class="fa fa-angle-left"> </i> </a>
                        
                            <div class="content">
                                <a href="Add-Teacher.php" class="nav-link ">       
                                    <li class="nav-item">
                                          <!-- <i class = "fa fa-book"></i> -->  Add Teachers
                                    </li>
                                </a>
                                <a href="Manage-Teacher.php" class="nav-link ">
                                    <li class="nav-item">
                                            Manage Teachers
                                    </li>
                                </a>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#"> Users<i class="fa fa-angle-left"> </i> </a>
                        
                            <div class="content">
                                <a href="Add-Users.php?Question" class="nav-link ">       
                                    <li class="nav-item">
                                          <!-- <i class = "fa fa-book"></i> -->  Add Users
                                    </li>
                                </a>
                                <a href="Manage-Users.php" class="nav-link ">
                                    <li class="nav-item">
                                            Manage Users
                                    </li>
                                </a>
                            </div>
                        </div>
                    </div>

                </nav>
          </ul>

        </div><!--/.nav-collapse -->
      </div>
    </nav>
 <div class="jumbotron" id = "jbt" style="background-image: url('../img/IBPS-Banne.jpg'); background-size: cover;">
        <div id="details" class="animated fadeInLeft">
            <h1> QUIZ <span> ADMIN </span> PANEL</h1>
            <p class = "paragraph">Control Your Quiz Here</p>    
        </div>
    </div>

<script src = "./../js/tests/vendor/jquery.min.js"></script>
<script src = "./../js/collapse.js"></script>
<script src = "./../js/transition.js"></script>
<script src = "./../js/modal.js"></script>
<script src = "./../js/tooltip.js"></script>
<script src = "./../js/popover.js"></script>
<script src = "./../js/dropdown.js"></script>
<script src = "./../js/carousel.js"></script> 
<script src = "./../js/OnlineQuiz.js"></script>
<script src = "./js/bootstrap3-typeahead.min.js"></script> 