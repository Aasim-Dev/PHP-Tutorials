<?php

include "dbconnect.php";
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$city = $_POST['city'];

$sql = "INSERT INTO employee (Name, Age, City) VALUES ('$name', '$age', '$city')";
if(mysqli_query($conn, $sql)){
    echo "Message sent successfully";
}else{
    echo "Error:  <br>" . mysqli_error($conn);
}

?>