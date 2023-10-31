<?php

// 1. Create a PHP script using a loop to print all even numbers between 1 and 10.
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        echo $i . " ";
    }

}

// 2. Declare a function named 'greet' that takes one parameter, 'name'. 
// The function should print a greeting message with the name passed to it when it is called.

function greet($name){
    echo "Hello " . $name .", How are you?";
}

echo "\n";
greet("Masum");

// 3. Create a recursive function called 'factorial' in PHP that calculates and returns the factorial of a number.

function factorial($number) {
    if ($number <= 1) {
        return 1;
    } else {
        return $number * factorial($number - 1);
    }
}

$number = 5;
$result = factorial($number);
echo "\nThe factorial of $number is: $result";


// 4. Write a PHP function named 'fibonacci' that prints the Fibonacci series up to 10 numbers.
function fibonacci($number) {
    $first = 0;
    $second = 1;

    for ($i = 0; $i < $number; $i++) {
        echo $first . " ";

        $next = $first + $second;
        $first = $second;
        $second = $next;
    }
}
echo "\n";
fibonacci(10);