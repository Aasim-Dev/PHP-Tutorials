<?php

class User{
    function age($name, $age){
        echo "<h1>My name is " . $name . " and I am " . $age . " years old</h1><br>";
    }
}

//creating object of class to  call the function.
$obj = new User();

//taking a class as a callback.
$callback = [$obj, 'age'];

//creating function to take callback and parameters.
function greetings($callback, $name, $age){
    $callback($name, $age);
}

//calling the function using call_user_func.
echo call_user_func($callback, "Aasim", 20);

?>