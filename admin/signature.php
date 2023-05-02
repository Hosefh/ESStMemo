<?php
include "../dbcon.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>For signature</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js">
  </script>

  <!-- Interact.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.11/interact.min.js"></script>

  <style>
    /* Style for the canvas */
    canvas {
      border: 1px solid #ccc;
      cursor: crosshair;
    }

    /* Style for the saved image */
    #saved-image {
      position: absolute;
      top: 20px;
      right: 20px;
      width: 200px;
      height: 200px;
      cursor: move;
    }
  </style>
</head>

<body class="fixed-left">

  <!-- Top Bar Start -->
  <?php include('includes/navbar.php'); ?>
  <!-- ========== Left Sidebar Start ========== -->
  <?php include('includes/sidebar.php'); ?>
  <!-- Left Sidebar End -->

  <main class="mt-5 pt-3 px-4">
    <div class="container-fluid">
      <!-- Button to open the modal -->
      <h1 class="mt-4 mb-3 text-left fw-bold">To Sign Memorandum</h1>
      <button type="button" class="btn btn-primary mt-4 mb-2" data-toggle="modal" data-target="#drawing-modal">Add Signature</button>
      <button type="button" class="btn btn-success mt-4 mb-2" onclick="downloadMemo()" id="saveAsImage">Save Memo</button>
      <!-- The modal -->
      <div class="modal fade" id="drawing-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-label">Draw Signature</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <canvas id="canvas" width="730" height="400"></canvas>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveImage()" data-dismiss="modal" aria-label="Close">Save Image</button>
            </div>
          </div>
        </div>
      </div>
      <div id="saveMemo" style="background-color: transparent">
        <?php
        $id = $_GET['id'];
        $edit = mysqli_query($conn, "select * from memos where id='" . $id. "'");
        $erow = mysqli_fetch_array($edit);
        echo '<div>
     <img src="data:image/jpeg;base64,' . base64_encode($erow['image']) . '" id="memoImage" class="img-fluid" />';
        echo "</div>";
        ?>
        <!-- <img src="./images/memo-template.jpg" alt="memorandum"/> -->


        <!-- The saved image -->
        <img id="saved-image" src="" draggable="true">
      </div>
      <div class="row">
        <div class="col">
          <h6 class="fw-bold pt-4">Saved Memo with signature</h6>
          <p class="text-success">Right Click to download*</P>
        </div>
        <div class="col">
          <button type="button" id="myBtn" class="btn btn-success mt-4">
            <!-- <span class="me-2"><i class="bi bi-arrow-right-circle"></i></span> -->
            Update Memo
          </button>

          <!-- Modal HTML -->
          <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Return Signed Memo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                  <form class="needs-validation" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="col-md-12 mb-2">
                        <!-- <label for="validationCustom01">Memo Title:</label> -->
                        <input type="hidden" class="form-control" id="" name="memo_name" required>
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
                    </div>
                    <div class="modal-footer">
                      <input type="reset" class="btn btn-secondary">
                      <button class="btn btn-primary">Upload</button>
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

                        $insert = $conn->query("UPDATE memos SET `image` ='$imgContent' WHERE id = ".$_GET['id']."");
                        if ($insert) {
                          echo "<script>window.location.href='forSignature.php'</script>";
                        } else {
                          echo "<script>
                                        alert('Failed');
                                        window.location.href='signature.php';
                                        </script>";
                        }
                      }
                    } else {
                      echo '<script>alert("No image data!") 
                                window.location.href="signature.php"</script>';
                    }
                  }
                  ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="output"></div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
    $(document).ready(function() {
      $("#myBtn").click(function() {
        $("#myModal").modal("toggle");
      });
    });
    // }
  </script>

  <script>
    // Get the canvas and its context
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");

    // Draw on the canvas
    var painting = false;

    function startPosition(e) {
      painting = true;
      draw(e);
    }

    function finishedPosition() {
      painting = false;
      ctx.beginPath();
    }

    function draw(e) {
      if (!painting) return;
      ctx.lineWidth = 10;
      ctx.lineCap = "round";
      ctx.strokeStyle = "black";
      ctx.lineTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
      ctx.stroke();
      ctx.beginPath();
      ctx.moveTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
    }
    // Save the image as a PNG file
    function saveImage() {
      var dataURL = canvas.toDataURL("image/png");
      document.getElementById("saved-image").src = dataURL;
    }

    // Add event listeners to the canvas
    canvas.addEventListener("mousedown", startPosition);
    canvas.addEventListener("mouseup", finishedPosition);
    canvas.addEventListener("mousemove", draw);

    // Make the saved image draggable
    dragElement(document.getElementById("saved-image"));

    // Function to make an element draggable
    function dragElement(element) {
      var pos1 = 0,
        pos2 = 0,
        pos3 = 0,
        pos4 = 0;
      element.onmousedown = dragMouseDown;

      function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        document.onmousemove = elementDrag;
      }

      function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        element.style.top = (element.offsetTop - pos2) + "px";
        element.style.left = (element.offsetLeft - pos1) + "px";
      }

      function closeDragElement() {
        document.onmouseup = null;
        document.onmousemove = null;
      }
    }
    // Make the saved image resizable
    interact('#saved-image')
      .resizable({
        edges: {
          left: true,
          right: true,
          bottom: true,
          top: true
        }
      })
      .on('resizemove', function(event) {
        var target = event.target;
        var x = (parseFloat(target.getAttribute('data-x')) || 0);
        var y = (parseFloat(target.getAttribute('data-y')) || 0);

        // update the element's style
        target.style.width = event.rect.width + 'px';
        target.style.height = event.rect.height + 'px';

        // translate when resizing from top or left edges
        x += event.deltaRect.left;
        y += event.deltaRect.top;

        target.style.webkitTransform = target.style.transform =
          'translate(' + x + 'px,' + y + 'px)';

        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
      });

    // convert signed memo as image

    // Define the function 
    // to screenshot the div
    function downloadMemo() {
      let div =
        document.getElementById('saveMemo');

      // Use the html2canvas
      // function to take a screenshot
      // and append it
      // to the output div
      html2canvas(div).then(
        function(canvas) {
          document
            .getElementById('output')
            .appendChild(canvas);
        })
    }
  </script>





  <!-- Add Signature Canvas JS
  <script>
    var canvas = document.getElementById('signatureCanvas');
    var ctx = canvas.getContext('2d');

    var isDrawing = false;
    var lastX = 0;
    var lastY = 0;

    canvas.addEventListener('mousedown', function(e) {
      isDrawing = true;
      lastX = e.offsetX;
      lastY = e.offsetY;
    });

    canvas.addEventListener('mousemove', function(e) {
      if (isDrawing) {
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
        lastX = e.offsetX;
        lastY = e.offsetY;
      }
    });

    canvas.addEventListener('mouseup', function() {
      isDrawing = false;
    });

    function saveSignature() {
      var signatureImage = canvas.toDataURL();
      // Display signature outside the modal
      var signatureContainer = document.getElementById('signatureContainer');
      var signatureImg = document.createElement('img');
      signatureImg.src = signatureImage;
      signatureContainer.appendChild(signatureImg);
      // Close the modal
      $('#myModal').modal('hide');
    }
  </script> -->

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



</body>

</html>