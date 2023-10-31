<?php
$grade;
$average;
$warning;

if($_SERVER['REQUEST_METHOD'] == "POST" 
&& isset($_POST['first_num']) && !empty($_POST['first_num']) 
&& isset($_POST['second_num']) && !empty($_POST['second_num'])
&& isset($_POST['third_num']) && !empty($_POST['third_num'])){
    extract($_POST);
    function calculateGrade($number){
        if($number >= 80){
            return 'A+';
        }elseif($number >= 70){
            return 'A';
        }elseif($number >= 60){
            return 'A-';
        }elseif($number >= 50){
            return 'B';
        }elseif($number >= 40){
            return 'C';
        }elseif($number >= 33){
            return 'D';
        }else{
            return 'F';
        }
    }

    if ($first_num > 100 || $second_num > 100 || $third_num > 100) {
        $warning = '<div class="red">Invalid</div>';
    } elseif ($first_num < 33 || $second_num < 33 || $third_num < 33) {
        $average = ($first_num + $second_num + $third_num) / 3;
        $grade = 'F';
    }
    else{
        $average = ($first_num + $second_num + $third_num) / 3;
        $grade = calculateGrade($average);
    }

    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 3: Grade Calculation</title>

    <style>
        .container {
            border: 1px solid #ddd;
            width: 300px;
            margin: 0 auto;
            padding: 18px;
        }

        .form label, .form input,.form select {
            font-size: 17px;
            display: inline-block;
            margin-bottom: 4px;
            width: 100%;
        }

        .form input[type=submit] {
            padding: 5px 10px;
            color: #fff;
            background-color: green;
            border: 1px solid #ddd;
        }
        .result{
            font-weight: bold;
        }
        .red{
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Grading Calculator</h3>
        <div class="form">
            <form action="" method="POST">
                <label for="first-num">First Number</label><br>
                <input type="number" name="first_num" id="first-num"> <br>
                <label for="second-num">Second Number</label><br>
                <input type="number" name="second_num" id="second-num"> <br>
                <label for="third-num">Third Number</label><br>
                <input type="number" name="third_num" id="third-num"> <br>
                <input type="submit" value="Calculate">
            </form>
        </div>
        <div class="result">Average: <?php echo $average; ?><br>Grade: <?php echo $grade; ?></div>
        <?php echo $warning; ?>
    </div>
</body>
</html>

