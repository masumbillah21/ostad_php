<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errUser = '';
$errEmail = '';
$errPassword = '';
$err = 0;
$msg = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once("./_helper.php");
    $helper = new Helper();
    $username = "";
    $email = "";
    $password = "";

    if (isset($_POST['user_name'])) {
        $res = $helper->validateUsername($_POST['user_name']);
            if ($res['status']) {
                $username = $res['message'];
            }else{
                $errUser = $res['message'];
                $err++;
            }
    }else{
        $errUser = "Username is empty.";
        $err++;
    }

    if (isset($_POST['user_email'])) {
        $res = $helper->validateEmail($_POST['user_email']);
        if ($res['status']) {
            $email = $res['message'];
        }else{
            $errEmail = $res['message'];
            $err++;
        }
    }else{
        $errEmail = "Email is empty.";
        $err++;
    }

    if (isset($_POST['user_password'])) {
            $res = $helper->validatePassword($_POST['user_password']);

            if ($res['status']) {
                $password = $res['message'];
            }else{
                $errPassword = $res['message'];
                $err++;
            }
    }else{
        $errPassword = "Password is empty.";
        $err++;
    }

    if ($err == 0) {
        $res = $helper->signUp($username, $email, $password);
        if($res['status']){
            $msg = '<p class="text-success text-center">'.$res['message'].'</p>';
        }else{
            $msg = '<p class="text-danger text-center">'.$res['message'].'</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h2>Sign Up</h2>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <?php echo $msg; ?>
                            <div class="mb-3">
                                <label for="user-name" class="form-label">Usernmae</label>
                                <input type="text" class="form-control" name="user_name" id="user-name" required>
                                <p class="text-danger"><?php echo $errUser; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="user-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="user_email" id="user-email" required>
                                <p class="text-danger"><?php echo $errEmail; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="user-password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="user_password" id="user-password" required>
                                <p class="mt-1">Password must be at least 8 characters & Password should contain upper letter, lower letter, number & special character.</p>
                                <p class="text-danger"><?php echo $errPassword; ?></p>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </form>
                </div>
                <p class="text-center">
                    <a href="login.php">Already have account? Login</a>
                </p>
                
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>