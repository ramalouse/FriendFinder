<!DOCTYPE html>
<html>
  <head>
    <title>Friend Finder - FIND FRIENDS HERE IN YOUR AREA</title>
    <link href="format.css" type="text/css" rel="stylesheet" />
  </head>

  <body>
    <h1><img src="logo.png"></img></h1>
  
    <ul id="navigation">
      <li><a href="index.php">Main Page</a></li>
      <li><a href="writepost.php">Write post</a></li>
      <li><a href="viewposts.php">View post</a></li>
      <li><a href="user.php">Log In/Out</a></li>
    </ul>
    
    <?php
    //session_save_path("sessions/");
    if (!isset($_SESSION)) { session_start(); }
    ?>
    
    <?php
    if (isset($_SESSION["flash"])) {
      # temporary message across page redirects
      ?>
      <div id="flash"> <?= $_SESSION["flash"] ?> </div>
      <?php
      unset($_SESSION["flash"]);
    }
    ?>
