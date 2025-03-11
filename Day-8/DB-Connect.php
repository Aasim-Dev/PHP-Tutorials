<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "supermarket";

$conn = mysqli_connect($servername, $username, $password, $db_name);

if(!$conn){
    die ("The database is not connected" . $mysqli_connect_error());
}
else{
    echo "The database is connected";
}

$sql1 = "CREATE TABLE `EMPLOYEE` 
(`Employee_ID` INT(30) NOT NULL AUTO_INCREMENT , 
`Name` VARCHAR(255), 
`Age` INT(3), 
`City` CHAR(50), 
PRIMARY KEY (`EMPLOYEE_ID`),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP )";

/*creating Client Table with the employee table and giving a foreign key to it.*/
$sql2 = "CREATE TABLE `CLIENT` (
`Client_ID` INT(30) NOT NULL AUTO_INCREMENT, 
`Name` VARCHAR(255), 
`Age` INT(3), 
`City` CHAR(50), 
`Employee_ID` INT(30),  -- Foreign key column added
PRIMARY KEY (`Client_ID`),
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (`Employee_ID`) REFERENCES `EMPLOYEE`(`Employee_ID`) ON DELETE CASCADE )";

/*if($conn->query($sql1) == true){
    echo "The table is created Successfully";
} else{
    echo "There must be some error";
}*/

if($conn->query($sql2) == true){
    echo "The table is created Successfully";
} else{
    echo "There must be some error";
}

$conn->close();


?>