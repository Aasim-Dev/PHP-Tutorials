<html>
    <head>
        <title> Sessions Forms</title>
    </head>
    <body>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <input type="submit" value="Submit">
        </form>
        <?php
        session_start();

        if(!isset($_SESSION["name"])){
            $_SESSION["name"] = "";
        }
        if(!isset($_SESSION["email"])){
            $_SESSION["email"] = "";
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $_SESSION["name"] = htmlspecialchars(trim($_POST["name"]));
            $_SESSION["email"] = htmlspecialchars(trim($_POST["email"]));
        }
       
        ?>
        <h1> Your Output is : </h1>
        <p>Name:<?php echo $_SESSION["name"]; ?> <button>Edit</button><button>Delete</button><p>
        <p>Email:<?php echo $_SESSION["email"]; ?>  <button>Edit</button><button>Delete</button> <p>
    </body>
</html>
<!-- // session_start();

// $_SESSION['favcar'] = 'Supraa';
// $_SESSION['favplane'] = 'Airbus A-380';

// echo "His favourite car is " . $_SESSION['favcar'] . " and favourite Flight is " . $_SESSION['favplane'] .  -->
 
