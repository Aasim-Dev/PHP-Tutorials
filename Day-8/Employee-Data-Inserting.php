<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Inserting Queries</title>
    </head>
    <body>
    <h1> This Is Example Of Employee-Data-Inserting into the Table</h1>
        <form method="POST" action="">
            ID: <input type="number" name="ID"><br><br>
            Name:<input type="text" name="name"><br><br>
            Age: <input type="number" name="age"><br><br>
            City:<input type="text" name="city"><br><br>
            <input type="submit" value="SUBMIT">
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
            $city = $_POST["city"];

            $sql = "INSERT INTO `Employee` (`Employee_ID` , `Name`, `Age`, `City`) VALUES ('$id', '$name', '$age', '$city');";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "The Details are inserted Successfully.<br>";
            } else{
                echo "The Details are not inserted. <br>" . mysqli_error($conn);
            }
            /* Updating Query of My SQL :-
            $sql2 = "UPDATE Employee
                    SET Name='Amin'
                    WHERE Employee_ID = 12;";
            $res = mysqli_query($conn, $sql2);
            */
            /*  Deleting Query of MySQL :-
            $sql2 = "DELETE FROM Employee WHERE City='Jamjodhpur';";
            $res = mysqli_query($conn, $sql2);
            */
            $sql2 = "SELECT MIN(Age) FROM Employee;";
            
            $res = mysqli_query($conn, $sql2);
        }

        ?>