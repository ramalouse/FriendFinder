<?php include("top.php");
include ("db.php");

if (!isset($_SESSION["name"])) {
    ?>
    <h2>Welcome!</h2>
    <p>Would you like to <a href="user.php">sign up?</a></p>
    <br><br>
    <?php

}
else {
    //logged in properly
    ?>
    <h2>Welcome back, <?= $_SESSION["name"] ?>!</h2>

<br>
    <?php
    //get uid of current user
    $uname1 = $_SESSION["name"];
    $db = mysqli_connect("localhost", "root", "", "friendfinder");
    $idquery = "SELECT UID FROM users WHERE name = '$uname1'";
    $idquery1 = mysqli_query($db, $idquery);
    $array = array();
    while ($row = mysqli_fetch_assoc($idquery1)) {
        array_push($array, $row['UID']);
    }
    $userid = $array[0];
    ?><div id="leftcolumn"> <?php
    //get posts made by this user
    $countposts = get_posts_id($userid);
    //echo "debug";
    //var_dump($countposts);
    $array2 = array();
    while ($row2 = mysqli_fetch_assoc($countposts)) {
        //echo "debug ";
        //var_dump($row2);
        //echo $row2[1];
        array_push($array2, $row2['short_title']);
    }
    //echo "debug 40 - ";
    $numposts = sizeof($array2);
    //echo $numposts;
    if ($numposts == 0){
        //echo "debug";
        ?>
        <h3>You haven't posted anything yet. <a href="writepost.php">Make a post.</a></h3><?php
    }
    else{
        ?>
        <p>Here are your posts:</p>
        <?php
    foreach (get_posts_id($userid) as $row) { ?>

        <div class="indent">
            <h2 id="read"><?= $row["title"] ?><br></h2>
            <?= get_username_from_id($row["UID"]);?><br>
            <?= $row["body"] ?><br>
        </div>

    <br>
    <?php
    }

}
    ?> </div> <?php
    //friends list
    ?><div id="rightcolumn"> <?php
    //we know $userid is the id of the current user
    //we first need a query to get the id nums of all of our current user's friends
    $friendquery1 = "SELECT uid2 FROM friend WHERE uid1 = '$userid'";
    $friendquery2 = "SELECT uid1 FROM friend WHERE uid2 = '$userid'";
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
    //var_dump($array4);
    //we now have an array ($array4) full of the names of our friends
    //now we list them out in a nice and neat fashing.
    ?>
    <div id="friendlist">
        <h4>Your friends:</h4>
        <?php
        //we need an if block to check if we have any friends
        if (sizeof($array4) > 0){
        ?>
        <ul>
    <?php
    for ($j = 0; $j < sizeof($array4); $j++){
        ?> <li class="whitetext"><?= $array4[$j]; ?></li> <?
    }
    ?> </ul> <?php
    }
        else { //no friends
            ?>
            <h4> You don't have any friends.</h4><?php
}
        ?></div> </div><br>
    <?php
    }
include("bottom.php"); ?>
