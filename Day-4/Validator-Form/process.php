<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
    $error = [];

    if(empty($name) || strlen($name) < 4){
        $error["name"] = "Name is required and should be of minimum 20 characters";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error["email"] = "Email is required and should be a valid email address";
    }
    if(empty($password) || strlen($password) < 8){
        $error["password"] = "Password is required and should be of minimum 8 characters";
    }
    if(empty($confirm_password) || $confirm_password != $password){
        $error["confirm_password"] = "Confirm Password is required and should be same as password";
    }
    if (empty($errors)) {
        // Success message
        echo "Form submitted successfully!";
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>