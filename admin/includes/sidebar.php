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
<body style="background-color: #ECB365">

<!-- offcanvas -->
<div
      class="offcanvas offcanvas-start sidebar-nav"
      tabindex="-1"
      id="sidebar"
      style="background-color: #041C32;"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="./index.php" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Main
              </div>
            </li>
            <li>
              <a href="./memo.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-chat-right-text"></i></span>
                <span>Create Memo</span>
              </a>
            </li>
            <li>
              <a href="./signed.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-pencil-square"></i></span>
                <span>Signed Memo</span>
              </a>
            </li>
            <li>
              <a href="./forSignature.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-pencil"></i></span>
                <span>For Signature</span>
              </a>
            </li>
            <li>
              <a href="./disseminate.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-file-earmark-arrow-up"></i></span>
                <span>Disseminate Memo</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Memorandum
              </div>
            </li>
            <li>
              <a href="./viewMemo.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book"></i></span>
                <span>View Memo</span>
              </a>
            </li>
            <li>
              <a href="./viewCalendar.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-calendar-event"></i></span>
                <span>Memo Calendar</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Others
              </div>
            </li>
            <li>
              <a href="./users.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-person-plus-fill"></i></span>
                <span>Users</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>
    
</body>
</html>