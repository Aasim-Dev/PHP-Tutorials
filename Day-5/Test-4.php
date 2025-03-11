<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Test</title>
</head>
<body>
<?php
$nameERR = $emailERR = $passwordERR = $ageERR = "";
$name = $email = $password = $age = "";
$formValid= true; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameERR = "<span style='color: red;'>Name is required</span>";
        $formValid = false;
    } else {
        $name = trim($_POST["name"]); 
        //if(trim($_POST["name"])=true){$nameERR = ""} // it is use for validation of spaces
        if (strlen($name) < 3) {
            $nameERR = "<span style='color: red;'>Name must be at least 3 characters long.</span>";
            $formValid = false;
        } elseif (!preg_match("/^[A-Za-z]+(?:\s+[A-Za-z]+)*$/", $name)) {
            $nameERR = "<span style='color: red;'>Only letters allowed with at most one space in between. No leading/trailing spaces allowed.</span>";
            $formValid = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailERR = "<span style='color: red;'>Email is required</span>";
        $formValid= false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailERR = "<span style='color: red;'>Invalid email format</span>";
            $formValid= false;
        }
    }

    if (empty($_POST["password"])) {
        $passwordERR = "<span style='color: red;'>Password is required</span>";
        $formValid= false;
    } else {
        $password = test_input($_POST["password"]);
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/", $password)) {
            $passwordERR = "<span style='color: red;'>Password must include at least 1 uppercase, 1 lowercase, 1 number, 1 special character & be at least 8 characters long.</span>";
            $formValid= false;
        }
    }

    if (empty($_POST["age"])) {
        $ageERR = "<span style='color: red;'>Age is required</span>";
        $formValid= false;
    } else {
        $age = test_input($_POST["age"]);
        if ($age < 18) {
            $ageERR = "<span style='color: red;'>The age must be 18 or older.</span>";
            $formValid= false;
        }
    }

    //  Show success message only if there are no errors
    if ($formValid) {
        echo "<span style='color: green;'>Form is submitted successfully!</span>";
    }
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<form method="POST" action="">
    Name:<span style="color:red;">*</span> <input type="text" name="name" required><br>
    <span class="error"><?php echo $nameERR;?></span><br>

    Email:<span style="color:red;">*</span> <input type="email" name="email" required><br>
    <span class="error"><?php echo $emailERR;?></span><br>

    Password:<span style="color:red;">*</span> <input type="password" id="password" name="password" required><br>
    <span class="error"><?php echo $passwordERR;?></span><br>

    Age:<span style="color:red;">*</span> <input type="number" id="number" name="age" required><br>
    <span class="error"><?php echo $ageERR;?></span><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php

if($formValid=true){
    echo "<h2> Output of Your Input</h2>";
    echo "<br>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $age;

}
?>

    
    
</body>
</html>
        
    


