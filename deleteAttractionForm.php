
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
				//get the attractions
				$keyQuery = "SELECT * FROM attractions";
				$keyResult = mysqli_query($conn, $keyQuery);
				if (mysqli_num_rows($keyResult) > 0) {
					while($row = mysqli_fetch_array($keyResult)) {
					$id = $row['attractionID'];
					   if (in_array($id, $attractions)) {
							//in there
						} else {
							array_push($attractions, $id);
							//print_r($attractions);
							//echo 'add<br />';
						}
					}
				}
			
				//form to delete attractions
				echo '<h2>Attractions</h2>
					<form action="deleteAttraction.php" method="post">
					<select name="attraction">';
				foreach($attractions as $att){
					$resQuery = "SELECT * FROM attractions WHERE attractionID = $att";
					$resResult = mysqli_query($conn, $resQuery);
					if (mysqli_num_rows($resResult) > 0){
						while($row = mysqli_fetch_array($resResult)){
							$attID = $row['attractionID'];
							$attName = $row['name'];
							echo '<option value='.$attID.'">'.$attName.'</option><br />';
					
						}
				
					}
			
			
				}
				echo '</select><br />
		
			<input type="submit" />
			</form>';
			
			
			//form to delete attractions
				echo '<h2>Users</h2>
					<form action="deleteUser.php" method="post">
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
				echo "User does not have admin privilages<br />";
			}
			
			
		
		
		
			mysqli_close($conn);
		
		?>
<?php include 'footer.php';?>