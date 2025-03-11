<?php

echo"<h1>This is an examples of datatypes</h1><br>";

//string
//Integer
//Float
//Boolean
//Array
//Object
//NULL


//Casting to integer
$x = 23465.768;
$int_cast = (int)$x;
echo $int_cast;

echo "<br>";

// Cast string to int
$x = "23465.768";
$int_cast = (int)$x;
echo $int_cast;
echo "<br>";

$x = acos(8);
var_dump($x);
echo "<br>";    

$name="Aasim";
$Friend="Madhav";
echo "<br>";
$age="20";
var_dump($age);
echo "<br>";
echo "My name is $name and my friend name is $Friend<br>";//example of strings
$age=22;
echo "Aasim is $age years old<br>"; //example of integer
$height=5.8;

var_dump($height);
echo "<br>";
echo "Aasim is $height feet tall<br>"; //example of float
$ismale=true;
echo "Aasim is male: $ismale<br>"; //example of boolean

$friends=array("Madhav","Aasim","Rahul");
echo $friends[0] . "<br>"; //example of array
echo $friends[1];

?>