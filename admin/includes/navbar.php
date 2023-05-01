<?php 
session_start();
// if (isset($_SESSION['username']))
// {
// }
// else
// {
//     header('Location: ../index.php');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>

<!-- top navigation bar -->
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #041C32;">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-white fw-bold"
          href="#"
          >
          <img src="https://bisubilar.org/wp-content/uploads/2021/07/bisu-logo4mp.png" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
          BISU Memorandum Management
          </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0"></form>
          <span class="text-white fw-bold"><?php echo $_SESSION['username']; ?></span>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2 text-white"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-circle"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" style="background-color: #064663;">
                <li class="dropdown-header text-white">
                  <span class="me-2"><i class="bi bi-person-circle"></i></span>
                  Welcome <?php echo $_SESSION['username']; ?> !
                </li>
                <li>
                  <a class="dropdown-item text-white" href="./update_acc.php">
                  <span class="me-2"><i class="bi bi-gear-fill"></i></span>
                  Account Settings
                </a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item text-white" href="../logout.php">
                  <span class="me-2"><i class="bi bi-box-arrow-right"></i></span>
                    Logout</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>

    <!-- <script>
      change(){
        style="color: black;";
      }
    </script> -->
</body>
</html>