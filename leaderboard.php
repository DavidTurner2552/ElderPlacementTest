<?php

include("functions.php");
include("db.php");

?>
<html>
<head>
	<title>Scrabble Club LeaderBoard</title>
    
</head>
    <body bgcolor="#00ced1">
    
<div> Leaderboard </div>
    <?php
    getLeaderboard();
    ?>
    
     <br>
    <br>
        <a href="profile.php">Player Profiles</a>    
    <br>
        <a href="create.php">Create/Edit</a> 
    
</body>
</html>