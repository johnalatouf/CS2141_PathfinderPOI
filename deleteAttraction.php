<?php
	// Start the session
	session_start();
?>
<?php include 'header.php';?>
		<?php
			
			//use a stored procedure to delete stuff
			$conn = new mysqli("localhost", "root", "root", "PathfinderPOI", "8889", "");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
			}
			$attID = floatval($_POST["attraction"]);
		
			
			
			if ($_SESSION["isAdmin"] == 1){
				
				if (!$conn->query("CALL removeAttraction($attID)")) {
					echo "CALL failed: (" . $conn->errno . ") " . $conn->error;
				} else {
					echo 'Attraction is deleted';
				}
			} else {
				echo 'You do not have permission to delete attractions';
			}
				
			mysql_close($conn);
			
		?>
<?php include 'footer.php';?>