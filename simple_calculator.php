<?php
$result;
if($_SERVER['REQUEST_METHOD'] == "POST" 
&& isset($_POST['first_num']) && !empty($_POST['first_num'])
&& isset($_POST['second_num']) && !empty($_POST['second_num'])){
    extract($_POST);

    switch($arithmatic){
        case "1":
            $result = $first_num + $second_num;
            break;
        case "2":
            $result = $first_num - $second_num;
            break;
        case "3":
            $result = $first_num * $second_num;
            break;
        case "4":
            $result = $first_num / $second_num;
            break;
        default:
            $result = "Invalid";
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 7: Simple Calculator</title>

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
    </style>
</head>
<body>
    <div class="container">
        <h3>Simple Calculator</h3>
        <div class="form">
            <form action="" method="POST">
                <label for="first-num">First Number</label><br>
                <input type="number" name="first_num" id="first-num"> <br>
                <label for="second-num">Second Number</label><br>
                <input type="number" name="second_num" id="second-num"> <br>
                <label for="arithmatic">Select Arithmatic</label><br>
                <select name="arithmatic" id="arithmatic">
                    <option value="1">Addition</option>
                    <option value="2">Subtraction</option>
                    <option value="3">Multiplication</option>
                    <option value="4">Division</option>
                </select>
                <input type="submit" value="Compare">
            </form>
        </div>
        <div class="result">Result: <?php echo $result; ?></div>
    </div>
</body>
</html>

