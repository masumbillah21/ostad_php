<?php
$result;
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['number']) && !empty($_POST['number'])){
    extract($_POST);

    if($number % 2 == 0){
        $result = 'Even';
    }else{
        $result = 'Odd';
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 4: Even Odd</title>

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
        <h3>Even Odd Calculator</h3>
        <div class="form">
            <form action="" method="POST">
                <label for="number">Number</label><br>
                <input type="number" name="number" id="number"> <br>
                <input type="submit" value="Calculate">
            </form>
        </div>
        <div class="result">Result: <?php echo $result; ?></div>
    </div>
</body>
</html>

