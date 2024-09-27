<?php
ob_start();
session_start();
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');
include_once($filepath.'/conn.php');
include_once($filepath.'/Format.php');
include_once($filepath.'/Exam.php');
include_once($filepath.'/Users.php');
spl_autoload_register(function($class){
include_once "_Partial Components/".$class.".php";
});
$db = new Database();
$fm = new Format();
$usr = new Users();
$exm = new Exam();

// if(!isset($_SESSION['Username'])){
//     header('Location: sign in.php');
// }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
  
    <meta charset="utf-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link href ="./CSS/bootstrap.min.css" rel=" stylesheet">
    <link href ="./CSS/bootstrap.css" rel=" stylesheet" />
    <link href="./CSS/animated.css" rel="stylesheet" >
    <link href = "./CSS/Online_Quiz_Style.css" rel = "Stylesheet" type = "text/css"/>
    <link href = "./CSS/MyCarousel.css" rel = "Stylesheet" type = "text/css"/>
    <!-- <link href ="./CSS/bootstrap-theme.css" rel=" stylesheet"> -->
    <!-- <link href ="./CSS/bootstrap-theme.min.css" rel=" stylesheet"> -->

    <!-- Bootstrap -->
    <link href="img/Graduation Cap_48px.png" rel="icon" type="image/png" >
    <link href="CSS/font-awesome.css" rel="stylesheet" >
    <link href="CSS/font-awesome.min.css" rel="stylesheet" >
    <link href="CSS/animated.css" rel="stylesheet" >
    <!-- <link href="./CSS/bootstrap.min.css" rel="stylesheet"> -->
      
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="js/jquery.js" type="text/javascript" ></script>
    <script src="./jquery.js" type="text/javascript" ></script>
    <script src = "js/OnlineQuiz.js"></script>
    <script src = "jquery.min.js"></script>
   

      <script type="text/javascript">
      $(function () {
        $('.mobile-nav').click(function() {
          $('.nav-left-side').toggleClass('visible'); 
        })
      })
    </script>

