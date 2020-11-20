<?php
# The registration form submits to here.
# Upon login, remembers user login name in a PHP session variable.
include("db.php");
echo "debug";
if (isset($_REQUEST["name"]) && isset($_REQUEST["password"])) {
  $name = $_REQUEST["name"];
  $password = hash('md5', $_REQUEST["password"]);
  echo "ln9";
  if (user_exist($name)) {
    redirect("user.php", "User already exists");
  } else {
    register ($name, $password);
    if (isset($_SESSION)) {
      session_destroy();
      session_start();
      $_SESSION["name"] = $name;     # start session, remember user info
      session_regenerate_id(TRUE);
    }
    redirect("index.php", "Registration successful! Welcome $name");
  }
} else {
    redirect("user.php", "Please provide a username AND password");
}
?>
