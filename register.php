<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />

    <title>Memorandum Management</title>

    <style>
        .container{
            animation: fadeInAnimation ease 2s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
        @keyframes fadeInAnimation {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body style="background-image: url( './bg.svg' ); background-repeat: no-repeat; background-size: cover";>

    <!-- Navbar -->
    <?php include("./navbar.php") ?>
    <!-- End of navbar -->

    <div class="container d-flex justify-content-md-center align-items-center vh-100">
        <div class=" text-left shadow-lg">
            <div class="header px-4"
                style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                <h1 class="text-center" style="color: #04293A" >
                    Register
                    <i class="bi bi-box-arrow-in-right"></i>
                </h1>
            </div>
            <div class="body">
                <form class="px-4 py-3" method="post">
                    <div class="mb-3">
                        <label for="userid" class="form-label">User ID</label>
                        <input type="text" class="form-control" name="userid" id="username" placeholder="Enter User ID" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm  Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-enter password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="register" class="btn btn text-white mb-2" style="background-color: #064663;">Create Account</button>
                        <a class="btn mt-2 text-white text-center" href="index.php">Already had an account? Login instead.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>