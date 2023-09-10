<body>
	<h1>GeeksforGeeks</h1>
	<h3>Create popup box using HTML and CSS</h3>
	<button id="myButton">
		Click me
	</button>
	<div id="myPopup" class="popup">
		<div class="popup-content">
			<h1 style="color:green;">
				GeekforGeeks !
			</h1>
			<p>This is a popup box!</p>
			<button id="closePopup">
				Close
			</button>
		</div>
	</div>
	<script>
		myButton.addEventListener("click", function () {
			myPopup.classList.add("show");
		});
		closePopup.addEventListener("click", function () {
			myPopup.classList.remove("show");
		});
		window.addEventListener("click", function (event) {
			if (event.target == myPopup) {
				myPopup.classList.remove("show");
			}
		});
	</script>
</body>