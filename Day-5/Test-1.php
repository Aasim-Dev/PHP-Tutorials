<DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test-1</title>
</head>
<body>
    <h2> Check if a number is even or odd</h2>
    
    <form method="POST" action="">
        Numbers: <input type="number" id="number" name="number" required><br>
        <input type="submit" name="submit" value="Submit">
    </form>
        
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $number = $_POST["number"];
        if ($number){
            if ($number % 2 == 0){
                echo "The number is even";
            } else{
                echo "The number is odd";
            }
        }
    }

    ?>
</body>
</html>