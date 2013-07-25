<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PORTABLE LAB - Anmeldung</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
    <div id="header-wrapper" class="container">
        <div id="header" class="container">
            <div id="logo">
                <img src="images/logo.jpg" alt="" />
            </div>
            <div id="menu">
            </div>
        </div>
    </div>
    <div id="page" class="container">
        <div id="content">
            <div class="title">
                <?php
                include("../../include_LAB/xml_funcs.php");
                include("../../include_LAB/config.php");

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    session_start();
                    $username = $_POST['username'];
                    $passwort = $_POST['passwort'];
                    $hostname = $_SERVER['HTTP_HOST'];
                    $path = dirname($_SERVER['PHP_SELF']);
                    $status = rpc2_request("one.hostpool.info", array($username.":".$passwort));

                    if (isset($status['failed'])) {
                        echo "<div class=\"error\">Anmeldung fehlgeschlagen!</div>";
                    }
                    else {
                        $_SESSION['logon'] = true;
                        $_SESSION['auth'] = $username.":".$passwort;
                        $_SESSION['user'] = $username;
                        // Weiterleitung zur geschützten Startseite
                        if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
                            if (php_sapi_name() == 'cgi') {
                                header('Status: 303 See Other');
                            }
                            else {
                                header('HTTP/1.1 303 See Other');
                            }
                        }
                        header('Location: http://'.$hostname.'/one/index.php');
                        exit;
                    }
                }
                ?>
                <table width="274" border="0" cellpadding="0" cellspacing="0">
                <tr>
                        <td width="15" height="50"></td>
                        <td height="50"><h1>Login</h1></td>
                </tr>
                <tr>
                        <td width="15" height="130"></td>
                        <td width="242" height="130" align="left" valign="top" class="text">
                         <form action="login.php" method="post">
                        Benutzername:<br>
                        <label>
                                <input type="text" name="username" />
                        </label><br><br>
                        Passwort:<br>
                        <label>
                                <input type="password" name="passwort" />
                        </label><br><br>
                        <input type="submit" value="login" />
                        </form>
                        </td>
                </tr>
                <tr>
                        <td colspan="2" height="15"></td>
                </tr>
                </table> 
            </div>
        </div>
    </div>
</div>
</body>
</html>