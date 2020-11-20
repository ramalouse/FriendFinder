<?php
include("db.php");
ensure_logged_in();
include("top.php"); 
?>


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
    <div id="small">
      <img src='head_pumpkin.png' />
      <h3 id="name"><?= get_username_from_id($row["UID"]);?></h3>
    </div>
    <p id="body"><?= $row["body"] ?></p><br>
    
    <h2 id="like"><?php echo(get_num_likes($row["short_title"])) ?> likes</h2>
    <form method="post" action="likepost.php">
      <input type="hidden" name="short_title" value="<?php echo htmlspecialchars($row["short_title"]); ?>">
      <input type="submit" name="test" class="test" value="Like" id="like" /><br/>
    </form>
  </div>
  
  <?php } 
  ?>

<?php include("bottom.php"); ?>
