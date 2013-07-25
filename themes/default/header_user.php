<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PORTABLE LAB</title>
<link href="themes/default/css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script LANGUAGE="JavaScript">
function popUp(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
}
</script>
</head>
<body>
<div id="wrapper">
    <div id="header-wrapper" class="container">
        <div id="header" class="container">
            <div id="logo">
                <img src="themes/default/images/logo.jpg" alt="" />
            </div>
            <div id="menu">
                <ul>
                    <?php
                    if (basename($_SERVER['PHP_SELF']) == "index.php")
                        print "<li><a href=\"index.php\" class=\"vms selected\">&Uuml;bungsinformationen</a></li>";
                    else
                        print "<li><a href=\"index.php\" class=\"vms\">&Uuml;bungsinformationen</a></li>";
                    if (basename($_SERVER['PHP_SELF']) == "runningvm.php")
                        print "<li><a href=\"runningvm.php\" class=\"vms selected\">&Uuml;bung durchf&uuml;hren</a></li>";
                    else
                        print "<li><a href=\"runningvm.php\" class=\"vms\">&Uuml;bung durchf&uuml;hren</a></li>";
                    ?>
                </ul>
            </div>
        </div>
    </div>
<div id="info" class="container">
    <div id="logininfo">
    Angemeldet als <? echo $_SESSION['user'];?> | <a href="themes/<?  global $theme; include("include_LAB/config.php"); echo $theme; ?>/logout.php">abmelden</a> 
    </div>
</div>
    <div id="page" class="container">
        <div id="content">
            <div class="title">