<?php
# The like post form submits to here.
include("db.php");
$stitle = $_REQUEST["short_title"];
echo($stitle);
add_like($stitle);
?>
