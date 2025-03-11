<?php 

class student {
    public $name;
    public $age;
    public $branch;
    public $rollno;
    function __construct($name , $age){
        echo "Example of Constructor<br>";
        $this->name = $name;
        $this->age = $age;
        //Example of Constructor 
    }
    
    function __destruct(){
        echo "<br>Example of Destructor<br>";
        echo "The Intern is " . $this->name . " and he is in" . $this->branch . " branch";
        //Example of Destructor
    }
    function get_name(){
        return $this->name;
    }
    /*function set_age($age){
        $this->age = $age;
    }*/
    function get_age(){
        return $this->age;
    }
}

$Aasim = new student("Aasim Sanandwala", "20"); // We use a class by creating an object of the class



echo $Aasim->get_name(); //calling the function
echo "<br>";
echo $Aasim->get_age(); //calling the function
echo "<br>";


?>