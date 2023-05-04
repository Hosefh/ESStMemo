<?php
include "../dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google" value="notranslate">
  <title>Memorandum Management</title>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
</head>

<body class="fixed-left">

  <!-- Top Bar Start -->
  <?php include('includes/navbar.php'); ?>
  <!-- ========== Left Sidebar Start ========== -->
  <?php include('includes/sidebar.php'); ?>
  <!-- Left Sidebar End -->

  <main class="mt-5 pt-3 px-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-file-text-fill me-2"></i></span>Disseminated Memorandums
            </div>
            <form class="row g-3 p-2">
                <div class="col-auto">
                    <label for="inputPassword2" class="visually-hidden">Password</label>
                    <input type="text" class="form-control" id="search" placeholder="Search Memo">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Search</button>
                </div>
            </form>
            <div class="card-body">
              <div class="table-responsive">
                <table id="myTable" class="table table-hover data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Memorandum Title</th>
                      <th>Memo Type</th>
                      <th>Forwarded to</th>
                      <th>Date Disseminated</th>
                      <th>isRecieved?</th>
                    </tr>
                  </thead>
                  <tbody style="cursor: pointer" id="myBtn">
                    <?php
                    // $sql = "SELECT m.id,m.`memo_title`, m.id, DATE(fm.`date_from`) AS date_from, DATE(fm.`date_to`) AS date_to, fm.`date_forwarded`, fm.`memo_type`,m.ready_for_forwarding FROM `final_memo` fm
                    // INNER JOIN `memos` m ON m.`id` = fm.`memo_id`
                    // INNER JOIN `forwarding_tracking` ft ON ft.`memo_id` = m.`id`
                    // WHERE m.`user_id` = '" . $_SESSION['userid'] . "' AND m.`ready_for_forwarding` = 1 AND ft.`is_signed` = 1 AND ft.`is_forwarded` = 0;";
                    // $sql = "SELECT m.`id`, DATE(ft.`timestamp`) as `timestamp`,m.memo_title, m.`memo_type`, m.`user_id` FROM `memos` m
                    // INNER JOIN `forwarding_tracking` ft ON ft.`memo_id` = m.`id` 
                    // WHERE m.`ready_for_forwarding` = 1 AND m.`user_id` ='" . $_SESSION['userid'] . "' AND ft.`is_forwarded` = 0 AND ft.`is_signed` = 1;";
                    $sql = "SELECT m.`memo_title`, m.`memo_type`, DATE(d.`transdate`) as `timestamp`, d.`forwarded_to`,d.`received` FROM `disseminate` d 
                    INNER JOIN `memos` m ON m.`id` = d.`memo_id`;";
                    $actresult = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($actresult)) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $result['memo_title']; ?>
                          </td>
                          <!-- <td> -->
                            <!-- <span class="badge bg-warning">Important</span> -->
                            <?php
                            // if ($result['ready_for_forwarding'] == 1)
                            // {
                            //   echo "Ready for Dissiminsation"
                            // }
                            // $type = $result['memo_type'];
                            // if ($type == 'Very Important') {
                            //     echo '<span class="badge bg-danger">Very Important</span>';
                            // } else if ($type == 'Important') {
                            //     echo '<span class="badge bg-warning">Important</span>';
                            // } else {
                            //     echo '<span class="badge bg-success">Less Important</span>';
                            // }
                            ?>
                          <!-- </td> -->
                          <td>
                          <?php
                          $type = $result['memo_type'];
                          if ($type == 'Very Important') {
                              echo '<span class="badge bg-danger">Very Important</span>';
                          } else if ($type == 'Important') {
                              echo '<span class="badge bg-warning">Important</span>';
                          } else {
                              echo '<span class="badge bg-success">Less Important</span>';
                          }
                          ?>
                          </td>
                          <td>
                          <?php echo $result['forwarded_to']; ?>
                          </td>
                          <td>
                          <?php echo $result['timestamp']; ?> 
                          </td>
                          <td>
                            <?php 
                            if ($result['received'])
                            { echo "RECEIVED!";}
                            else { echo "Not Received!";}
                            ?>
                          </td>
                        </tr>
                                <!-- start of info modal -->
                                <div id="info<?php echo $result['id']; ?>" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Disseminate Memo</h5>
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                            <div class="col">Amazing</div>
                                            <div class="col">Amazing2</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- end of info modal -->
                    <?php } ?>
                  </tbody>
                  <tfoot></tfoot>
                </table>
              </div>
            </div>
          </div>
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
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>

</body>

</html>