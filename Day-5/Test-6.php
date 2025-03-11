<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test-6</title>
</head>
<body>
    <h2> Enter Numbers</h2>
    <form method="POST" action="">
        Number: <input type="text" name="number" id="number" required> 
        <button type="submit" >Calculate sum </button>
    </form>
    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $input = trim($_POST["number"]);
        $numbers = explode(',', $input);
        $sum = array_sum($numbers);
        echo "<h3>Sum: $sum</h3>";

    } // below logic is taken from online

    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     if(!empty($_POST["number"])){
    //         $input = trim($_POST["number"]);
    //         $numbersArray = array_map('trim', explode(',', $input));

    //         // Validate if all inputs are numbers
    //         if (array_filter($numbersArray, 'is_numeric') === $numbersArray) {
    //             // Convert to integers and calculate the sum
    //             $sum = array_sum($numbersArray);
    //             echo "<h3>Sum: $sum</h3>";
    //         } else {
    //             echo "<p style='color: red;'>Invalid input. Please enter only numbers separated by commas.</p>";
    //         }
    //     } else {
    //         echo "<p style='color: red;'>Please enter some numbers.</p>";
    //     }
    // }
    ?>
</body>
</html>
