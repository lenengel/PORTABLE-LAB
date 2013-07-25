<?php

if (function_exists("uploadprogress_get_info")) {
    $info = uploadprogress_get_info($_GET['ID']);
} else {
    $info = false;
}

?>
<html>
<head>
<title></title>
<script type="text/javascript">
<?php
if ($info !== null) {
    print "parent.UP.updateInfo(".$info['bytes_uploaded'].",".$info['bytes_total'].",".$info['est_sec'].")";
} else {
    print "parent.UP.updateInfo()";
}
?>
</script>
</head>
<body>
</body>
</html>
