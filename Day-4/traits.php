<?php

trait student1{
    public function student1(){
        echo "The name of the student is Aasim Sanandwala";
        echo "<br>";
    }
}

trait student2{
    public function student2(){
        echo "The name of the student is Madhav Karavadiya";
        echo "<br>";
    }
}

class student{
    use student1, student2;
}
$student = new student();
$student->student1();
$student->student2();

?>