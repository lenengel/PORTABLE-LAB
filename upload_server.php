<html>
<head>
<title></title>
<script type="text/javascript">
<?php
include("include/config.php");
include("include/onemc_funcs.php");
include("include/auth.php");

global $global_images, $user_images;

if (count($_FILES) > 0) {
    print "parent.UP.stop(true);";
} else {
    print "parent.UP.stop(false);";
}

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0 && valid('upload') && has_permission("upload_image")) {
    $path = preg_replace("/%USER%/", $oneadminuser, $user_images);
    if ($oneadminuser == "oneadmin")
        $path = $global_images;

    if (!is_dir($path)) {
        print "<tr><td colspan=\"2\">Directory ".$path." not valid.</td></tr>";
    } elseif (file_exists($path."/".$_FILES['file']['name'])) {
        print "<tr><td colspan=\"2\">".$_FILES['file']['name']." already exists.</td></tr>";
    } else {
        move_uploaded_file($_FILES['file']['tmp_name'], $path."/".$_FILES['file']['name']);
    }
}
?>
</script>
</head>
</body>
</html>
