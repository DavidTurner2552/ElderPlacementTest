<?php

include("functions.php");
include("db.php");

?>
<html>
<head>
	<title>Scrabble Club Player Creation</title>
    
</head>
    <body bgcolor="#00ced1">
    
<div> Profile </div>
    <form method="post" action="create.php">
    <div class="input-group">
			<label>Enter the users name</label>
			<input type="text" name="playName">
		</div>
    <div class="input-group">
			<label>Enter the users number</label>
			<input type="text" name="playNo">
		</div>
        <div class="input-group">
			<button type="submit" name="createbtn">Create</button>
		</div>
        <div class="input-group">
			<button type="submit" name="editbtn">Edit</button>
		</div>
</form>
    <br>
        <form method="post" action="create.php">
    <div class="input-group">
			<label>Enter the winners name</label>
			<input type="text" name="winName">
		</div>
    <div class="input-group">
			<label>Enter the losers name</label>
			<input type="text" name="lossName">
		</div>
    <div class="input-group">
			<label>Enter the victors score</label>
			<input type="text" name="winScore">
		</div>
    <div class="input-group">
			<label>Enter the date of the match</label>
			<input type="text" name="winDay">
		</div>
        <div class="input-group">
			<button type="submit" name="addbtn">Add Match</button>
		</div>
    
</form>
    
     <br>
        <a href="leaderboard.php">Leaderboard</a>    
    <br>
        <a href="profile.php">Player Profiles</a> 
    
</body>
</html>