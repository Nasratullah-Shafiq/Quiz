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

<!-- <script src="assets/tests/vendor/js/jquery.min.js"></script> -->
<!-- <script src="assets/js/bootstrap.min.js"></script> -->
<!-- <script src="assets/js/OnlineQuiz.js"></script> -->

<script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

<script>
$(function () {
    $('.mobile-nav').click(function() {
        $('.nav-left-side').toggleClass('visible');
    });
});
</script>

</head>

<body onload="timeout()">
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(0,112,192);">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="assets/img/Graduation Cap_52px.png" width="30" class="me-2">
            <?= $lang['online_quiz']; ?>
        </a>

        <!-- Mobile Button -->
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <!-- Left Menu -->
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="about.php">
                        <?= $lang['about']; ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">
                        <?= $lang['contact']; ?>
                    </a>
                </li>

                <?php if(isset($user) && $user['Role_ID'] == '1'): ?>

                <li class="nav-item">
                    <a class="nav-link" href="Administrator/index.php">
                        <?= $lang['manage_quiz']; ?>
                    </a>
                </li>

                <?php endif; ?>

            </ul>

            <!-- Right Menu -->
            <ul class="navbar-nav ms-auto">

                <!-- Language -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        <?= $lang['language']; ?> :

                        <?php
                            if ($lang_code == 'en') echo $lang['english'];
                            elseif ($lang_code == 'fa') echo $lang['dari'];
                            elseif ($lang_code == 'ps') echo $lang['pashto'];
                        ?>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="?lang=en">
                                🇺🇸 <?= $lang['english']; ?>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="?lang=fa">
                                🇦🇫 <?= $lang['dari']; ?>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="?lang=ps">
                                🇦🇫 <?= $lang['pashto']; ?>
                            </a>
                        </li>

                    </ul>

                </li>

                <!-- Login -->
                <?php if(!isset($_SESSION['Username'])): ?>

                <li class="nav-item">

                    <a class="nav-link" href="sign_in.php">

                        <img src="assets/img/placeholder-user.png"
                             width="20"
                             class="rounded-circle me-1">

                        <?= $lang['sign_in']; ?>

                    </a>

                </li>

                <?php else: ?>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        <img
                            src="assets/img/_ProfilePicture/<?= $user['Image'] ?>"
                            width="30"
                            class="rounded-circle me-1">

                        <?= $_SESSION['Username']; ?>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="Profile.php">
                                <?= $lang['my_profile']; ?>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="edit_profile.php">
                                <?= $lang['update_profile']; ?>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="quiz_history.php">
                                <?= $lang['quiz_history']; ?>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="change_pass.php">
                                <?= $lang['change_password']; ?>
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-danger" href="Logout.php">
                                <?= $lang['logout']; ?>
                            </a>
                        </li>

                    </ul>

                </li>

                <?php endif; ?>

                <!-- Exams -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        <?= $lang['exams']; ?>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="index.php">
                                <?= $lang['home']; ?>
                            </a>
                        </li>

                        <?php
                        $subjects = $exm->getSubjects();

                        if($subjects->num_rows > 0){

                            while($row = $subjects->fetch_assoc()){

                                $active = (isset($_GET['id']) && $_GET['id'] == $row['Subject_ID'])
                                    ? "active"
                                    : "";

                                echo "
                                <li>
                                    <a class='dropdown-item $active'
                                       href='exam_details.php?id={$row['Subject_ID']}'>
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