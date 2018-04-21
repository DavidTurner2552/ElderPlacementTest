<?php
 session_start();
 $con = mysqli_connect("localhost","u1661633","01sep97","u1661633");

 if(mysqli_connect_errno()){
  
  echo"Failed to connect : " . mysqli_connect_error(); 
  
}

if(isset ($_POST['submitbtn'])) {
	getPlayerInfo();
}

if(isset ($_POST['createbtn'])) {
	createPlayer();
}

if(isset ($_POST['editbtn'])) {
	editPlayer();
}

if(isset ($_POST['addbtn'])) {
	addGame();
}

function getPlayerInfo(){
    global $con;
    
    $name = $_POST['usersname'];
    $query = "SELECT * FROM Eld_Players WHERE Name = '$name'";
    $res = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($res)){
        
        $name = $row['Name'];
        $id = $row['PlayerID']; 
        
        $query = "SELECT COUNT(WinID) FROM Eld_Games WHERE WinID ='$id'";
        $results = mysqli_query($con,$query);
        $rows = mysqli_fetch_array($results);
        $wins = $rows['COUNT(WinID)'];
        
        $query = "SELECT COUNT(LossID) FROM Eld_Games WHERE LossID ='$id'";
        $results = mysqli_query($con,$query);
        $rows = mysqli_fetch_array($results);
        $losses = $rows['COUNT(LossID)'];
        
        $query = "SELECT SUM(Score)/ COUNT(WinID) FROM Eld_Games WHERE WinID = '$id'";
        $results = mysqli_query($con,$query);
        $rows = mysqli_fetch_array($results);
        $avg = $rows['SUM(Score)/ COUNT(WinID)'];
        
        $query = "SELECT Name, WinID, LossID, Score, Date FROM Eld_Games, Eld_Players WHERE Score = (SELECT MAX(Score) FROM Eld_Games WHERE WinID = '$id') AND WinID = '$id' AND PlayerID = LossID";
        $results = mysqli_query($con,$query);
        $rows = mysqli_fetch_array($results);
        $hscore = $rows['Score'];
        $otherplayer = $rows['Name'];
        $date = $rows['Date'];
        
        
        echo "Profile Name: $name <br> Number of Wins: $wins <br> Number of Losses $losses <br> Average Score: $avg <br> Players highest score was: $hscore against: $otherplayer on: $date <br> <br>";
    }
}

function getLeaderboard(){
    global $con;
    
    $query = "SELECT Q1.*, Q2.*
FROM
(SELECT Name AS NAme, (COUNT(WinID) + COUNT(LossID))/2 AS Games FROM Eld_Games, Eld_Players WHERE PlayerID = LossID OR PlayerID = WinID GROUP BY PlayerID) AS Q1
JOIN(SELECT Name AS NAme, SUM(Score)/ COUNT(WinId) AS AvgScore FROM Eld_Games, Eld_Players WHERE Eld_Players.PlayerID = WinID GROUP BY Name) AS Q2
ON Q1.NAme = Q2.NAme
WHERE Q1.Games > 9
GROUP BY Q1.NAme
ORDER BY Q2.AvgScore DESC
LIMIT 10";
    $results = mysqli_query($con,$query);
     while($row = mysqli_fetch_array($results)){
         $name = $row['NAme'];
         $score = $row['AvgScore'];
         
         echo "<br> $name  :  $score";
     }
}

function createPlayer() {
    global $con;
    
    $name = $_POST['playName'];
    $number = $_POST['playNo'];
    
    $query = "SELECT MAX(PlayerID) +1 FROM Eld_Players";//Query to set the next customer id.
        $result = mysqli_query($con,$query);
        $row=$result->fetch_assoc();
        $id=$row['MAX(PlayerID) +1'];
    
    $query = "INSERT INTO Eld_Players VALUES ('$name', '$number', '$id')";
    $result = mysqli_query($con,$query);
    
    echo"Player $name was added succesfully";
}

function editPlayer() {
    global $con;
    
    $name = $_POST['playName'];
    $number = $_POST['playNo'];
    
    $query = "UPDATE Eld_Players SET PhoneNo = '$number' WHERE Name = '$name'";
    $result = mysqli_query($con,$query);
    
    echo"The contact number assigned to $name has been changed";
}

function addGame(){
    global $con;
    
    $winname = $_POST['winName'];
    $lossname = $_POST['lossName'];
    $score = $_POST['winScore'];
    $date = $_POST['winDay'];
    
    $query = "SELECT PlayerID FROM Eld_Players WHERE Name = '$winname'";
    $result = mysqli_query($con,$query);
    $row=$result->fetch_assoc();
    $winid=$row['PlayerID'];
    
    $query = "SELECT PlayerID FROM Eld_Players WHERE Name = '$lossname'";
    $result = mysqli_query($con,$query);
    $row=$result->fetch_assoc();
    $lossid=$row['PlayerID'];
    
    $query = "INSERT INTO Eld_Games VALUES ('$winid', '$lossid', '$score', '$date')";
    $result = mysqli_query($con,$query);
    
    echo "Game added.";
}

?>