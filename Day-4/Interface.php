<?php

interface car{
    public function carname();
}
class Volvo implements car{
    public function carname(){
        echo "The name of the car is Volvo";
    }
}
class Hyundai implements car{
    public function carname(){
        echo "The name of the car is Hyundai";
    }
}
$volvo = new Volvo();
$hyundai = new Hyundai();
$cars = array($volvo, $hyundai);

foreach ($cars as $car){
    $car->carname();
    echo "<br>";
}

?>