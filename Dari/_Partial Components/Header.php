<?php
ob_start();
session_start();
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');
include_once($filepath.'/Format.php');
include_once($filepath.'/Users.php');
include_once($filepath.'/conn.php');
spl_autoload_register(function($class){
include_once "../_Partial Components/".$class.".php";
});
$db = new Database();
$fm = new Format();
$usr = new Users();
$exm = new Exam();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
  	<meta http-equiv="content-type" content="text/html; charset = UTF8"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link href ="../CSS/bootstrap.min.css" rel=" stylesheet" />
    <link href ="../CSS/bootstrap.css" rel=" stylesheet" />
    <link href="../CSS/animated.css" rel="stylesheet" >
    <link href = "../CSS/Online_Quiz_Style.css" rel = "Stylesheet" type = "text/css"/>

    <link href = "../CSS/MyCarousel.css" rel = "Stylesheet" type = "text/css"/>


    <!-- Bootstrap -->
    <link href="../img/Graduation Cap_48px.png" rel="icon" type="image/png" >
    <link href="../CSS/font-awesome.css" rel="stylesheet" >
    <link href="../CSS/font-awesome.min.css" rel="stylesheet" >
    <link href="../CSS/animated.css" rel="stylesheet" >
    <link href="../CSS/bootstrap.min.css" rel="stylesheet">
      
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js" type="text/javascript" ></script>
    <script src = "./js/OnlineQuiz.js"></script>

    <script src = "./js./TimeOut.js"></script>

</head>
<body onload = "timeout()" class="all-dari-content">
<script type="text/javascript">
        $('#Dari').click(function({
          $('DivDari').show();

        }));
    </script>
