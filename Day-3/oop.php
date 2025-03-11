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
        echo "The Intern is {$this->name} and he is in {$this->branch} branch";
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
    function set_branch($branch){
        $this->branch = $branch;  
        //Example of OOP, functions, Classes and Objects

    }
    public function roll($rollno){
        echo "The roll number of the student is " . $rollno;
    }
    
}

$Aasim = new student("Aasim Sanandwala", "20"); // creating an object of the class student
//$Aasim->set_name("Aasim");
//$Aasim->set_name("Aasim");
//$Aasim->set_age(20);
$Aasim->set_branch("I.T.");


echo $Aasim->get_name(); //calling the function
echo "<br>";
//echo $Aasim->get_name();
//echo "<br>";
echo $Aasim->get_age();// calling the function
echo "<br>";
echo "Example of OOP, functions, Classes and Objects<br>";
echo $Aasim->branch;
echo "<br>";
$Aasim->roll(210390116);
echo "<br>";

?>