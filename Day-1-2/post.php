<html>
<body>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
  FName: <input type="text" name="fname">
  LName: <input type="text" name="lname">
  Branch: <input type="text" name="branch">
  Email: <input type="email" name="email">
  Pass: <input type="password" name="pass">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = htmlspecialchars($_POST['fname']);
  $lname = htmlspecialchars($_POST['lname']);
  $branch = htmlspecialchars($_POST['branch']);
  $email = htmlspecialchars($_POST['email']);
  $pass = htmlspecialchars($_POST['pass']);
  
  if (empty($fname) || empty($lname) || empty($branch) || empty($email) || empty($pass)) {
    echo "All fields are required.";
  } else {
    $name = $fname . ' ' . $lname; // Combine first and last name
    echo "Name: " . $name . "<br>";
    echo "Branch: " . $branch . "<br>";
    echo "Email: " . $email . "<br>";
  }
}
?>

</body>
</html>