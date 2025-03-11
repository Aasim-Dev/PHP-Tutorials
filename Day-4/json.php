<?php

$students = '{"branch" : "Computer Science", "rollno" : 210390116, "name" : "Aasim Sanandwala", "age": 20}';
echo json_encode($students);
echo "<br>";
var_dump(json_decode($students, true));
echo "<br>";
$obj = json_decode($students);
echo $obj->branch;
echo "<br>";
echo $obj->rollno;
echo "<br>";
echo $obj->name;
echo "<br>";
echo $obj->age;
echo "<br>";
?>