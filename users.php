<?php
include("include/config.php");
include("include/onemc_funcs.php");

global $theme;
include("themes/".$theme."/header.php");

if (!has_permission("edit_user")) {
	print "You are not authorized.\n";
	include("themes/".$theme."/footer.php");
	exit;
}

?>
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<tr><td valign="top">
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="5"><h3>Cloud users:</h3></td></tr>
<?php
	onemc_show_user();
?>
</table>
</td><td valign="top">
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2"><h3>Create user:</h3></td></tr>
<?php
	onemc_create_user();
?>
</table>
</td></tr></table>
<?php
include("themes/".$theme."/footer.php");
?>
