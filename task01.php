<?php
$text = "The quick brown fox jumps over the lazy dog.";

function stringModifier($strig){
    $text = strtolower($strig);

    $text = str_replace("brown","red", $text);

    echo $text;
}

stringModifier($text);