<?php
//overloading method using __call() magic method
class Overloading{
    public function __call($name, $arguments){
        if ($name == 'add'){
            switch (count($arguments)){
                case 1: 
                    return "Hello, " . $arguments[0] . ".";
                case 2:
                    return "Hello, " . $arguments[0] . " and " . $arguments[1] . ".";
            }
        }
    }
}
$obj = new Overloading();
echo $obj->add('John');
echo "<br>";
echo $obj->add('John', 'Doe');
?>