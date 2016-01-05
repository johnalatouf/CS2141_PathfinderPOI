<?php include 'header.php';?>
	<body>
		<?php
			$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
			//check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			echo "<p>Welcome to Pathfinder POI, a tourist attraction database. Please login to participate.</p>";
			
			
			mysqli_close($conn);
			
		?>
<?php include 'footer.php';?>