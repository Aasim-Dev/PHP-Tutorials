<?php

echo"This is an examples of strings<br>";

$name="Aasim is the geek";
echo"The name is $name<br>";
echo strlen($name)."<br>"; // calculates the length of the string
echo strrev($name)."<br>"; // reverse the string
echo str_replace("Aasim","Madhav", $name)."<br>"; // replace the part string
echo strpos($name,"the")."<br>"; // find the position of the string
echo str_repeat($name,2)."<br>"; // repeat the string
echo str_word_count($name)."<br>";
echo strtoupper($name)."<br>";

?>