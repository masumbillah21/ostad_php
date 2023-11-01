<?php

$number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

function even($number)
{
    $oddNumber = [];
    foreach ($number as $num){
        if($num % 2 != 0){
            $oddNumber[] = $num;
        }
    }
    print_r($oddNumber);
}

even($number);