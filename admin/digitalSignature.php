<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Digital Signature</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Add Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
       
        <!-- Button to trigger the first modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Open Modal
            </button>

            <!-- First Modal -->
            <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Title</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body with Image -->
                <div class="modal-body">
                    <img src="https://templatearchive.com/wp-content/uploads/2017/08/memo-template-01.jpg" class="img-fluid" alt="Modal Image" id="imageModal">
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            <!-- Second Modal -->
            <div class="modal fade" id="secondModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Second Modal Title</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body with Canvas -->
                <div class="modal-body">
                    <canvas id="signatureCanvas" width="300" height="150" style="border: 1px solid #000;"></canvas>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSignatureBtn">Save Signature</button>
                </div>
                </div>
            </div>
            </div>

            <!-- Add Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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