<nav class="navbar navbar-inverse navbar-static-top" style = "background-color: rgb(0,112,192); border: 0px;">
      <div class="container">
        <div class="navbar-header" style = "">
          <button style = "float:left"type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" id="btn-top-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a id = "navbar-brand-left-dr" style = "float: right; color: #fff;" class="navbar-brand"  href="index.php">
          <div class = "col-xs-9" style="text-align: right; padding-left: 0px; padding-top: 5px;"> امتحان آنلاین </div>
          <div class = "col-xs-3" style="padding-left: 0px;"><img src="../img/Graduation Cap_52px.png" alt="Logo" width="30px"></div>
          </a>
           
        </div>
        <div id="navbar" class="navbar-collapse collapse text-right">
          
          <ul class="nav navbar-nav" id="top-navbar">
          <?php
           if(!isset($_SESSION['Username'])){?>
          <li id= "" style="padding-top: 0px;"><a href="sign in.php"> <img alt="" class="img-circle" width="30px" height = "30px" src="../img/placeholder-user.png" style = 'margin-top: -5px; margin-bottom: -5px;' /> ورود به سیستم </a></li>
            <?php }?>
          <li class="dropdown" id= "ssh">
             
            <?php if(isset($_SESSION['Username'])){ 
                $Username = $_SESSION['Username'];
                $UsersByUsername = $exm->getUsersByUsername($Username);
                $row = $UsersByUsername->fetch_array();
                $profile_img = $row['Image'];
            ?>

            <li class="dropdown dropdown-user" style = "background-color: rgb(0,112,192); padding-top: 0px;">
                  <a href="javascript:;" class="dropdown-toggle" id = "img-user" data-toggle="dropdown" data-hover="ddown" data-close-others="tue" style = "color: #fff;">
                      <?php echo "<img alt='' class='img-circle' width='30px' height = '30px' src='../img/_ProfilePicture/$profile_img' style = 'margin-top: -5px; margin-bottom: -5px;' />"; ?>
                      <span class="username username-hide-on-mobile"> 
                      <?php echo $_SESSION['Username']; ?> </span>
                      <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu text-right" style = "background-color: rgb(0,112,192); color: #fff;"  >
                      <li>
                          <a id = "dropdown-profile-dr" href="Profile.php" style="color: #fff;">
                           بازدید پروفایل <i class="fa fa-user"></i></a>
                      </li>
                      <li class="divider li-dropdown"> </li>
                      <li class="li-dropdown">
                          <a id = "dropdown-profile-dr" href="Edit-Profile.php" style="color: #fff;">
                           تغیر دادن پروفایل <i class="fa fa-pencil"> </i></a>
                      </li>
					  <li class="divider li-dropdown"> </li>
                      <li class="li-dropdown">
                          <a id = "dropdown-profile-dr" href="QuizHistory.php" style="color: #fff;">
                           بازدید امتحانات <i class="fa fa-list"> </i></a>
                      </li>
                      <li class="divider li-dropdown"> </li>
                      <li class="li-dropdown">
                          <a id = "dropdown-profile-dr" href="Change-pass.php" style="color: #fff;">
                           تغیر نمودن رمز <i class="fa fa-pencil"> </i></a>
                      </li>
                      <li class="divider"> </li>
                      <li>
                          <a id = "dropdown-profile-dr" href="Logout.php" style="color: #fff;">
                           خاموش شود <i class="fa fa-power-off"> </i></a>
                      </li>
                  </ul>
              </li>
          <?php } ?>
            </li>
            <li class="dropdown dropdown-user" style = "background-color: rgb(0,112,192); text-align: right;">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style = "color: #fff;">
                        <span class="username"> زبان </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default"  id="drop-down-language">
                        <li >
                            <a class = "text-right"id = "ahmadsh" href="../index.php" style="color: #fff;">
                            انگلیسی </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a class = "text-right" id = "ahmadsh" href="index.php" style="color: #fff;">
                               دری </a>
                        </li>
                    </ul>
                </li>
            
            </ul>
            <ul class="nav navbar-nav navbar-right" id = "navbardr">
                <a href="index.php" class="navbar-brand" id = "navbar-brand-right-dr">
                <div class = "col-xs-9" id = "div-quiz-title-bar"> امتحان آنلاین </div>
                <div class = "col-xs-3" id = "img-cup-dr"><img src="../img/Graduation Cap_52px.png" alt="Logo" width="30px"></div>
                </a>
                  
            <li class="actie"><a id="ahmadsh" href="index.php"> صفحه اصلی <i class="fa fa-home"></i></a></li>
                <li><a href="About-Us.php" id="c"> در باره ما <i class="fa fa-info"></i></a></li>
                <li><a href="Contact-us.php"> تماس با ما <i class="fa fa-phone"></i></a></li>
                <li><a href="../Administrator/Dari/index.php"> مدیریت امتحانات <i class="fa fa-tachometer"></i></a></li>
            <li class="dropdown" id="Categories-btn">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span> امتحانات  <i class="fa fa-list-alt"></i> </a>
              <ul class="dropdown-menu">
                <?php
               
                include_once('conn.php');
      
                ?>
                <nav class="nav-top-side tr-text-right"> 
                <?php
                if(isset($_GET['id'])){ ?>
                <a  href="index.php"> صفحه اصلی <i class='fa fa-home'></i></a>

                <?php }else{ ?>
                  <a class = "active" href="index.php"> صفحه اصلی <i class='fa fa-home'></i> </a>
                 
                <?php }?>

                <?php
                $con = mysqli_connect ("localhost", "root", "");
                $db = mysqli_select_db ($con, "Quiz");

                $query = "select * from Viw_Subject where Language = 'Dari' and Status='1'";
                mysqli_set_charset($con, 'UTF8');
                $chk = mysqli_query($con,$query);

                if(isset($_SESSION['Username'])){ 
                    $Username = $_SESSION['Username'];
                    $UsersByUsername = $exm->getUsersByUsername($Username);
                    $rows = $UsersByUsername->fetch_assoc();
                }
                    
                    $alldrSubject = $exm->getDariSubjects();
                    if($rows['Status']=='1'){
                    if(mysqli_num_rows($chk)>0){
                        while($row = mysqli_fetch_array($chk)){
                        if(isset($_GET['id']) && $row['Subject_ID']==$_GET['id']){
                            $subjectID = $row['Subject_ID'];
                            $subject = $row['Subject'];
                            echo "<a class = 'active' href = 'ExamDetailsDr.php?id=".$subjectID."'> امتحان $subject  <i class='fa fa-list-alt'></i>  </a>";
                        }
                    else{
                        $subjectID = $row['Subject_ID'];
                        $subject = $row['Subject'];
                        echo "<a  href = 'ExamDetailsDr.php?id=".$subjectID."'> امتحان $subject  <i class='fa fa-list-alt'></i> </a>";
                     
                        }
                    }
                }
            }
                else{
                  echo "<center> <h3><p>مضمون وجود ندارد </p></h3> </center>";

                }

                ?>

                </nav>
              </ul>
          </li>
          
          </ul>

        </div><!--/.nav-collapse -->
      </div>
    </nav>
<body>

<script src="../js/tests/vendor/jquery.min.js"></script>
<script src="../js/collapse.js"></script>
<script src="../js/transition.js"></script>
<script src="../js/modal.js"></script>
<script src="../js/tooltip.js"></script>
<script src="../js/popover.js"></script>
<script src="../js/dropdown.js"></script>
<script src="../js/carousel.js"></script>
<script src = "./js/OnlineQuiz.js"></script>