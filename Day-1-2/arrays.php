<?php

$branch[0] = "I.T.";
$branch[1] = "C.S.E.";
$branch[2] = "CIVIL";
//Example of array_push
array_push($branch, "Mechanical");
var_dump($branch);
echo"<br>";

//Associative array
$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
echo "<br>";
var_dump($car);
echo "<br>";
echo $car['brand'];
echo "<br>";
$car['brand'] = "Toyota";
echo "<br>";
var_dump($car);
echo"<br>";

//Storing functions as arrays
echo"<br>";
function myFunction() {
    echo "I come from a function!";
}
$myArr = array("Volvo", 15, myFunction ());
$myArr[1]; //Outputs: I come from a function! 
echo"<br>";

//Sorting arrays
echo"<br>";
$numbers = array(4, 6, 2, 22, 11);
sort($numbers); //sorts in ascending order
var_dump($numbers);//
echo"<br>";
rsort($numbers);//sorts in descending order
var_dump($numbers);
echo"<br>";
asort($numbers);//sorts in ascending order, according to the value
ksort($numbers);//sorts in ascending order, according to the key
arsort($numbers);//sorts in descending order, according to the value
krsort($numbers);//sorts in descending order, according to the key
echo"<br>";

//Multidimensional arrays
echo "<br>";
$cars = array (
    array("Volvo",22,18),
    array("BerminghamMotorWorks",15,13),
    array("BhaiSaab",5,2),
    array("Land Rover",17,15)
  );
  krsort($cars);
  echo "<br>";
  var_dump($cars);
echo"<br>";



?>