<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" value="notranslate">
    <title>Calendar</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		td {
			height: 100px;
			text-align: center;
			vertical-align: middle;
			border: 1px solid black;
		}
        .today {
            background-color: #04293A;
        }
	</style>

</head>

<body class="fixed-left">

    <!-- Top Bar Start -->
    <?php include('./includes/navbar.php'); ?>
    <!-- ========== Left Sidebar Start ========== -->
    <?php include('./includes/sidebar.php'); ?>
    <!-- Left Sidebar End -->

    <main class="mt-5 pt-3 px-4">
    <div class="container">
    <div class="row">
        <div class="col text-left">
            <h1 class="mt-4 fw-bold">Memorandum Calendar</h1>
        </div>
        <!-- <div class="col text-right">
         <button class="btn btn-success mt-4" id="myBtn">
            <span class="me-2">
                <i class="bi bi-arrow-up-right-circle"></i>
            </span>Disseminate Memo</button>
        </div> -->
    </div>
    <!-- Start of Forward Memo Modal -->
     <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Disseminate Memo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">

                          <form class="needs-validation" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="id_u" name="editid" value="<?php echo $result['memo_title']; ?>" class="form-control" required>
                              <div class="form-row">
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Memo Title:</label>
                                  <input type="text" class="form-control" value="" id="" name="memo_name" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Forward To:</label>
                                  <input type="number" class="form-control" id="" name="signatory" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Date From:</label>
                                  <input type="date" class="form-control" id="" name="date_from" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Date To:</label>
                                  <input type="date" class="form-control" id="" name="date_to" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Select a file:</label>
                                  <input type="file" class="form-control" id="" name="image" value="" accept=".jpg,.jpeg,.png" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                <label for="inputGroupSelect01">Memo Type:</label>
                                <select class="form-select" id="inputGroupSelect01" name="memo_type">
                                    <option selected>Choose...</option>
                                    <option value="Very Important">Very Important</option>
                                    <option value="Important">Important</option>
                                    <option value="Less Important">Less Important</option>
                                </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="reset" class="btn btn-secondary">
                                <button class="btn btn-primary">Send</button>
                              </div>  
                            </form>
                            <?php
                            if (isset($_POST['memo_name'])) {
                                if (!empty($_FILES["image"]["name"])) {
                                    $fileName = basename($_FILES["image"]["name"]);
                                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                                    // Allow certain file formats 
                                    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                                    if (in_array($fileType, $allowTypes)) {
                                        $image = $_FILES['image']['tmp_name'];
                                        $imgContent = addslashes(file_get_contents($image));

                                        $insert = $conn->query("INSERT into `final_memo` (memo_title, user_id, date_from, date_to,`image`, memo_type) VALUES ('" . $_POST['memo_name'] . "', '" . $_POST['signatory'] . "', '" . $_POST['date_from'] . "', '" . $_POST['date_to'] . "','$imgContent', '" . $_POST['memo_type'] . "')");
                                        if ($insert) {
                                            echo "<script>window.location.href='viewCalendar.php'</script>";
                                        } else {
                                            echo "<script>
                                        alert('Failed');
                                        window.location.href='viewCalendar.php';
                                        </script>";
                                        }
                                    }
                                } else {
                                    echo '<script>alert("No image data!") 
                                window.location.href="viewCalendar.php"</script>';
                                }
                            }
                            ?>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End of Forward Modal -->
    <div class="container mt-4">
        <button class="btn btn-secondary shadow-lg" onclick="prevMonth()">&lt;</button>
        <button class="btn btn-secondary float-right shadow-lg" onclick="nextMonth()">&gt;</button> 
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 shadow-lg">
                <h3 class="text-center" id="month-year"></h3>
                <table class="table table-bordered table-striped mt-4 ">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center">Sun</th>
                            <th class="text-center">Mon</th>
                            <th class="text-center">Tue</th>
                            <th class="text-center">Wed</th>
                            <th class="text-center">Thu</th>
                            <th class="text-center">Fri</th>
                            <th class="text-center">Sat</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body">
                    </tbody>
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
	</div>
    </main>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
    // function modalOpen(){
    $(document).ready(function () {
      $("#myBtn").click(function () {
        $("#myModal").modal("toggle");
      });
    });
  // }
  </script>
	<script>
        var currentDate = new Date();
        var currentMonth = currentDate.getMonth();
        var currentYear = currentDate.getFullYear();

        function generateCalendar() {
            var calendarBody = document.getElementById('calendar-body');
            var monthYear = document.getElementById('month-year');
            calendarBody.innerHTML = '';
            var firstDay = new Date(currentYear, currentMonth, 1).getDay();
            var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            var date = 1;
            for (var i = 0; i < 6; i++) {
                var row = document.createElement('tr');
                for (var j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        var cell = document.createElement('td');
                        row.appendChild(cell);
                    } else if (date > daysInMonth) {
                        break;
                    } else {
                        var cell = document.createElement('td');
                        cell.textContent = date;
                        if (currentMonth === currentDate.getMonth() && currentYear === currentDate.getFullYear() && date === currentDate.getDate()) {
                            cell.classList.add('today');
                        }
                        row.appendChild(cell);
                        date++;
                    }
                }
                calendarBody.appendChild(row);
            }
            monthYear.textContent = getMonthName(currentMonth) + ' ' + currentYear;
        }

        function getMonthName(month) {
            var monthNames = [
                'January', 'February', 'March',
                'April', 'May', 'June',
                'July', 'August', 'September',
                'October', 'November', 'December'
            ];
            return monthNames[month];
        }

        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
        }
        generateCalendar();
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar();
    }

    // Call the generateCalendar function to display the initial calendar
    generateCalendar();
</script>

</body>

</html>