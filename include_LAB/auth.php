<?php
include("config.php");
global $theme;

session_start();
$hostname = $_SERVER['HTTP_HOST'];
$path = dirname($_SERVER['PHP_SELF']);

if (!isset($_SESSION['logon']) || !$_SESSION['logon']) {
    header('Location: http://'.$hostname."/one/themes/".$theme."/login.php");
    exit;
}
?>
