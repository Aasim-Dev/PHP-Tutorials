<?php

include "dbconnect.php";
$id = $_POST['id'];

$sql1 = "DELETE FROM employee WHERE Employee_ID = '$id'";
if(mysqli_query($conn, $sql1)){
    echo "Message sent successfully";
}else{  
    echo "Error: <br>" . mysqli_error($conn);
}

?>