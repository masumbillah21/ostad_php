<?php

function allEvenNumbersUsingFor($start, $end, $step){
    if ($start == 1) {
        $start = $start + 1;
    }
    for($i = $start; $i <= $end; $i += $step){
        echo $i . " ";
    }
}

allEvenNumbersUsingFor(1, 20, 2);

echo "\n";
function allEvenNumbersUsingWhile($start, $end, $step){
    if ($start == 1) {
        $start = $start + 1;
    }
    while($start <= $end) {
        echo $start . " ";
        $start += $step;
    }
}

allEvenNumbersUsingWhile(1, 20, 2);

echo "\n";
function allEvenNumbersUsingDoWhile($start, $end, $step){
    if ($start == 1) {
        $start = $start + 1;
    }
    do {
        echo $start . " ";
        $start += $step;
    } while ($start <= $end);
}

allEvenNumbersUsingDoWhile(1, 20, 2);