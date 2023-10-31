<?php

function allEvenNumbersUsingFor($start, $end, $step){
    for($i = $start; $i <= $end; $i += $step){
        echo $i . " ";
    }
}

allEvenNumbersUsingFor(2, 20, 2);

echo "\n";
function allEvenNumbersUsingWhile($start, $end, $step){
    while($start <= $end) {
        echo $start . " ";
        $start += $step;
    }
}

allEvenNumbersUsingWhile(2, 20, 2);

echo "\n";
function allEvenNumbersUsingDoWhile($start, $end, $step){
    do {
        echo $start . " ";
        $start += $step;
    } while ($start <= $end);
}

allEvenNumbersUsingDoWhile(2, 20, 2);