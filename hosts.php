<?php
include("include/config.php");
include("include/onemc_funcs.php");


global $theme;
include("themes/".$theme."/header.php");
?>
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<tr><td valign="top">
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<?php
    if (has_permission("show_host")) {
        print "<tr><td colspan=\"11\"><h3>Cloud hosts:</h3></td></tr>\n";
        onemc_show_host();
    }
?>
</table>
</td><td valign="top">
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<?php
    if (has_permission("create_host")) {
        print "<tr><td colspan=\"2\"><h3>Create host:</h3></td></tr>\n";
        onemc_create_host();
    }
?>
</table>
</td></tr></table>
<?php
include("themes/".$theme."/footer.php");
?>
