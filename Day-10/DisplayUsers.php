<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "localstore";

    $conn = mysqli_connect($servername, $username, $password, $db_name);
        // if(!$conn){
        //     die("The DB is not Connected" . $mysqli_connect_error());
        // }else{
        //     echo "The DB is conected<br>";
        // }

    $sql = "SELECT `Employee_ID`, `Name`, `Age`, `City` FROM `employee`";
    $result = mysqli_query($conn, $sql);
        if($result){
            echo "<strong><h2 style='text-align: center;'>The Result is</h2><strong>";
        }else {
            echo "There is some error<br><br>" . mysqli_error($conn);
        }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Display Users Table</title>
        <style>
            table{
                justify-content: center;
                border-collapse: collapse;
                margin: auto;
            }
            table, th, td{
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h2 style="text-align: center;"><strong>Employee's Table</strong></h2>
        <table>
            <tr>
                <th>Employee_ID</th>
                <td>Name</th>
                <th>Age</th>
                <th>City</th>
            </tr>
            <?php 
                if($result->num_rows>0){
                    foreach($result as $row){
                        echo "
                            <tr>
                            <td> " . $row['Employee_ID'] . "<br> </td>
                            <td> " . $row['Name'] . " <br></td>
                            <td> " . $row['Age'] . " </td>
                            <td> " . $row['City'] . " </td>
                            </tr>";
                    }
                }else{
                    echo "<tr><td colspan=3><strong>No DATA FOUND</strong></td></tr>";
                }
                $conn->close();
            ?>
        </table>
        <!-- <?php
        if(!$conn){
            die("The DB is not Connected" . $mysqli_connect_error());
        }else{
            echo "<br><br>The DB is conected<br>"; ///I am doing push to github
        }
        ?> -->
    </body>
</html>
