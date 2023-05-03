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
              <span><i class="bi bi-file-text-fill me-2"></i></span>Ready for Dissemination Memorandums
            </div>
            <div class="card-body">
                <!-- <button class="btn btn-primary" id="myBtn"><span
                              class="me-2"><i class="bi bi-arrow-up-right-circle"></i></span>Disseminate</button> -->

                              <!-- Modal HTML -->
                    <!-- <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
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
                                            echo "<script>window.location.href='disseminate.php'</script>";
                                        } else {
                                            echo "<script>
                                        alert('Failed');
                                        window.location.href='disseminate.php';
                                        </script>";
                                        }
                                    }
                                } else {
                                    echo '<script>alert("No image data!") 
                                window.location.href="disseminate.php"</script>';
                                }
                            }
                            ?>

                          </div>
                        </div>
                      </div>
                    </div> -->

              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Memorandum Title</th>
                      <th>Date Signed</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody style="cursor: pointer" id="myBtn">
                    <?php
                    // $sql = "SELECT m.id,m.`memo_title`, m.id, DATE(fm.`date_from`) AS date_from, DATE(fm.`date_to`) AS date_to, fm.`date_forwarded`, fm.`memo_type`,m.ready_for_forwarding FROM `final_memo` fm
                    // INNER JOIN `memos` m ON m.`id` = fm.`memo_id`
                    // INNER JOIN `forwarding_tracking` ft ON ft.`memo_id` = m.`id`
                    // WHERE m.`user_id` = '" . $_SESSION['userid'] . "' AND m.`ready_for_forwarding` = 1 AND ft.`is_signed` = 1 AND ft.`is_forwarded` = 0;";
                    $sql = "SELECT m.`id`, ft.`timestamp`,m.memo_title FROM `memos` m
                    INNER JOIN `forwarding_tracking` ft ON ft.`memo_id` = m.`id` 
                    WHERE m.`ready_for_forwarding` = 1 AND m.`user_id` ='" . $_SESSION['userid'] . "' AND ft.`is_forwarded` = 0 AND ft.`is_signed` = 1;";
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
                                  <?php echo $result['timestamp']; ?> 
                                  </td>
                                  <td>
                                    <div class="d-grid gap-2 d-md-flex">
                                    <!-- <a href="./signature.php"<?php echo $result['id']; ?> class="btn btn-primary btn-sm me-md-2"><span
                              class="me-2"><i class="bi bi-folder2-open"></i></span> View Memo</a> -->
                                        <!-- <a href="#fwd<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span
                              class="me-2"><i class="bi bi-arrow-right"></i></span> Forward
                          </a>  --> 
                                     
                                    <a href="#dis<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><span
                                          class="me-2"><i class="bi bi-arrow-up-right-circle"></i></span> Disseminate
                                      </a>
                                      <!-- <a href="#del<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span
                                          class="me-2"><i class="bi bi-trash"></i></span> Delete
                                      </a> -->
                                    </div>
                                  </td>
                                </tr>

                                <!-- for disseminate modal -->
                    <div id="dis<?php echo $result['id']; ?>" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Disseminate Memo</h5>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                          </div>
                          <div class="modal-body">

                            <form class="needs-validation" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="id_u" name="disid" value="<?php echo $result['id']; ?>" class="form-control" required>
                              <div class="form-row">
                                <div class="col-md-12 mb-2">
                                  <!-- <label for="validationCustom01">Memo Title:</label> -->
                                  <input type="text" class="form-control" value="" id="" name="memo_name" hidden>
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
                            if (isset($_POST['signatory'])) {
                              $update = $conn->query("UPDATE memos SET date_from = '".$_POST['date_from']."',date_to = '".$_POST['date_to']."', memo_type = '".$_POST['memo_type']."'  WHERE id = ".$_POST['disid']."");
                              if ($update)
                              { 
                                if ($_POST['memo_type'] == "Very Important")
                                {
                                  $query = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `memos` m 
                                  INNER JOIN `disseminate` d ON m.`id` = d.memo_id
                                  WHERE m.`memo_type` = 'Very Important' AND d.`forwarded_to` = ".$_POST['signatory']." AND 
                                  (DATE ('".$_POST['date_from']."') BETWEEN DATE(m.`date_from`) AND DATE(m.`date_to`) OR DATE('".$_POST['date_to']."') BETWEEN DATE(m.`date_from`) AND DATE(m.`date_to`));");
                                  $number = mysqli_fetch_array($query);
                                  if ($number['count'] > 0)
                                  {
                                    echo "<script>
                                    alert('User Already has Very Important Memo!');
                                    window.location.href='disseminate.php';
                                    </script>";
                                  }
                                  else
                                  {
                                    $query = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `disseminate` d WHERE d.`forwarded_to` = '".$_POST['signatory']."' AND d.`memo_id` = '".$_POST['disid']."';");
                                    $number = mysqli_fetch_array($query);
                                    if ($number['count'] == 0)
                                    {
                                      $insert = $conn->query("INSERT INTO disseminate (memo_id,forwarded_to) VALUES ('".$_POST['disid']."','".$_POST['signatory']."')");
                                      if ($insert)
                                      {
                                        echo "<script>window.location.href='disseminate.php'</script>";
                                      }
                                    }
                                    else
                                    {
                                    echo "<script>
                                    alert('Memo already disseminated to User!');
                                    window.location.href='disseminate.php';
                                    </script>";
                                    }
                                  }
                                }
                                else
                                {
                                  $query = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `disseminate` d WHERE d.`forwarded_to` = '".$_POST['signatory']."' AND d.`memo_id` = '".$_POST['disid']."';");
                                    $number = mysqli_fetch_array($query);
                                    if ($number['count'] == 0)
                                    {
                                      $insert = $conn->query("INSERT INTO disseminate (memo_id,forwarded_to) VALUES ('".$_POST['disid']."','".$_POST['signatory']."')");
                                      if ($insert)
                                      {
                                        echo "<script>window.location.href='disseminate.php'</script>";
                                      }
                                    }
                                    else
                                    {
                                    echo "<script>
                                    alert('Memo already disseminated to User!');
                                    window.location.href='disseminate.php';
                                    </script>";
                                    }
                                }
                               }
                               else
                               { 
                                echo "<script>
                                    alert('Failed');
                                    window.location.href='disseminate.php';
                                    </script>";
                               }  
                            }
                            ?>

                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- end of disseminate modal -->

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

  <!-- <script>
      function addSignatureOnClick(event) {
  // Get the image element the user clicked on
  const clickedImage = event.target;

  // Create a new canvas element to draw the signature on
  const canvas = document.createElement('canvas');
  canvas.width = clickedImage.width; 
  canvas.height = clickedImage.height;

  // Get the 2D context of the canvas
  const ctx = canvas.getContext('2d');

  // Draw the image on the canvas
  ctx.drawImage(clickedImage, 0, 0);

  // Prompt the user to enter their signature
  const signature = prompt('Please enter your signature:', '');

  // Set the initial position of the signature
  let signatureX = event.offsetX;
  let signatureY = event.offsetY;

  // Draw the signature on the canvas
  ctx.font = 'bold 15px Arial';
  ctx.fillText(signature, signatureX, signatureY);

  // Replace the clicked image with the canvas
  clickedImage.parentNode.replaceChild(canvas, clickedImage);

  // Make the canvas resizable
  const resizable = new ResizeObserver(entries => {
    const { width, height } = entries[0].contentRect;
    canvas.width = width;
    canvas.height = height;
    ctx.drawImage(clickedImage, 0, 0);
    ctx.font = 'bold 15px Arial';
    ctx.fillText(signature, signatureX, signatureY);
  });
  resizable.observe(canvas);

  // Add event listeners for dragging the signature
  let isDragging = false;
  let prevX = 0;
  let prevY = 0;

  canvas.addEventListener('mousedown', e => {
    isDragging = true;
    prevX = e.clientX;
    prevY = e.clientY;
  });

  canvas.addEventListener('mousemove', e => {
    if (isDragging) {
      const deltaX = e.clientX - prevX;
      const deltaY = e.clientY - prevY;
      signatureX += deltaX;
      signatureY += deltaY;
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.drawImage(clickedImage, 0, 0);
      ctx.font = 'bold 15px Arial';
      ctx.fillText(signature, signatureX, signatureY);
      prevX = e.clientX;
      prevY = e.clientY;
    }
  });

  canvas.addEventListener('mouseup', e => {
    isDragging = false;
  });
}

