<?php
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: Loginpage.php");
    
    
    exit();
}
$message = "Login Successful";
echo "<script type='text/javascript'>alert('$message');</script>";
?>

