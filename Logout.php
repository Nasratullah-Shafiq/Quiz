<?php 
ob_start();
session_start();
header('Location: sign_in.php');
session_destroy();

?>