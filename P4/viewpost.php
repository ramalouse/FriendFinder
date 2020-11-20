<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in();
include("top.php"); ?>

<style>
.indent{
  margin-left: 20px;
  width: 400px;
  word-wrap: break-word;
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

  <?php 
  $stitle = $_GET['short_title'];
  foreach (get_post($stitle) as $row) { ?>
      <div class="indent">
          <h2 id="read"><?= $row["title"] ?><br></h2>
          <?= get_username_from_id($row["UID"]);?><br>
          Short title: <?= $row["short_title"] ?><br>
          <?= $row["body"] ?><br>
      </div>
  <?php } ?>

  <h3>Would you like to update <?php echo($stitle) ?>?</h3>
  
  <form id="update_title" action="updatepost.php" method="post">  
    <fieldset>
      <label>Short Title: </label>
      <input type="text" id="stitle" name="short title" value="<?php echo($stitle) ?>" readonly>
      <br>

      <label>Title: </label>
      <input type="text" id="title" name="title" placeholder="title">
      <br>

      <label>Body:</label><br>
      <textarea id="body" name="body" placeholder="Put your body here!" rows="4" cols="50"></textarea>
      <br>
      <button id="submit" class="button">Update</button>
    </fieldset>
  </form>

<?php include("bottom.php"); ?>
