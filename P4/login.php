<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");
if (isset($_REQUEST["name"]) && isset($_REQUEST["password"])) {
  $name = $_REQUEST["name"];
  $password = hash('md5', $_REQUEST["password"]);
  if (is_password_correct($name, $password)) {
    if (isset($_SESSION)) {
      session_destroy();
      session_regenerate_id(TRUE);
      session_start();
    }
    $_SESSION["name"] = $name;     # start session, remember user info
    redirect("index.php", "Login successful! Welcome back.");
  } else {
    redirect("user.php", "Incorrect user name and/or password.");
  }
}
?>
