
<?php include 'header.php';?>
		<?php
			
			$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
			//check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			
			
			//vars for program
			$attractions = array(); //holds the attractions to display
			
			if ($_SESSION["isAdmin"] == 1){
				echo "User has admin privilages<br />";
			
				//form to view users
					echo '<h2>Users</h2>
						<form action="adminUserReviews.php" method="post">
						<select name="userID">';
					$resQuery = "SELECT * FROM users";
					$resResult = mysqli_query($conn, $resQuery);
					if (mysqli_num_rows($resResult) > 0){
						while($row = mysqli_fetch_array($resResult)){
							$userID = $row['userID'];
							echo '<option value="'.$userID.'">'.$userID.'</option><br />';
						}
					}
					echo '</select><br />
				<input type="submit" />
				</form>';
			} else {
				//form to view users
					echo '<h2>Users</h2>
						<form action="regularUserReviews.php" method="post">
						<select name="userID">';
					$resQuery = "SELECT * FROM users";
					$resResult = mysqli_query($conn, $resQuery);
					if (mysqli_num_rows($resResult) > 0){
						while($row = mysqli_fetch_array($resResult)){
							$userID = $row['userID'];
							echo '<option value="'.$userID.'">'.$userID.'</option><br />';
						}
					}
					echo '</select><br />
				<input type="submit" />
				</form>';
			}
			
			
		
		
		
			mysqli_close($conn);
		
		?>
<?php include 'footer.php';?>