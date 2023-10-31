<?php

function generatePassword($length){
    $password = "";
    $lower_case = "abcdefghijklmnopqrstuvwxyz";
    $upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $numbers = "1234567890";
    $symbols = "!@#$%^&*";

    $password .= $lower_case[rand(0, strlen($lower_case) -1)];
    $password .= $upper_case[rand(0, strlen($upper_case) -1)];
    $password .= $numbers[rand(0, strlen($numbers) -1)];
    $password .= $symbols[rand(0, strlen($symbols) -1)];

    $characters = $lower_case . $upper_case . $numbers . $symbols . $symbols;

    for($i = 0; $i < $length - 4; $i++){
        $password .= $characters[rand(0, strlen($characters) -1)];
    }

    echo str_shuffle($password);
}

generatePassword(12);