<?php

final class car{
    public function drive($name){
        echo "I am driving a car which name is " . $name;
    }
}
$car = new car();
$car->drive("Avanti");


?>