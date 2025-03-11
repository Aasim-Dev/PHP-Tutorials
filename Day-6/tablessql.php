<?php

//we are going to create tables in mysql database using php
echo "we are going to create tables in mysql database using php";
$servername = "localhost";
$username = "root";
$password = "";
$database = "forms";
//creating a connection to database
$connect = mysqli_connect($servername, $username, $password, $database);

if(!$connect){
    die("the connection is not done" . $mysqli_connect_error());
} else{
    echo "database is connected: ";
}
$sql = "CREATE TABLE `phpform` (`srno` INT(20) NOT NULL AUTO_INCREMENT , `name` VARCHAR(20) NOT NULL , `email` VARCHAR(20) NOT NULL , `pass` VARCHAR(20) NOT NULL , PRIMARY KEY (`srno`))";
$result = mysqli_query($connect, $sql);
// check for the table creation
if($result){
    echo "The Database table is created Successfully";
} else {
    "The DB table is not created Successfully: " . mysqli_error($connect);
}

?>