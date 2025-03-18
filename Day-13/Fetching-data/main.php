<?php
    include "DB-connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetching Data File</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            var data = 2;
            $("#btn").click(function(){
                data = data + 2;
               $("#don").load("data.php", { 
               datanewdata: data,
                });
            });
        });
    </script>
</head>
<body>
    <div id="don">
        <?php
        $sql = "SELECT * FROM employee LIMIT 2";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                echo "Name: " . $row['Name'] . 
                " Age: " . $row['Age'] . 
                " City: " . $row['City'] . 
                "<br>";
            }
        }
        else{
            echo "No data found";
        }
        ?>
    </div>
    <button id=btn>Click Here to Fetch Data</button>
    
    
</body>
</html>