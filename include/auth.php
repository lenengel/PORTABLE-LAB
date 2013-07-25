
<?php
    
    global $theme;
    include("include/config.php");
     session_start();

     $hostname = $_SERVER['HTTP_HOST'];
     $path = dirname($_SERVER['PHP_SELF']);

     if (!isset($_SESSION['logon']) || !$_SESSION['logon']) {
      header('Location: http://'.$hostname."/one/themes/".$theme."/login.php");
      exit;
      }

/*
if (isset($_POST['submit']) && $_POST['submit'] == "login" &&
                isset($_POST['username']) && isset($_POST['userkey'])) {
    $oneadminuser = $_POST['username'];
    $oneadminauth = $_POST['username'].":".$_POST['userkey'];
}

if (isset($oneadminauth)) {
    $hostpool_info = rpc2_request("one.hostpool.info", array($oneadminauth));
    if (isset($hostpool_info['failed'])) {
        auth_dialog();
        exit;
    }
} else {
    auth_dialog();
    exit;
}

session_write_close();
*/
?>
