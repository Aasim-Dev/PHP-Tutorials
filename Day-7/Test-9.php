<?php

class Employee{
    public $name;
    public $age;
    public $salary;

    public function set_name($name){
        $this->name=$name;
    }
    public function get_name(){
        return $this->name;
    }
    public function set_age($age){
        $this->age=$age;
    }
    public function get_age(){
        return $this->age;
    }
    public function set_salary($salary){
        $this->salary=$salary;
    }
    // public function get_salary(){
    //     return $this->salary;
    // }
    public function DisplayInfo(){
        echo "Employee Name is: " . $this->name . "<br>";
        echo "Employee Age is: " . $this->age . "<br>";
        echo "Employee Salary is: " . $this->salary . "<br>";
     }
}
$a = new Employee();
$a->set_name("Aasim");
$a->set_age(20);
$a->set_salary((float)1500.35);

echo $a->get_name();
echo "<br>";
echo $a->get_age();
echo "<br>";
echo $a->salary;
echo "<br>";
$a->DisplayInfo();

?>