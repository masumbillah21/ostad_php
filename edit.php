<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$userData = [];
$msg = '';
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}else{
    if($_SESSION['role'] == ""){
        header("Location: ./index-guest.php");
        exit();
    }
    else if($_SESSION['role'] != 'admin'){
        header("Location: ./index-".$_SESSION['role'].".php");
        exit();
    }else{
        require_once("./_helper.php");
        $helper = new Helper();
        $authUser = $_SESSION['username'];
        $loggedInEmail = $_SESSION['email'];
        
        // Field Error Variables
        $errUser = '';
        $errEmail = '';
        $errPassword = '';
        $err = 0;
        $msg = "";

        //Form Variables
        $email = '';
        $username = '';
        $userrole = '';

        //Page essential vaiables
        $title = 'Add User';
        $button_name = 'add_new';
        $button_text = 'Create User';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user_name;
            $user_role = isset($_POST['user_role']) ? $_POST['user_role'] : "";
            $user_email;
            $password;

            if (isset($_POST['user_name'])) {
                $res = $helper->validateUsername($_POST['user_name']);
                    if ($res['status']) {
                        $user_name = $res['message'];
                    }else{
                        $errUser = $res['message'];
                        $err++;
                    }
            }else{
                $errUser = "Username is empty.";
                $err++;
            }
            
            if (isset($_POST['add_new'])) {

                if (isset($_POST['user_email'])) {
                    $res = $helper->validateEmail($_POST['user_email']);
                    if ($res['status']) {
                        $user_email = $res['message'];
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

                if($err == 0){
                    $res = $helper->createNewUser($loggedInEmail, $user_name, $user_email, $password, $user_role);
                    $resMess = $res['message'];
                    if($res['status']){
                        $msg = "<p class='text-success text-bold text-center'>$resMess</p>";
                    }else{
                        $msg = "<p class='text-danger text-bold text-center'>$resMess</p>";
                    }
                }
            }else if(isset($_POST['edit_user'])){
                if (!empty($_POST['password'])) {
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
                }else{
                    $password = '';
                }
                if($err == 0){
                    $user_email = $_POST['user_email'];
                    $user_role = $_POST['user_role'];
                    $res = $helper->updateUser($loggedInEmail, $user_email, $user_name, $password, $user_role);
                    $resMess = $res['message'];
                    if($res['status']){
                        $msg = "<p class='text-success text-bold text-center'>$resMess</p>";
                    }else{
                        $msg = "<p class='text-danger text-bold text-center'>$resMess</p>";
                    }
                }
            }
        }
        if (isset($_GET["email"]) && !empty($_GET['email'])) {
            $email = $_GET['email'];
            $userData = $helper->getSingleUserData($_GET["email"]);

            if (count($userData) > 0) {
                $username = $userData['username'];
                $userrole = $userData['role'];

                $title = 'Edit User';
                $button_name = 'edit_user';
                $button_text = 'Update User';

            }else{
                $email = "";
                $msg = '<p class="bg-danger text-white p-2 font-weight-bold text-center">User not found.</p>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Batch 2</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="./role-management.php">Role Management</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <strong>Hi, <?php echo ucfirst($authUser); ?></strong>
                    <a href="./logout.php" class="btn btn-danger text-white">Logout</a>
                </span>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <a href="./role-management.php" class="btn btn-primary my-2">< Back</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo $title; ?></h3>
                        </div>
                        <form action="" method="POST">
                            <div class="card-body">
                                <?php echo $msg; ?>
                                <div class="mb-3">
                                    <label for="user-name" class="form-label">Usernmae</label>
                                    <input type="text" class="form-control" name="user_name" id="user-name" value="<?php echo $username; ?>" required>
                                    <p class="text-danger"><?php echo $errUser; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="user-email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="user_email" id="user-email" value="<?php echo $email; ?>" <?php if(!empty($email)) echo 'readonly' ?> required>
                                    <p class="text-danger"><?php echo $errEmail; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="user-password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="user_password" id="user-password" <?php if ($button_name == 'add_new')
                                        echo "required"; ?>>
                                    <p class="mt-1">Password must be at least 8 characters & Password should contain upper letter, lower letter, number & special character.</p>
                                    <p class="text-danger"><?php echo $errPassword; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="user-role" class="form-label">User Role</label>
                                    <select class="form-control" id="user-role" name="user_role">
                                        <option value="" disabled <?php if ($userrole == "")
                                            echo "selected"; ?>>Select One</option>
                                        <option value="admin" <?php if ($userrole == "admin")
                                            echo "selected"; ?>>Admin</option>
                                        <option value="manager" <?php if ($userrole == "manager")
                                            echo "selected"; ?>>Manager</option>
                                        <option value="user" <?php if ($userrole == "user")
                                            echo "selected"; ?>>User</option>
                                    </select>
                                    <p class="text-danger"><?php echo $errPassword; ?></p>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary" name="<?php echo $button_name; ?>"><?php echo $button_text; ?></button>
                                <button type="reset" class="btn btn-danger">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>