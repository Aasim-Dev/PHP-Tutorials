<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>example</title>
</head>
<body>
<?php
    $nameERR = $emailERR = $passwordERR = "";
    $name = $email = $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["name"])){
            $nameERR ="Name is required";
        } else{
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-z]/", name)){
            $nameERR = "Only letters and white space allowed";
            }
        }
        if (empty($_POST["email"])){
            $emailERR = "Email is required";
        } else{
            $email = ($_POST["email"]);
            if (!filterval($email, FILTER_VALIDATE_EMAIL)){
                $emailERR = "Invalid email format";
            }
        }
        if (empty($_POST["password"])){
            $passwordERR = "Password is required";
        } else{
            $password = test_input($_POST["password"]);
            if (!preg_match("/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password)){
                $passwordERR = "Password must include at least 1 uppercase, 1 lowercase, 1 number, and 1 special character.";
            }
        }
    }
   
    ?>
    <form method="POST" action="">
        Name: <input type="text" name="name"><br>
        <span class="error"> <?php echo $nameERR;?></span><br>
        Email: <input type="email" name="email"><br>
        <span class="error"> <?php echo $emailERR;?></span><br>
        Password: <input type="password" name="password"><br>
        <span class="error"> <?php echo $passwordERR;?></span><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    
    
</body>
</html>
        
    


