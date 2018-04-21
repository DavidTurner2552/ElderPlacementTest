<?php
        $servername = "localhost";
        $username = "u1661633";
        $password = "01sep97";
        $db = "u1661633";
 $con = mysqli_connect($servername, $username, $password, $db);
        if (!$con){
            die("Connection Failed: ". mysqli_connect_error());
  
}
?>