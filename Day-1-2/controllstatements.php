<?php

echo "<h1>This is an examples of control statements</h1><br>";

//If else statement

$age=(int)readline("Enter your age: ");
echo"The age entered is $age<br>";
function vote(){
    $age=20;
    if($age>18){
        echo "You are allowed to Vote<br>";
    }
    elseif($age> 20){
        echo "You are allowed to Vote<br>";
    }
    elseif($age> 17){
        echo "You are not allowed to Vote<br>";
    }
    
    else{
        echo "You are not allowed to Vote<br>";
    }
    echo "<br>";
}
vote();



$TEXT = ARRAY('php','js','html','java');

foreach($TEXT AS $LANG){

    if($LANG== 'php' ){  
        echo "PHP is a good language language<br>";
    }
elseif($LANG== "js"){
    echo "JS is a client side language<br>";
    }

    else{
        echo "JS is a client side language<br>";
    }
}

//Switch statement
function drive($age){
    switch($age){
        case 18:
            echo "You are allowed for Driving<br>";
            break;
        case 20:
            echo "Your age is sufficient for driving<br>";
            break;
        case 17:
            echo "You are can't Drive<br>";
            break;
        default :
            echo "You are not allowed to Vote<br>";
            break;
    }
    echo "<br>";
}
drive($age);


// For Loops
$i=0;
for($i=5;$i>=1;$i--){
    for($j=1;$j<=5;$j++){
        echo "* ";
    }
    echo "<br>" ;
    
}

//While Loops
echo "<br>" ;
while($age< 5){
    echo "The value of i is $i<br>";
    echo "Now the child can go to school<br>";
    $age++;
}
echo "<br>" ;
function some($i=1){
    while ($i < 7) {
        
        if ($i == 3) break;
        echo $i;
        
        $i++;
        echo "the child should be in std 2 <br>";
      }
}
echo some();
echo "<br>";
//Do while loop
do{
    echo "The value of i is $i<br>";
    echo "Now the child can go to school<br>";
    $age++;
}while($age<5);
echo "<br>";

//foreach loop
$members = array("Aasim"=>"20", "Madhav"=>"21", "Harsh"=>"43");

foreach ($members as $x => $y) {
  echo "$x : $y <br>";
}

?>