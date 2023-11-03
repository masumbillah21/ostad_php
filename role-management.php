<?php
session_start();
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
        $username = $_SESSION['username'];
        $loggedInEmail = $_SESSION['email'];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['role_update'])) {
                extract($_POST);
                $res = $helper->updateRole($loggedInEmail, $user_email, $user_role);
                $resMess = $res['message'];
                if($res['status']){
                    $msg = "<p class='text-success text-bold text-center'>$resMess</p>";
                }else{
                    $msg = "<p class='text-danger text-bold text-center'>$resMess</p>";
                }
            }else if(isset($_POST['role_del'])){
                extract($_POST);
                $res = $helper->deleteRole($loggedInEmail, $user_email);
                $resMess = $res['message'];
                if($res['status']){
                    $msg = "<p class='text-success text-bold text-center'>$resMess</p>";
                }else{
                    $msg = "<p class='text-danger text-bold text-center'>$resMess</p>";
                }
            }
        }

        $userData = $helper->getAllUserData();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                    <strong>Hi, <?php echo ucfirst($username); ?></strong>
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
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="card-header">
                            <h3>Role Managment</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                if (count($userData) > 0) {
                                    $count = 1;
                                    foreach ($userData as $email => $userInfo) {
                                        extract($userInfo);
                                        $role = ucfirst($role);
                                        $username = ucfirst($username);
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $role; ?></td>
                                            <td>
                                                <?php
                                                    if ($email != $loggedInEmail) {
                                                        echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#user-$count'>
                                                        Edit
                                                    </button>
                                                    <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#role-del-$count'>
                                                        Delete
                                                    </button>";
                                                    }
                                                ?>
                                          </td>
                                        </tr>
                                        <?php
                                        if ($email != $loggedInEmail) {
                                            ?>
                                            <div class="modal" id="user-<?php echo $count; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $email; ?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="user_email" value="<?php echo $email; ?>">
                                                                <label for="user-role" class="form-label">User Role</label>
                                                                <select class="form-control" id="user-role" name="user_role" required>
                                                                    <option value="" disabled <?php if ($role == "")
                                                                        echo "selected"; ?>>Select One</option>
                                                                    <option value="admin" <?php if ($role == "Admin")
                                                                        echo "selected"; ?>>Admin</option>
                                                                    <option value="manager" <?php if ($role == "Manager")
                                                                        echo "selected"; ?>>Manager</option>
                                                                    <option value="user" <?php if ($role == "User")
                                                                        echo "selected"; ?>>User</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" name="role_update">Update</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="role-del-<?php echo $count; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $email; ?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="user_email" value="<?php echo $email; ?>">
                                                                <p class="text-danger text-bold">Do you want to delete role?</p>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" name="role_del">Delete</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        $count++;
                                    }
                                }
                                
                                ?>
                                 <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>