<?php 

class student{
    public $name;
    protected $age;
    private $roll;

    public function __construct($name, $age, $roll){
        $this->name = $name;
        $this->age = $age;
        $this->roll + $roll;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_age(){
        return $this->age;
    }
    public function get_roll(){
        return $this->roll;
    }
    public function displayInfo(){
        echo "Name: " . $this->name . "<br>";
        echo "Age: " . $this->age . "<br>";
        echo "Roll: " . $this->roll . "<br>";
    }
}
$val = new student("Mashav", 21, 210390116);
echo "Accessing public property: " . $val->name ."<br>";
/*echo "Accessing protected property: " . $val->age ."<br>"; //this will give error
echo "Accessing private property: " . $val->roll ."<br>"; //this will give error*/
echo "Roll:" . $val->get_roll() . "<br>";
$val->displayInfo();
?>