<?php

function familyName($fname) {
  echo "$fname JustSaying.<br>";
}

familyName("Jani");
familyName("Hege");
familyName("Stale");
familyName("Kai Jim");
familyName("Borge");    
echo"<br>";

function sum($x, $y) {
    $z = $x + $y;
    return $z;
}
  
echo "5 + 10 = " . sum(5, 10) . "<br>";
echo "7 + 13 = " . sum(7, 13) . "<br>";
echo "2 + 4 = " . sum(2, 4); 
echo"<br>";

function processMarks($marksArray){
    $sum = 0;
    $i=0;
    foreach($marksArray as $value){
        $sum += $value;
        $i++;
    }
    return $value/$i;
}
$aasim = array(20,30,40,50,60);
$sumMarks = processMarks($aasim);
echo "The sum of marks is $sumMarks";
echo"<br>";


?>