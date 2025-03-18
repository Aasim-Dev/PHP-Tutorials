<?php

function triple($n){
    return $n * 3;
}

$numbers = [1, 2, 3, 4, 5];

$tripled = array_map("triple", $numbers);

print_r($tripled);

?>