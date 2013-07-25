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
    include("manage_envs.php");
}
else
{
    include("themes/".$theme."/header_user.php");
    include("trainingsinfo.php");
}
include("themes/".$theme."/footer.php");
?>
