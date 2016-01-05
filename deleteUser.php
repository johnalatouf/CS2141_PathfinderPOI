
<?php include 'header.php';?>
		<?php
			
			//use a stored procedure to delete stuff
			$conn = new mysqli("localhost", "root", "root", "PathfinderPOI", "8889", "");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
			}
			$uID = mysqli_real_escape_string($conn, $_POST["userID"]);
		
			echo $uID;
			
			if ($_SESSION["isAdmin"] == 1){
				
				if (!$conn->query("CALL removeUser('$uID')")) {
					echo "CALL failed: (" . $conn->errno . ") " . $conn->error;
				} else {
					echo 'user is deleted';
				}
			} else {
				echo 'You do not have permission to delete users';
			}
				
			mysql_close($conn);
			
		?>
<?php include 'footer.php';?>