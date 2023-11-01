<?php

// Task 01

$studenent = ['name' => 'Alice', 'age' => 22, 'grade' => 'A'];
echo $studenent['age'];

// Task 02
echo "\n";
$studenent = ['name' => 'Alice', 'age' => 22, 'grade' => 'A'];

if (array_key_exists('grade', $studenent)) {
    echo "Found";
}else{
    echo "Not Found";
}

// Task 03
echo "\n";

$numbers = [100, 200, 50, 40, 50];

foreach ($numbers as $number) {
    echo $number . " ";
}

// Task 04
echo "\n";
$names = ['Talha', 'Afnan', 'Mashrufa', 'Zia', 'Iqbal', 'Habib', 'Airin','Moni'];
function filter($str){
    return substr($str,0, 1) === 'M';
}
$filteredNames = array_filter($names, 'filter');

foreach ($filteredNames as $name) {
    echo $name . "\n";
}


// Task 05
echo "\n";
$originalString = 'Hello, World!';

echo strrev($originalString);