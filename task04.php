<?php

$studentGrades = [
    "std1" => ['Math' => 60, 'English' => 55, 'Science' => 65],
    "std2" => ['Math' => 70, 'English' => 65, 'Science' => 75],
    "std3" => ['Math' => 80, 'English' => 75, 'Science' => 85],
];

function gradeCalculation($studentInfo){
    $grades = [
        "A+" => 80,
        "A" => 70,
        "A-" => 60,
        "B" => 50,
        "C" => 40,
        "D" => 33,
    ];
    $letterGrade = "";
    foreach ($studentInfo as $std => $sub) {
        $total = array_sum($sub);
        $averageMark = $total / count($sub);

        foreach ($grades as $grade => $mark) {
            if ($averageMark >= $mark) {
                $letterGrade = $grade;
                break;
            }
        }

        echo "Student: " . $std . ", Garde: " . $letterGrade . "\n";
    }
}

gradeCalculation($studentGrades);