// Add a click event listener to all images
const images = document.querySelectorAll('img');
images.forEach(image => {
  image.addEventListener('click', addSignatureOnClick);
});

  </script> -->

          <!-- Script to open second modal on image click -->
          <script>
            document.getElementById('imageModal').addEventListener('click', function() {
            $('#secondModal').modal('show');
            });
            </script>

            <!-- Script for signature canvas functionality -->
            <script>
            var canvas = document.getElementById('signatureCanvas');
            var ctx = canvas.getContext('2d');
            var isDrawing = false;

            canvas.addEventListener('mousedown', function(e) {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
            });

            canvas.addEventListener('mousemove', function(e) {
            if (!isDrawing) return;
            ctx.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
            ctx.stroke();
            });

            canvas.addEventListener('mouseup', function() {
            isDrawing = false;
            });

            document.getElementById('saveSignatureBtn').addEventListener('click', function() {
            // Convert canvas to image data URL
            var dataURL = canvas.toDataURL('image/png');

            // Create a link element to download the image
            var downloadLink = document.createElement('a');
            downloadLink.href = dataURL;
            downloadLink.download = 'signature.png';

            // Trigger the download
            downloadLink.click();

            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Close the second modal
            $('#secondModal').modal('hide');
            });
          </script>

</body>

</html>