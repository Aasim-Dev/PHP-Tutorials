<?php

class cont{
    const FIELD = "This is a constant field";
    public function acceptance(){
        echo self::FIELD; //self is used to access the constant field
    }
}
$goodby = new cont();
$goodby->acceptance(); //calling the function

?>