<?php
//session_save_path("/var/www/html/stepp/grades/sessions/");
if (!isset($_SESSION)) { session_start(); }

# Returns TRUE if given password is correct password for this user name.
function is_password_correct($name, $password) {
  $db = new PDO("mysql:host=localhost;dbname=friendfinder", "root", "");
  $name = $db->quote($name);
  $rows = $db->query("SELECT password FROM users WHERE name = $name");
  if ($rows) {
    foreach ($rows as $row) {
      $correct_password = $row["password"];
      return $password === $correct_password;
    }
  } else {
    return FALSE;   # user not found
  }
}

function user_exist($name) { //done dont even think about touch
  $db = new PDO("mysql:host=localhost;dbname=friendfinder", "root", "");
  $name = $db->quote($name);
  $rows = $db->query("SELECT name FROM users WHERE name = $name");
  if ($rows) {
    foreach ($rows as $row) {
      $user = $row["password"];
      return $user !== $name; #user found
    }
  } else {
    return FALSE; #user not found
  }
}

function register($name, $password) { //done do not touch
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  $query = "INSERT INTO users VALUES (0, '$name', '$password')";
  if (!mysqli_query($db, $query)) {
    die('Error '.mysqli_error($db));
  } 
}

function post_post($stitle, $title, $body) { //done do not touch
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  //get the id number of user making post
  $uname1 = $_SESSION["name"];
  $idquery = "SELECT UID FROM users WHERE name = '$uname1'";
  $idquery1 = mysqli_query($db, $idquery);
  $array = array();
  while ($row = mysqli_fetch_assoc($idquery1)) {
    array_push($array, $row['UID']);
  }
  $userid = $array[0];
  $query = "INSERT INTO posts (short_title, title, body, UID) VALUES ('$stitle', '$title', '$body', '$userid')";
  if (empty($stitle) || empty($title) || empty($body)) { //this took me WAY too long to figure out. Okay? A simple if statement. Way too long. I am actually ashamed of myself.
    redirect("writepost.php", "Please provide a short title, title, and body.");
  } elseif (!mysqli_query($db, $query)) {
    return redirect("writepost.php", "post with short title $stitle already exists!");
    // die('Error '.mysqli_error($db));
  }
   else {
    redirect ("viewpost.php?short_title=$stitle", "post Posted!");
    exit();
  }
}

    //get uid of current user
function get_UID($uname1) {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  $idquery = "SELECT UID FROM users WHERE name = '$uname1'";
  $idquery1 = mysqli_query($db, $idquery);
  $array = array();

  while ($row = mysqli_fetch_assoc($idquery1)) {
      array_push($array, $row['UID']);
  }
  $userid = $array[0];
  return $userid;
}

function get_num_posts($id) {
  //get posts made by this user
  $countposts = get_posts_id($id);
  //echo "debug";
  //var_dump($countposts);
  $array2 = array();
  while ($row2 = mysqli_fetch_assoc($countposts)) {
      //echo "debug ";
      //var_dump($row2);
      //echo $row2[1];
      array_push($array2, $row2['short_title']);
  }
  $numPosts = sizeof($array2);
  return $numPosts;
  //echo "debug 40 - ";
}

function get_username_from_id($uid){
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  $namequery = "SELECT name FROM users WHERE UID = '$uid'";
  $runquery = mysqli_query($db, $namequery);
  $array = array();
  while ($row = mysqli_fetch_assoc($runquery)) {
    array_push($array, $row['name']);
  }
  return $array[0];
}

function get_posts() {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  // $query = "SELECT * FROM posts";
  return $db->query("SELECT * FROM posts");
}

function get_num_likes($stitle){
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  $query = "SELECT likes FROM posts WHERE short_title = '{$stitle}'";
  $q = mysqli_query($db, $query);
  while ($row = mysqli_fetch_assoc($q)) {
    $num = $row["likes"];
  return $num;
}
}

function get_posts_id($id) {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  // $query = "SELECT * FROM posts";
  return $db->query("SELECT * FROM posts WHERE UID = '$id'");
}

function count_posts_id($id) {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  // $query = "SELECT * FROM posts";
  return $db->query("SELECT COUNT(short_title) FROM posts WHERE UID = '$id'");
}

function get_post($stitle) { //ryan was here
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  // $query = "SELECT * FROM posts";
  return $db->query("SELECT * FROM posts WHERE short_title = '{$stitle}'");
}

function get_friends($uid) { //no this function does not give you friends
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  //we know $userid is the id of the current user
  //we first need a query to get the id nums of all of our current user's friends
  $friendquery1 = "SELECT uid2 FROM friend WHERE uid1 = '$uid'";
  $friendquery2 = "SELECT uid1 FROM friend WHERE uid2 = '$uid'";
  //this is done twice because of how table friend is set up
  $fq1 = mysqli_query($db, $friendquery1);
  $fq2 = mysqli_query($db, $friendquery2);

  //write a for loop; for each item in fq1 and fq2, put the uid into an array
  $array3 = array();
  while ($row = mysqli_fetch_assoc($fq1)) {
      array_push($array3, $row['uid2']);
  }
  while ($row = mysqli_fetch_assoc($fq2)) {
      array_push($array3, $row['uid1']);
  }
  //var_dump($array3);
  //write a for loop; for each item in array3, run a query to get the name of the user; put usernames into an array
  $array4 = array();
  for ($i = 0; $i < sizeof($array3); $i++){
      $uid = $array3[$i];
      $namequery = "SELECT name FROM users WHERE UID = '$uid'";
      $nq = mysqli_query($db, $namequery);
      while ($row = mysqli_fetch_assoc($nq)) {
          array_push($array4, $row['name']);
      }
  }

  return $array4;
    //var_dump($array4);
    //we now have an array ($array4) full of the names of our friends
    //now we list them out in a nice and neat fashing.
}

function add_like($stitle) {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  $db->query("UPDATE posts SET likes = likes+1 WHERE short_title = '$stitle'");
  redirect ("viewposts.php", "post liked!");
}

function update_title($stitle, $title) {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  if (empty($title)){
    redirect("viewpost.php?short_title=$stitle", "Please provide title text");
  } else{
    $db->query("UPDATE posts SET title = '$title' WHERE short_title = '$stitle'");
    redirect("viewpost.php?short_title=$stitle", "Succesfully updated title!");
  }
}

function update_body($stitle, $body) {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  if (empty($body)){
    redirect("viewpost.php?short_title=$stitle", "Please provide title text");
  } else{
    $db->query("UPDATE posts SET body = '$body' WHERE short_title = '$stitle'");
    redirect("viewpost.php?short_title=$stitle", "Succesfully updated body!");
  }
}

function update_post($stitle, $title, $body) {
  $db = mysqli_connect("localhost", "root", "", "friendfinder");
  if (empty($body) && empty($title)){
    redirect("viewpost.php?short_title=$stitle", "Please provide title/body text");
  } else{
    $db->query("UPDATE posts SET title = '$title' WHERE short_title = '$stitle'");
    $db->query("UPDATE posts SET body = '$body' WHERE short_title = '$stitle'");
    redirect("viewpost.php?short_title=$stitle", "Succesfully updated title and body!");
  }
}

# Redirects current page to login.php if user is not logged in.
function ensure_logged_in() {
  if (!isset($_SESSION["name"])) {
    redirect("user.php", "You must log in before you can view that page.");
  }
}

# Redirects current page to the given URL and optionally sets flash message.
function redirect($url, $flash_message = NULL) {
  if ($flash_message) {
    $_SESSION["flash"] = $flash_message;
  }
  # session_write_close();
  header("Location: $url");
  die;
}
?>
