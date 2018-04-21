<?php

include("functions.php");
include("db.php");

?>
<html>
<head>
	<title>Scrabble Club Player Profile</title>
    
</head>
    <body bgcolor="#00ced1">
    
<div> Profile </div>
    <form method="post" action="profile.php">
    <div class="input-group">
			<label>Enter the users name</label>
			<input type="text" name="usersname">
		</div>
        <div class="input-group">
			<button type="submit" name="submitbtn">Submit</button>
		</div>
</form>
    <br>
        <a href="leaderboard.php">Leaderboard</a>    
    <br>
        <a href="create.php">Create/Edit</a>    
</body>
</html>