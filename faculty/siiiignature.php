<!DOCTYPE html>
<html>
<head>
	<title>Signature</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Link to Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<body>
	<div class="container">
		<h1 class="mt-5 mb-3 text-center">Drawing Modal with Bootstrap</h1>

		<!-- Button to open the modal -->
		<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#drawing-modal">Open Drawing Modal</button>

		<!-- The modal -->
		<div class="modal fade" id="drawing-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal-label">Draw Something!</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<canvas id="canvas" width="600" height="400"></canvas>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onclick="saveImage()">Save Image</button>
					</div>
				</div>
			</div>
		</div>

		<!-- The saved image -->
		<img id="saved-image" src="" draggable="true">
	</div>

	<!-- JavaScript code -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
		var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
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
</script>
</body>
</html>
