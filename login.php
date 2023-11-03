<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


$errEmail = '';
$errPassword = '';
$err = 0;
$msg = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once("./_helper.php");
    $helper = new Helper();
    $email = "";
    $password = "";

    if (isset($_POST['user_email']) 
    && !empty(trim($_POST['user_email'])) 
    && trim($_POST['user_email']) != null) {
        $email = htmlspecialchars(trim($_POST['user_email']));
    }else{
        $errEmail = "Email is empty.";
        $err++;
    }

    if (isset($_POST['user_password']) 
        && !empty(trim($_POST['user_password'])) 
        && trim($_POST['user_password']) != null) {
            $password = htmlspecialchars(trim($_POST['user_password']));
    }else{
        $errPassword = "Password is empty.";
        $err++;
    }

    if ($err == 0) {
        $res = $helper->verifyLogin($email, $password); 
        if($res['status']){
            $role = $res['message'][$email]['role'];
            $_SESSION['username'] = $res['message'][$email]['username'];
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header('Location: ./index.php');
                exit();
            }else if($role == ""){
                header('Location: ./index-guest.php');
                exit();
            }else{
                header('Location: ./index-'.$role.'.php');
                exit();
            }

        }else{
            $msg = $res['message'];
            echo $password;
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
                        <h2>Login</h2>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <p class="text-danger"><?php echo $msg; ?></p>
                            <div class="mb-3">
                                <label for="user-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="user_email" id="user-email">
                                <p class="text-danger"><?php echo $errEmail; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="user-password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="user_password" id="user-password">
                                <p class="text-danger"><?php echo $errPassword; ?></p>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                        
                    </form>
                </div>
                <p class="text-center">
                    <a href="signup.php">Don't have account? Sign Up</a>
                </p>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>