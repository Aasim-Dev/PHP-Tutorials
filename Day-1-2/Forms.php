<html>
<head>
<title>Validator Form</title>
</head>
<body>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Welcome " . htmlspecialchars($_POST["name"]) . "<br>";
    echo "Your email address is: " . htmlspecialchars($_POST['email']) . "<br>";
    echo "Your password is: " . htmlspecialchars($_POST['password']) . "<br>";
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit">
</form>

</body>
</html>

