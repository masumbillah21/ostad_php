<?php
session_start();

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
        $username = $_SESSION['username'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                    <strong>Hi, <?php echo $username ; ?></strong>
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
                    <h2>Welcome to Admin Dashbaord</h2>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>