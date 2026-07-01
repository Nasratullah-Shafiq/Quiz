<?php
$timeout = 900; // 15 minutes

if (isset($_SESSION['LAST_ACTIVITY']) &&
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {

    session_unset();
    session_destroy();

    header("Location: ../Logout.php?reason=timeout");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); 
?>