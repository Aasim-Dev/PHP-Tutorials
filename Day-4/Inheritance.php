<?php

class car{
    public $name;
    public $color;
    public function carname($name, $color){
        echo "The name of the car is " . $name . " and the color of the car is " . $color;
    }
}
class merc extends car{
    public function carname($name, $color){
        echo "The name of the car is " . $name . " and the color of the car is " . $color;
    }
}
class bugatti extends car{
    public function carname($name, $color){
        echo "The name of the car is " . $name . " and the color of the car is " . $color;
    }
}
$merc =new merc();
$merc->carname("Mercedes", "Black");
echo "<br>";
$bugatti= new bugatti();
$bugatti->carname("Chiron", "Blue");
echo "<br>";

?>