</head>
<body onload = "timeout()">
    <nav class="navbar navbar-inverse navbar-static-top" style = "background-color: rgb(0,112,192); border: none;">
      <div class="container">
        <div class="navbar-header" style = "">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" id="btn-top-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
          <div class = "col-xs-3" id = "img-cup"><img src="img/Graduation Cap_52px.png" alt="Logo" width="30px"></div>
          <div class = "col-xs-9" id = "div-quiz">Online Quiz</div> 
          </a>
           
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav" id="top-navbar">
            <li><a href="About.php" id="c"><i class="fa fa-info"></i> About </a></li>
            <li><a href="Contact-us.php"><i class="fa fa-phone"></i> Contact Us</a></li>
            <?php if(isset($_SESSION['Username'])){
            $Username = $_SESSION['Username'];
            $UsersByUsername = $exm->getUsersByUsername($Username);
            $row = $UsersByUsername->fetch_assoc();
            if($row['Role_ID']=='1'){?> 
            <li><a href="Administrator/index.php"><i class="fa fa-list"></i> Manage Quizes</a></li>
            <?php }}?>
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
            <li><a href="sign in.php"><img alt="" class="img-circle" width="20px;" height = "20px" src="img/placeholder-user.png" /> sign in </a></li>
            	<?php }?>
            <li class="dropdown">
             
            <?php if(isset($_SESSION['Username'])){ 
                $Username = $_SESSION['Username'];
                $UsersByUsername = $exm->getUsersByUsername($Username);
                $row = $UsersByUsername->fetch_assoc();
                $profile_img = $row['Image'];
            ?>

            <li class="dropdown dropdown-user" id = "top-navbar">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    
                    <?php echo "<img alt='' class='img-circle' width='30px;' height = '30px' src='img/_ProfilePicture/$profile_img ' style = 'margin-top: -5px; margin-bottom: -5px;' />"; ?>
                      	<span class="username username-hide-on-mobile"> 
                      	<?php echo $_SESSION['Username']; ?> </span>
                      	<i class="fa fa-angle-down"></i>
                  	</a>
                  	<ul class="dropdown-menu dropdown-menu-default" id="dropdown-profile-en">
                      	<li >
                        	<a id = "dropdown-profile" href="Profile.php" style="color: #fff;">
                          	<i class="fa fa-user" ></i> My Profile </a>
                      	</li>
                           <li class="divider li-dropdown"> </li>
                        <li class="li-dropdown">
                            <a id = "dropdown-profile-en" href="EditProfile.php" style="color: #fff;">
                            <i class="fa fa-lock" ></i> Update Profile </a>
                        </li>
                        <li class="divider li-dropdown"> </li>
                        <li class="li-dropdown">
                        	<a id = "dropdown-profile-en" href="QuizHistory.php" style="color: #fff;"> 
                            <i class="fa fa-pencil" ></i> View Quiz History </a>
                        </li>
                        <li class="divider"> </li>
                        <li class="li-dropdown">
                            <a id = "dropdown-profle-en" href="Change-Pass.php" style="color: #fff;">
                            <i class="fa fa-power-off"></i> Change Password </a>
                        </li> 
                        <li class="divider li-dropdown"> </li>

                        <li>
                            <a id = "dropdown-profle-en" href="Logout.php" style="color: #fff;">
                            <i class="fa fa-power-off"></i> Log Out </a>
                        </li>
                        
                  	</ul>
              	</li>
          	<?php } ?>

          	<li class="dropdown" id="Categories-btn">
              	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt"></i> Exams <span class="caret"></span></a>
              	<ul class="dropdown-menu">
                	<?php
               
                	include_once('conn.php');
      
                	?>
                <nav class="nav-top-side"> 
                <?php
                    if(isset($_GET['id'])){ ?>
                    <a  href="index.php"> <i class='fa fa-home'></i> Home</a>

                    <?php }
                    else{ ?>
                      <a class = "active" href="index.php"> <i class='fa fa-home'></i> Home</a>
                     
                    <?php }?>
                    
                    <?php 
                    if(isset($_SESSION['Username'])){ 
                        $Username = $_SESSION['Username'];
                        $UsersByUsername = $exm->getUsersByUsername($Username);
                        $rows = $UsersByUsername->fetch_assoc();
                    }
                        $allSubject = $exm->getSubjects();
                        if($rows['Status']=='1'){
                            if($allSubject->num_rows>0){
                        
                            while($row = $allSubject->fetch_assoc()){
                                if(isset($_GET['id']) && $row['Subject_ID']==$_GET['id']){
                                    $SubjectID = $row['Subject_ID'];
                                    $subject = $row['Subject'];
                                    echo "<a class = 'active' href = 'ExamDetails.php?id=".$SubjectID."'><i class='fa fa-list'></i> $subject Quiz </a>";
                                }
                                else{
                                    $SubjectID = $row['Subject_ID'];
                                    $subject = $row['Subject'];
                                    echo "<a  href = 'ExamDetails.php?id=".$SubjectID."'><i class='fa fa-list'></i> $subject Quiz </a>";
                                }
                            }
                        }
                    }
                        else{
                            echo "<center> <h3><p> No Subjects Yet </p></h3> </center>";
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
<!-- <script src = "./jquery.min.js"></script>
<script src = "./../js/collapse.js"></script>
<script src = "./../js/transition.js"></script>
<script src = "./../js/modal.js"></script>
<script src = "./../js/tooltip.js"></script>
<script src = "./../js/popover.js"></script>
<script src = "./../js/dropdown.js"></script>
<script src = "./../js/carousel.js"></script> 
<script src = "./js/OnlineQuiz.js"></script> 
<script src = "./js/jquery.js"></script>
<script src = "./js/bootstrap.min.js"></script> -->