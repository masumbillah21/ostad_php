<?php
function fibonacci($n) {
    $first = 0;
    $second = 1;

    for ($i = 0; $i < $n; $i++) {
        echo $first . " ";

        $next = $first + $second;
        $first = $second;
        $second = $next;
    }
}

fibonacci(15);