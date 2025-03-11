<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $database = "forms";
    //creating a connection to database
    $connect = mysqli_connect($servername, $username, $password, $database);
    if(!$connect){
        die("the connection is not done" . $mysqli_connect_error());
    } else{
        echo "";
    }

    echo "<br>";
?>