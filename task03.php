<?php

$grades = [85, 92, 78, 88, 95];

function shorGradesDesc($array){
    rsort($array);

    print_r($array);
}

shorGradesDesc($grades);