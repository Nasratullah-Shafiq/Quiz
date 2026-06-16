 <?php
ob_start();
// session_start();
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');
include_once($filepath.'/lang_loader.php');
include_once($filepath.'/conn.php');
include_once($filepath.'/Format.php');
include_once($filepath.'/Method.php');
include_once($filepath.'/CRUD.php');
spl_autoload_register(function($class){
include_once "_Partial Components/".$class.".php";
});
$db = new Database();
$fm = new Format();
$usr = new CRUD();
$exm = new Method();

// if(!isset($_SESSION['Username'])){
//     header('Location: sign in.php');
// }
?>
<!DOCTYPE html>
<html lang="<?= $lang_code ?>" dir="<?= $direction ?>">
<head>
	<title>Online Quiz System</title>
  
    <meta charset="utf-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" type="image/png" href="./assets/img/Graduation Cap_48px.png">

    <!-- CSS -->
    <link href="assets/CSS/bootstrap.min.css" rel="stylesheet">
    <link href="assets/CSS/font-awesome.min.css" rel="stylesheet">
    <link href="assets/CSS/animated.css" rel="stylesheet">
    <link href="assets/CSS/online_quiz_style.css" rel="stylesheet">
    <link href="assets/CSS/MyCarousel.css" rel="stylesheet">

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/OnlineQuiz.js"></script>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/tests/vendor/js/jquery.min.js"></script>
   

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
          <div class = "col-xs-3" id = "img-cup"><img src="assets/img/Graduation Cap_52px.png" alt="Logo" width="30px"></div>
          <div class="col-xs-9" id="div-quiz">
    <?= $lang['online_quiz']; ?>
</div> 
          </a>
           
        </div>
        <div id="navbar" class="navbar-collapse collapse">

  <ul class="nav navbar-nav" id="top-navbar">

    <li>
      <a href="about.php" id="c">
        <i class="fa fa-info"></i> <?= $lang['about']; ?>
      </a>
    </li>

    <li>
      <a href="contact_us.php">
        <i class="fa fa-phone"></i> <?= $lang['contact']; ?>
      </a>
    </li>

    <?php if(isset($_SESSION['Username'])) {
        $Username = $_SESSION['Username'];
        $UsersByUsername = $exm->getUsersByUsername($Username);
        $row = $UsersByUsername->fetch_assoc();

        if($row['Role_ID']=='1'){ ?>
          <li>
            <a href="Administrator/index.php">
              <i class="fa fa-list"></i> <?= $lang['manage_quiz']; ?>
            </a>
          </li>
    <?php }} ?>

  </ul>

  <ul class="nav navbar-nav navbar-right" id="top-navbar">

    <!-- LANGUAGE LABEL -->
    <!-- LANGUAGE DROPDOWN -->
<li class="dropdown dropdown-user">

  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

    <span class="username">
      <?= $lang['language']; ?> :

      <?php
        if ($lang_code == 'en') echo $lang['english'];
        elseif ($lang_code == 'fa') echo $lang['dari'];
        elseif ($lang_code == 'ps') echo $lang['pashto'];
      ?>
    </span>

    <i class="fa fa-angle-down"></i>

  </a>

  <ul class="dropdown-menu" id="drop-down-language">

    <li>
      <a href="?lang=en" style="color:#fff;">
        🇺🇸 <?= $lang['english']; ?>
      </a>
    </li>

    <li class="divider"></li>

    <li>
      <a href="?lang=fa" style="color:#fff;">
        🇦🇫 <?= $lang['dari']; ?>
      </a>
    </li>

    <li class="divider"></li>

    <li>
      <a href="?lang=ps" style="color:#fff;">
        🇦🇫 <?= $lang['pashto']; ?>
      </a>
    </li>

  </ul>

</li>

    <!-- SIGN IN -->
    <?php if(!isset($_SESSION['Username'])) { ?>
      <li>
        <a href="sign_in.php">
          <img class="img-circle" width="20" height="20" src="assets/img/placeholder-user.png" />
          <?= $lang['sign_in']; ?>
        </a>
      </li>
    <?php } ?>

    <!-- USER DROPDOWN -->
    <?php if(isset($_SESSION['Username'])) {

        $Username = $_SESSION['Username'];
        $UsersByUsername = $exm->getUsersByUsername($Username);
        $row = $UsersByUsername->fetch_assoc();
        $profile_img = $row['Image'];
    ?>

    <li class="dropdown dropdown-user" id="top-navbar">

      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

        <?php echo "<img class='img-circle' width='30' height='30' src='assets/img/_ProfilePicture/$profile_img' />"; ?>

        <span class="username">
          <?php echo $_SESSION['Username']; ?>
        </span>

        <i class="fa fa-angle-down"></i>

      </a>

      <ul class="dropdown-menu dropdown-menu-default">

        <li>
          <a href="Profile.php">
            <i class="fa fa-user"></i> <?= $lang['my_profile']; ?>
          </a>
        </li>

        <li class="divider"></li>

        <li>
          <a href="EditProfile.php">
            <i class="fa fa-lock"></i> <?= $lang['update_profile']; ?>
          </a>
        </li>

        <li class="divider"></li>

        <li>
          <a href="QuizHistory.php">
            <i class="fa fa-pencil"></i> <?= $lang['quiz_history']; ?>
          </a>
        </li>

        <li class="divider"></li>

        <li>
          <a href="Change-Pass.php">
            <i class="fa fa-power-off"></i> <?= $lang['change_password']; ?>
          </a>
        </li>

        <li class="divider"></li>

        <li>
          <a href="Logout.php">
            <i class="fa fa-power-off"></i> <?= $lang['logout']; ?>
          </a>
        </li>

      </ul>

    </li>

    <?php } ?>

    <!-- EXAMS -->
    <li class="dropdown" id="Categories-btn">

      <a href="#" class="dropdown-toggle" data-toggle="dropdown">

        <i class="fa fa-list-alt"></i> <?= $lang['exams']; ?>
        <span class="caret"></span>

      </a>

      <ul class="dropdown-menu">

        <?php include_once('conn.php'); ?>

        <nav class="nav-top-side">

        <?php if(isset($_GET['id'])) { ?>
          <a href="index.php"><i class='fa fa-home'></i> <?= $lang['home']; ?></a>
        <?php } else { ?>
          <a class="active" href="index.php"><i class='fa fa-home'></i> <?= $lang['home']; ?></a>
        <?php } ?>

        <?php
        if(isset($_SESSION['Username'])) {
            $Username = $_SESSION['Username'];
            $UsersByUsername = $exm->getUsersByUsername($Username);
            $rows = $UsersByUsername->fetch_assoc();
        }

        $allSubject = $exm->getSubjects();

        if($rows['Status']=='1'){

            if($allSubject->num_rows>0){

                while($row = $allSubject->fetch_assoc()){

                    $SubjectID = $row['Subject_ID'];
                    $subject = $row['Subject'];

                    $active = (isset($_GET['id']) && $_GET['id'] == $SubjectID) ? "active" : "";

                    echo "<a class='$active' href='exam_details.php?id=$SubjectID'>
                            <i class='fa fa-list'></i> $subject Quiz
                          </a>";
                }
            }

        } else {
            echo "<center><h3>No Subjects Yet</h3></center>";
        }
        ?>

        </nav>

      </ul>

    </li>

  </ul>

</div>
      </div>
    </nav>

