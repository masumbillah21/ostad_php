<?php
$result = 0;
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['temperature']) && !empty($_POST['temperature'])){
    extract($_POST);
    if($conversion == '1'){
        $result = $temperature * 1.8 + 32;
    }else{
        $result = ($temperature  - 32) * (5 / 9);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2: Temperature Conversion</title>

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
        <h3>Temperature Conversion</h3>
        <div class="form">
            <form action="" method="POST">
                <label for="temperature">Temperature</label><br>
                <input type="number" name="temperature" id="temperature"> <br>
                <label for="arithmatic">Select Conversion</label><br>
                <select name="conversion" id="conversion">
                    <option value="1">Celsius to Fahrenheit</option>
                    <option value="2">Fahrenheit to Celsius</option>
                </select><br>
                <input type="submit" value="Calculate">
            </form>
        </div>
        <div class="result">Result: <?php echo $result; ?></div>
    </div>
</body>
</html>

