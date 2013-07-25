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
    if (has_permission("show_network")) {
        print "<tr><td colspan=\"8\"><h3>Cloud networks:</h3></td></tr>\n";
        onemc_show_vnet();
    }
?>
</table>
</td><td valign="top">
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<?php
    if (has_permission("create_network")) {
        print "<tr><td colspan=\"2\"><h3>Create network:</h3></td></tr>\n";
        onemc_create_vnet();
    }
?>
</table>
</td></tr></table>
<?php
include("themes/".$theme."/footer.php");
?>
