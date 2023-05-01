<?php
session_start();

if (isset($_SESSION['username']))
{
    if($_SESSION['privilege']==="admin")
    {
        header("Location: admin/index.php");
    }
    else
    {
        header("Location: faculty/index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script language="javascript" type="text/javascript">
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <title>Memorandum Management</title>
    <style>
        .container{
            animation: fadeInAnimation ease 3s;
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
                <h1 class="text-center" style="color: #04293A">
                    Login
                    <i class="bi bi-box-arrow-in-right"></i>
                </h1>
            </div>
            <div class="body">
                <form class="px-4 py-3" action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3"> 
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="user_password" id="password" placeholder="Enter password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn text-white mb-2" onclick="loading()" style="background-color: #064663; width: full-width">Sign in</button>
                        <a class="btn mt-2 text-white text-center" href="./register.php">No account yet? Sign up here.</a>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>

    <script>
        function login() {
        <?php
        include_once("loading.php");
        ?>
        }
    </script>

</body>

</html>