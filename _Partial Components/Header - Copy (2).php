<?php
ob_start();
session_start();

$filepath = realpath(dirname(__FILE__));

require_once($filepath.'/Database.php');
require_once($filepath.'/lang_loader.php');
require_once($filepath.'/conn.php');
require_once($filepath.'/Format.php');
require_once($filepath.'/Method.php');
require_once($filepath.'/CRUD.php');

spl_autoload_register(function($class){
    include_once "_Partial Components/".$class.".php";
});

$db  = new Database();
$fm  = new Format();
$usr = new CRUD();
$exm = new Method();

/* -------------------------
   LANGUAGE + RTL SETUP
--------------------------*/
$lang_code = $lang_code ?? 'en';
$isRTL = in_array($lang_code, ['fa', 'ps']);

/* -------------------------
   CACHE USER ONCE
--------------------------*/
$user = null;
if(isset($_SESSION['Username'])){
    $user = $exm->getUsersByUsername($_SESSION['Username'])->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="<?= $lang_code ?>" dir="<?= $isRTL ? 'rtl' : 'ltr' ?>">
<head>

<title>Online Quiz System</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="icon" type="image/png" href="./assets/img/Graduation Cap_48px.png">

<!-- ================= CSS ================= -->

<?php if($isRTL): ?>
    <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="assets/CSS/rtl.css">
<?php else: ?>
    <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">
<?php endif; ?>

<link rel="stylesheet" href="assets/CSS/font-awesome.min.css">
<link rel="stylesheet" href="assets/CSS/animated.css">
<link rel="stylesheet" href="assets/CSS/online_quiz_style.css">
<link rel="stylesheet" href="assets/CSS/MyCarousel.css">

<!-- ================= JS ORDER (IMPORTANT) ================= -->

<script src="assets/tests/vendor/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/OnlineQuiz.js"></script>

<script>
$(function () {
    $('.mobile-nav').click(function() {
        $('.nav-left-side').toggleClass('visible');
    });
});
</script>

</head>

<body onload="timeout()">
<nav
        class="navbar navbar-expand-lg navbar-dark bg-dark"
        aria-label="Eighth navbar example"
      >
        <div class="container">
          <a class="navbar-brand" href="#">Container</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarsExample07"
            aria-controls="navbarsExample07"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Dropdown</a
                >
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
            </ul>
            <form role="search">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
            </form>
          </div>
        </div>
      </nav>

<nav class="navbar navbar-inverse navbar-static-top" style="background-color: rgb(0,112,192); border: none;">
<div class="container">

<!-- ================= BRAND ================= -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand" href="index.php">
        <img src="assets/img/Graduation Cap_52px.png" width="30">
        <?= $lang['online_quiz']; ?>
    </a>
</div>

<!-- ================= MENU ================= -->
<div id="navbar" class="navbar-collapse collapse">

<ul class="nav navbar-nav">

    <li><a href="about.php"><?= $lang['about']; ?></a></li>
    <li><a href="contact_us.php"><?= $lang['contact']; ?></a></li>

    <!-- ADMIN -->
    <?php if(isset($user) && $user['Role_ID'] == '1'): ?>
        <li><a href="Administrator/index.php"><?= $lang['manage_quiz']; ?></a></li>
    <?php endif; ?>

</ul>

<!-- ================= RIGHT SIDE ================= -->
<ul class="nav navbar-nav navbar-right">

<!-- LANGUAGE -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown">
        <?= $lang['language']; ?> :
        <?php
            if ($lang_code == 'en') echo $lang['english'];
            elseif ($lang_code == 'fa') echo $lang['dari'];
            elseif ($lang_code == 'ps') echo $lang['pashto'];
        ?>
        <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li><a href="?lang=en">🇺🇸 <?= $lang['english']; ?></a></li>
        <li><a href="?lang=fa">🇦🇫 <?= $lang['dari']; ?></a></li>
        <li><a href="?lang=ps">🇦🇫 <?= $lang['pashto']; ?></a></li>
    </ul>
</li>

<!-- LOGIN / USER -->
<?php if(!isset($_SESSION['Username'])): ?>
    <li>
        <a href="sign_in.php">
            <img src="assets/img/placeholder-user.png" width="20" class="img-circle">
            <?= $lang['sign_in']; ?>
        </a>
    </li>
<?php else: ?>

<li class="dropdown">

    <a class="dropdown-toggle" data-toggle="dropdown">

        <img class="img-circle" width="30"
            src="assets/img/_ProfilePicture/<?= $user['Image'] ?>">

        <?= $_SESSION['Username']; ?>
        <span class="caret"></span>

    </a>

    <ul class="dropdown-menu">

        <li><a href="Profile.php"><?= $lang['my_profile']; ?></a></li>
        <li><a href="edit_profile.php"><?= $lang['update_profile']; ?></a></li>
        <li><a href="quiz_history.php"><?= $lang['quiz_history']; ?></a></li>
        <li><a href="change_pass.php"><?= $lang['change_password']; ?></a></li>
        <li><a href="Logout.php"><?= $lang['logout']; ?></a></li>

    </ul>

</li>

<?php endif; ?>

<!-- EXAMS (NO DB QUERY IN HEADER LOOP) -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown">
        <?= $lang['exams']; ?> <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">

        <li><a href="index.php"><?= $lang['home']; ?></a></li>

        <?php
        $subjects = $exm->getSubjects();

        if($subjects->num_rows > 0){
            while($row = $subjects->fetch_assoc()){
                $active = (isset($_GET['id']) && $_GET['id'] == $row['Subject_ID']) ? "active" : "";

                echo "<li>
                        <a class='$active' href='exam_details.php?id={$row['Subject_ID']}'>
                            {$row['Subject']} Quiz
                        </a>
                      </li>";
            }
        }
        ?>

    </ul>
</li>

</ul>

</div>
</div>
</nav>