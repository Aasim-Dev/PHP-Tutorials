<?php
// connecting to a database
$servername = "localhost";
$username = "root";
$password = "";
//creating a connection to database
$connect = mysqli_connect($servername, $username, $password);

//use of die function with if... else
if(!$connect){
    die("the connection is not done" . $mysqli_connect_error());
} else{
    echo "database is connected: ";
}


//creating a db :- 
$sql = 'CREATE DATABASE Forms3';
$result = mysqli_query($connect, $sql);

if($result){
    echo "The Database is created Successfully";
} else {
    "The DB is not created Successfully: " . mysqli_error($connect);
}


?>