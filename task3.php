<?php

$first = 0;
$second = 1;
$count = 0;


while ($count < 10) {
    
    echo $first . " ";

    $next = $first + $second;

    $first = $second;
    $second = $next;

    if ($first > 100) {
        break;
    }

    $count++;
}