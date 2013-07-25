<?php
global $theme, $DISPLAY_ERRORS;

if($DISPLAY_ERRORS)
{
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
}

include("include/config.php");
include("include/one_funcs.php");
include("include/db_funcs.php");
include("include/auth.php");

if($_SESSION['user'] == "oneadmin")
{
    include("themes/".$theme."/header_admin.php");
}
else
{
    include("themes/".$theme."/header_user.php");
}
?>
<?php if (isset($_POST['starten'])) { 
    shell_exec('../utils/websockify --daemon --idle-timeout=30 --web ./ '.$_POST['webPort'].' localhost:'.$_POST['vncPort']);
    echo "<script> window.open(\"http://10.0.0.10:".$_POST['webPort']."/vnc_auto.html\",\"new_window1\",\"toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600\");</script>";
}
?>
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="7"><h4>Laufende VM's:</h4></td></tr>
<?php
one_show_vm();
?>
</table>

<?php
include("themes/".$theme."/footer.php");
?>
