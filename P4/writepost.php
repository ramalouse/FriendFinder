<?php
include("db.php");
ensure_logged_in();
?>

<?php include("top.php"); ?>
<h2>What would you like to post today <?= $_SESSION["name"] ?>?</h2>

<form id="post_post" action="postpost.php" method="post">
    <fieldset>
        <label>Short Title: </label>
        <input type="text" id="short_title" name="short_title" placeholder="short title">
        <br>
        
        <label>Title: </label>
        <input type="text" id="title" name="title" placeholder="title">
        <br>

        <label>Body:</label><br>
        <textarea id="body" name="body" placeholder="Put your body here!" rows="4" cols="50"></textarea>
        <br>

        <button id="submit" class="button">Submit</button>
    </fieldset>
</form>

<?php include("bottom.php"); ?>
