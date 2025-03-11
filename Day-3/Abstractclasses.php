<?php

abstract class standard{
    public $name;
   /* public function __constructor($name){
        $this->name = $name; //It is use for the constructor
    }*/
    abstract protected function std($name);
}

Class fifth extends standard{
    public function std($name, $age=20){
        echo "Hello, I am " . $name . " and my age is " . $age . " and I am in class fifth";
    }
}

class tenth extends standard{
    public function std($name){
        echo "Hello, I am " . $name . " and I am in class tenth";
    }
}

class twelth extends standard{
    public function std($name){
        echo "Hello, I am " . $name . " and I am in class twelth";
    }
}

$fifth = new fifth();
$fifth->std("Aasim");
echo "<br>";

$tenth = new tenth();
$tenth->std("Madhav");
echo "<br>";

$twelth = new twelth();
$twelth->std("Harsh");

?>