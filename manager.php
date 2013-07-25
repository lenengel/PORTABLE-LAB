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
    if (has_permission("create_template")) {
        print "<tr><td colspan=\"12\"><h3>Create template:</h3></td></tr>";
        onemc_create_template();
    }
?>
</table>
</td><td valign="top">
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<?php
    if (has_permission("edit_template")) {
        print "<tr><td colspan=\"2\"><h3>Remove template:</h3></td></tr>";
        onemc_remove_template();
    }
    if (has_permission("upload_image")) {
        print "<tr><td colspan=\"2\"><h3>Upload image:</h3></td></tr>";
        onemc_upload_image();
    }
    if (has_permission("edit_image")) {
        print "<tr><td colspan=\"2\"><h3>Remove image:</h3></td></tr>";
        onemc_remove_image();
    }
?>
</table>
</td></tr></table>
<?php
include("themes/".$theme."/footer.php");
?>
