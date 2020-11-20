<?php
# The update post form submits to here.
include("db.php");

$stitle = $_REQUEST['short_title'];
$title = $_REQUEST['title'];
$body = $_REQUEST["body"];

if (!empty($title) && !empty($body)){
    update_post($stitle, $title, $body);
} elseif (!empty($title)){
    update_title($stitle, $title);    
} elseif (!empty($body)){
    update_body($stitle, $body);
} else {

}

// update_body($stitle, $body);
?>
