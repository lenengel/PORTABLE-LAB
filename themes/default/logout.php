<?php
include("include_LAB/config.php");
global $theme;
session_start();
session_destroy();

$hostname = $_SERVER['HTTP_HOST'];
$path = dirname($_SERVER['PHP_SELF']);

header('Location: http://'.$hostname."/one/themes/".$theme."/login.php");
?>
