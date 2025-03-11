<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "localstore";

$conn = mysqli_connect($servername, $username, $password, $db);
if($conn){
    echo "The DB is connected Successfully<br>";
}else{
    echo "The DB is not connected successfully<br>" . $mysqli_connect_error();
}

// $sql = "CREATE DATABASE localstore";
// $result = mysqli_query($conn, $sql);
// if($result) {
//     echo "The DB is Creates Successfully";
// } else{
//     echo "The DB is not Created" . mysqli_error($conn);
// }

//creating Table into the DB:-

// $sql2 = "CREATE TABLE `EMPLOYEE` 
// (`Employee_ID` INT(30) NOT NULL AUTO_INCREMENT , 
// `Name` VARCHAR(255), 
// `Age` INT(3), 
// `City` CHAR(50), 
// PRIMARY KEY (`EMPLOYEE_ID`),
// created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP )";


// if($conn->query($sql2) == true){
//     echo "The table is created Successfully";
// } else{
//     echo "There must be some error";
// }


$sql3 = "CREATE TABLE `Salary` (
    `ID` INT NOT NULL AUTO_INCREMENT,
    `Position` VARCHAR(100) NOT NULL,
    `Salary` DECIMAL(10, 2) NOT NULL,
    `Status` BOOLEAN NOT NULL,   
    `Employee_ID` INT,   
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`),
    FOREIGN KEY (`Employee_ID`) REFERENCES `EMPLOYEE`(`Employee_ID`) ON DELETE CASCADE)";

if($conn->query($sql3) == true){
    echo "The table is created Successfully<br>";
} else{
    echo "There must be some error<br>";
}
?>