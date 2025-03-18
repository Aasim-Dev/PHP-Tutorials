<?php
    include "DB-connect.php";
    $datanewdata = $_POST['datanewdata'];
    $sql = "SELECT * FROM employee LIMIT $datanewdata";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            echo "Name: " . $row['Name'] . 
            " Age: " . $row['Age'] . 
            " City: " . $row['City'] . 
            "<br>";
        }
    }else{
            echo "No data found";
    }
?>