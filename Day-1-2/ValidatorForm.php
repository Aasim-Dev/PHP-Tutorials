
<!DOCTYPE html>
<html>
<head>
<title>Validator Form</title>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .form-container {
    text-align: center;
  }
  .error {
    color: red;
  }
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $passwordErr =  $confirmpasswordErr = $genderErr = "";
$name = $email = $password = $confirmpassword = $gender = "";
$formValid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "<span style='color: red;'>Name is required</span>";
        $formValid = false;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "<span style='color: red;'>Only letters and white space allowed</span>";
            $formValid = false;
        }
        
    }
    if (empty($_POST["email"])) {
        $emailErr = "<span style='color: red;'>Email is required</span>";
        $formValid = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<span style='color: red;'>Invalid email format</span>";
            $formValid = false;
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "<span style='color: red;'>Password is required</span>";
        $formValid = false;
    } else {
        $password = test_input($_POST["password"]);
        // check if password is well-formed
        if (!preg_match("/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password)) {
            $passwordErr = "<span style='color: red;'>Password should contain atleast one uppercase, one lowercase, one digit, one special character and should be atleast 8 characters long</span>";
            $formValid = false;
        }
    }
    if (empty($_POST["confirmpassword"])) {
        $confirmpasswordErr = "<span style='color: red;'>Confirm Password is required</span>";
        
    } else {
        $confirmpassword = test_input($_POST["confirmpassword"]);
        // check if password is well-formed
        if (!preg_match("/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$confirmpassword)) {
            $confirmpasswordErr = "<span style='color: red;'>Password should contain atleast one uppercase, one lowercase, one digit, one special character and should be atleast 8 characters long</span>";
            $formValid = false;
        }else{
            $confirmpasswordErr = '';
        }
    }
    if (empty($_POST["gender"])) {
        $genderErr = "<span style='color: red;'>Gender is required</span>";
        $formValid = false;
    } else {
        $gender = test_input($_POST["gender"]);
        
    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="form-container">
<h2>PHP Form Register Example</h2>
<form method="POST" action=" ">  
  Name:<span style="color: red;">*</span> <input type="text" name="name">
    <span class="error"> <?php echo $nameErr;?></span>
  <br><br>
  E-mail:<span style="color: red;">*</span> <input type="text" name="email">
    <span class="error"> <?php echo $emailErr;?></span>
  <br><br>
  Password:<span style="color: red;">*</span> <input type="password" name="password">
    <span class="error"> <?php echo $passwordErr?></span>
  <br><br>
  ConfirmPassword:<span style="color: red;">*</span> <input type="password" name="confirmpassword"> 
    <span class="error"> <?php echo $confirmpasswordErr?></span>
  <br><br>
  Gender:<span style="color: red;">*</span>
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
    <span class="error"> <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


<?php
if ($formValid) {
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    // echo $password;
    // echo "<br>";
    // echo $confirmpassword;
    echo "<br>";
    echo $gender;
}
?>
</div>

</body>
</html>

