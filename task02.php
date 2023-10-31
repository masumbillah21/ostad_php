<?php

$number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

function even($number)
{

    foreach ($number as $num){
        if($num % 2 != 0){
            unset($number[$num]);
        }
    }
    print_r($number);
}

even($number);