<?php
     global $theme;
     include("include/config.php");
     session_start();
     session_destroy();

     $hostname = $_SERVER['HTTP_HOST'];
     $path = dirname($_SERVER['PHP_SELF']);

     header('Location: http://'.$hostname."/one/themes/default/login.php");
?>
