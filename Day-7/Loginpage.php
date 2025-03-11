<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];  // Do NOT hash this

    // Prepare SQL statement
    $stmt  = $connect->prepare("SELECT Password FROM phpform3 WHERE Email = ?" );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the email exists in the database
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($database_password);
        $stmt->fetch();


        $password = htmlspecialchars(trim($password));
        $password = password_hash($password, PASSWORD_DEFAULT);
    

        // Debugging: Check what password is stored in the database
        // echo "Hashed Password from DB: " . $database_password;

        // Check if the entered password matches the hashed password
        if (password_verify($password, $database_password)) {
            echo "You are Logged in Successfully";

            // Start session
            session_start();
            $_SESSION['email'] = $email;

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Password is incorrect";
        }
    } else {
        echo "Email not found";
    }

    // Close statement and connection
    $stmt->close();
    $connect->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
