
	</div>
	</div>
	<div id="footer"><p>
	<?php
	
		 $conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
		//check connection
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$uid = $_SESSION["userID"];
		$sqlQuery = "SELECT * FROM users WHERE userID='$uid'";
		$result = mysqli_query($conn, $sqlQuery);
		if (mysqli_num_rows($result) > 0) {
			//output
			while($row = mysqli_fetch_array($result)) {
				echo 'Logged in as '. $row['name'];
			}
		} else {
			echo 'Not logged in';
		}
		
		mysqli_close($conn);
	
	?>
	
	 </p></div>
	</body>
</html>