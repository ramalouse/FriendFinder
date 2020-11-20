<?php

include("db.php");
ensure_logged_in();
include("top.php"); ?>

<style>
.indent{
  margin-left: 20px;
  width: 400px;
  word-wrap: break-word;
  border: solid white 1px;
  margin: 3px;
  background-color: aliceblue;
}
</style>

<h2>Would you like to look up a specific post?</h2>
<form id="view_post" action="viewpost.php" method="get">
    <fieldset>
        <label>Short Title: </label>
        <input type="text" id="short_title" name="short_title">
        
        <button id="submit" class="button">Search</button>
    </fieldset>
</form>

<h2>posts for <?= $_SESSION["name"] ?> to read:</h2>

  <?php 
  foreach (get_posts() as $row) { ?>
  <div class="indent">
    <h2 id="read"><?= $row["title"] ?><br></h2>
    <?= get_username_from_id($row["UID"]);?><br>

    <?= $row["body"] ?><br>
  </div>
  <?php } ?>

<?php include("bottom.php"); ?>
