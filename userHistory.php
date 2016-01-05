
<?php include 'header.php';?>
		<?php
			
			$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
			//check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			//user ID
			$userID = $_SESSION["userID"];
			
			echo '<h2>'.$userID.'\'s Travel Log</h2>';
		
			echo '<div id="user_reviews">';
			$reviewsQuery = "SELECT * FROM user_history WHERE userID = '$userID' ORDER BY date_visited";
			$reviewsResult = mysqli_query($conn, $reviewsQuery);
			if (mysqli_num_rows($reviewsResult) > 0) {
				//already rating
				while($row = mysqli_fetch_array($reviewsResult)){
					$date_added = $row['date_entered'];
					$date_visited = $row['date_visited'];
					$attractionID = $row['attraction_visited'];
					$rating = $row['rating'];
					echo '<div class="user_history">';
					//get the attraction name
					$attNameQuery = "SELECT * FROM attractions WHERE attractionID = $attractionID";
					$attNameResult = mysqli_query($conn, $attNameQuery);
					if (mysqli_num_rows($attNameResult) > 0){
						while($row = mysqli_fetch_array($attNameResult)){
							$attName = $row['name'];
							echo '<h4><a href="attraction.php?attr='.$attractionID.'">'.$attName.'</a></h4>';
						}
					}
					
					echo '
					<p>Visited on: '.$date_visited.'</p>
					<p> Rated: '.$rating.'</p>
					</div>';
					
				}
			}
			
			
			echo '<h2>'.$userID.'\'s Travel Wish List</h2>';
		
			
			$wlQuery = "SELECT * FROM user_wishlist WHERE userID = '$userID'";
			$wlResult = mysqli_query($conn, $wlQuery);
			if (mysqli_num_rows($wlResult) > 0) {
				//already rating
				while($row = mysqli_fetch_array($wlResult)){
					$date_added = $row['date_entered'];
					$attraction = $row['attraction'];
					echo '<div class="user_history">';
					//get the attraction name
					$attQuery = "SELECT * FROM attractions WHERE attractionID = $attraction";
					$attResult = mysqli_query($conn, $attQuery);
					if (mysqli_num_rows($attResult) > 0){
						while($row = mysqli_fetch_array($attResult)){
							$attName = $row['name'];
							echo '<h4><a href="attraction.php?attr='.$attraction.'">'.$attName.'</a></h4>';
						}
					}
					
					echo '
					</div>';
					
				}
			}
		
		
			mysqli_close($conn);
			
		?>
<?php include 'footer.php';?>