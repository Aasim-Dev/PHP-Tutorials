<?php

include "dbconnect.php";

$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$city = $_POST['city'];

$stmt = $conn->prepare("UPDATE employee SET Name = ?, Age = ?, City = ? WHERE Employee_ID = ?");
$stmt->bind_param("sisi", $name, $age, $city, $id);

if ($stmt->execute()) {
    echo "Employee updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
