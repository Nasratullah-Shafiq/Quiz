<?php
session_start();

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang_code = $_SESSION['lang'] ?? 'en';

$lang_path = __DIR__ . "/../lang/$lang_code.php";

if (!file_exists($lang_path)) {
    $lang_code = 'en';
    $lang_path = __DIR__ . "/../lang/en.php";
}

include $lang_path;

$direction = ($lang_code === 'fa' || $lang_code === 'ps') ? 'rtl' : 'ltr';