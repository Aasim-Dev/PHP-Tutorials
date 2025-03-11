<?php

echo"This is an examples of operators<br>";

/*Arithmetic Operators
Logical Operators
Assignment Operators
Comparison Operators
Increment/Decrement Operators
Conditional Assignment Operators*/echo "<br>";

//Arithmetic Operators
$a=6;
$b= 7;
echo "This is examples of Arithmetic Operators<br>";
echo "The Result of a+b is ".($a+$b)."<br>"; 
echo "The Result of a-b is ".($a-$b)."<br>";
echo "The Result of a*b is ".($a*$b)."<br>";
echo "The Result of a/b is ".($a/$b)."<br>";
echo var_dump($a/$b)."<br>"; //gives the datatype of the result
echo "The Result of a%b is ".($a%$b)."<br>";
echo "The Result of a**b is ".($a**$b)."<br>";
echo "<br>";

//Assignments Operators
echo "This is examples of Assignments Operators<br>";
echo"The value of a+=6 is ".($a+=6)."<br>";
echo"The value of a-=6 is ".($a-=6)."<br>";
echo "The value of a*=6 is ".($a*=6)."<br>";
echo "The value of a/=6 is ".($a/=6)."<br>";
echo "The value of a%=6 is ".($a%=6)."<br>";
echo "The value of a**=6 is ".($a**=6)."<br>";
echo "<br>";

//Comparison Operators
echo "This is examples of Comparison Operators<br>";
echo "The value of a==b is " . ($a==$b)."<br>";
echo var_dump($a==$b)."<br>";
echo "The value of a!=b is " . ($a!=$b)."<br>";
echo "The value of a>=b is " . ($a>=$b)."<br>";
echo var_dump($a>=$b)."<br>";
echo "The value of a<=b is " . ($a<=$b)."<br>";
echo "The value of a>b is " . ($a>$b)."<br>";
echo var_dump($a>$b)."<br>";
echo "The value of a<b is " . ($a<$b)."<br>";
echo "<br>";

//Logical Operators
echo "This is examples of Logical Operators<br>";
echo "The value of a and b is " . ($a && $b)."<br>";
echo var_dump($a&&$b)."<br>";
echo "The value of a or b is " . ($a || $b)."<br>";
echo "<br>";

echo "The value of increment of a is " . ($a++)."<br>";
echo "The value of decrement of a is " . $a--."<br>";
echo "The value of increment of a is " . ++$a."<br>";
echo "The value of decrement of a is " . --$a."<br>";
echo "<br>";




?>