<?php

$studentGrades = [
    "std1" => ['Math' => 60, 'English' => 55, 'Science' => 65],
    "std2" => ['Math' => 70, 'English' => 65, 'Science' => 75],
    "std3" => ['Math' => 80, 'English' => 75, 'Science' => 85],
];

function gradeCalculation($studentInfo){
    foreach ($studentInfo as $std => $sub) {
        $total = array_sum($sub);
        $averageGrade = $total / count($sub);

        echo "Student: " . $std . ", Average Garde: " . $averageGrade . "\n";
    }
}

gradeCalculation($studentGrades);