<?php
$result;
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['temperature']) && !empty($_POST['temperature'])){
    extract($_POST);
    
    if($temperature >= 20){
        $result = "It's warm";
    } elseif ($temperature >= 10) {
        $result = "It's cool";
    }
    else{
        $result = "It's freezing";
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 5: Weather Report</title>

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
        <h3>Weather Report</h3>
        <div class="form">
            <form action="" method="POST">
                <label for="temperature">Temperature</label><br>
                <input type="number" name="temperature" id="temperature"> <br>
                <input type="submit" value="Get Report">
            </form>
        </div>
        <div class="result">Result: <?php echo $result; ?></div>
    </div>
</body>
</html>

