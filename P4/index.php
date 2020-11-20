<?php 
include("top.php");
include ("db.php");

if (!isset($_SESSION["name"])) {    ?>

</style>
    
    <h2>Welcome!</h2>
    <p>Would you like to <a href="user.php">sign up?</a></p>
    <br><br>
    
    <?php
}
else {
    $name = $_SESSION["name"];
    $userid = get_UID($name);
    //logged in properly
    ?>

    <h2>Welcome back, <?= $name ?>!</h2>

    <div id="leftcolumn"> 
        <?php
        $numposts = get_num_posts($userid);
        //echo $numposts;
        if ($numposts == 0){
            //echo "debug";
            ?>
            
            <h3>You haven't posted anything yet. <a href="writepost.php">Write a post.</a></h3>
            
            <?php
            
        } else{     ?>

        <h3>Here are your posts:</h3>
        
        <?php
        foreach (get_posts_id(get_UID($name)) as $row) { ?>
        <div class="indent">
            <h2 id="read"><?= $row["title"] ?><br></h2>
            <div id="small">
                <img src='head_pumpkin.png'/>
                <h3 id="name"><?= get_username_from_id($row["UID"]);?></h3>
            </div>
            <p id="body"><?= $row["body"] ?></p><br>
        </div>

    <br>
    
    <?php
    }

}?> 

</div> 
    
    <!-- Friends list -->
    <div id="rightcolumn">
        <div id="friendlist">
        <h4>Your friends:</h4>

        <?php //if friends 
        $friendslist = get_friends($userid);
        if (sizeof($friendslist) > 0){  ?> 
        <ul>
            <?php
            for ($j = 0; $j < sizeof($friendslist); $j++){
                ?> <li class="whitetext"><?= $friendslist[$j]; ?></li> <?
            }
            ?> 
        </ul> 
        
        <?php //if no friends
        } else {  ?>
            <h4> You don't have any friends.</h4>
            
            <?php
            }?>
        </div> 
    </div>
    <br>
    <?php
}
//and the footer 
include("bottom.php"); ?>