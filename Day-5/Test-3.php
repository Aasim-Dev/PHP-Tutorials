<?php

// 3)  Write a PHP script to find the largest number in an array.
$numbers = [10, 55, 23, 78, 90, 4];
var_dump ($numbers);
echo (max($numbers));
echo "<br>";
//4) Write a PHP script to find the second largest number in an array.
$number = [10, 55, 23, 78, 90, 4];

function Second($arr)
{
    $size = count($arr);

    if ($size < 2) {
        return "Array should have at least two elements.";
    }
    rsort($arr);
    return $arr[1];
}

$secondLargest = Second($number);

echo "Original array: " . implode(", ", $number) . "\n";
echo "Second largest element: " . $secondLargest;


// var_dump ($number);
// function second($number){
//     $max = max($number);
//     $secondmax = 0;
//     $i=0;
    
//     for($i=$number-2; $i>=0; $i--){
//         if(){
//             $secondmax = $number[$i];
//         }
//     }
//     // foreach($number as $value){
//     //     if($value>$secondmax && $value<$max){
//     //         $secondmax = $value;
//     //     }
//     // }
//     return $secondmax;
// }
// echo second($number);
// echo "<br>";

?>