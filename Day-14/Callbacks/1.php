<?php

function name($name){
    echo "<h1>Name is " . $name . "</h1><br>";
}
function greetname($callback, $name){
    $callback($name);
}

greetname("name", "Aasim");

?>