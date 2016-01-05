
<?php include 'header.php';?>
		<?php
			
			//use a stored procedure to delete stuff
			$conn = new mysqli("localhost", "root", "root", "PathfinderPOI", "8889", "");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
			}
			//$revID = intval($conn, $_POST["revID"]);
			$revID = $_GET['revID'];
		
			echo $revID . '<br />';
			
			if (!$conn->query("CALL deleteUserReview($revID)")) {
					echo "CALL failed: (" . $conn->errno . ") " . $conn->error;
			} else {
				echo 'review is deleted';
			}
				
			mysql_close($conn);
			
		?>
<?php include 'footer.php';?>