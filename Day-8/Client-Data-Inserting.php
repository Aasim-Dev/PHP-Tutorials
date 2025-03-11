<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Inserting Details</title>
    </head>
    <body>
        <h1> This Is Example Of Client-Data-Inserting into the Table</h1>
        <form method="POST" action=" ">
            Client-ID: <input type="number" name="ID" required><br><br>
            Name:<input type="text" name="name" required><br><br>
            Age: <input type="number" name="age" required><br><br>  
            City:<input type="text" name="city" required><br><br>
            Employee-ID: <input type="number" name="ID1" required><br><br>
            <input type="submit" value="Submit">
        </form>

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "supermarket";

        $conn = mysqli_connect($servername, $username, $password, $db_name);

        if(!$conn){
            die ("The database is not connected<br>" . $mysqli_connect_error());
        }
        else{
            echo "The database is connected<br>";
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST["ID"];
            $name = $_POST["name"];
            $age = $_POST["age"];
            $id1 = $_POST["ID1"];
            $city = $_POST["city"];

            $sql = "INSERT INTO `Client` (`Client_Id` , `Name`, `Age`, `City`, `Employee_ID`) VALUES ('$id', '$name', '$age', '$city', '$id1');";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "The Details are inserted Successfully.<br>";
            } else{
                echo "The Details are not inserted. <br>" . mysqli_error($conn);
            }

        }

        ?>
    </body>
</html>