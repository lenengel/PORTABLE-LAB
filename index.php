<?php
include("include_LAB/config.php");
include("include_LAB/one_funcs.php");
include("include_LAB/db_funcs.php");
include("include_LAB/auth.php");

global $theme;

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
