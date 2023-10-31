<?php

function generatePassword($length){
    $password = "";
    $lower_case = "abcdefghijklmnopqrstuvwxyz";
    $upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $numbers = "1234567890";
    $symbols = "!@#$%^&*";

    for($i = 0; $i < ceil($length / 4); $i++){
        $password .= $lower_case[rand(0, strlen($lower_case) -1)];
        $password .= $upper_case[rand(0, strlen($upper_case) -1)];
        $password .= $numbers[rand(0, strlen($numbers) -1)];
        $password .= $symbols[rand(0, strlen($symbols) -1)];
    }

    echo str_shuffle($password);
}

generatePassword(12);