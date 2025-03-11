<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test-2</title>
    </head>
    <body>
        <h2> Greet the user</h2>
        <form method="POST" action="">
            Name: <input type="text" id="name" name="name" required><br>
            <input type="submit" name="submit" value="Submit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST["name"];
            function greet($name){
                echo "Hello " .  $name . ", How are you";
            }
            echo greet($name);
        }
        ?>
    </body>
</html>