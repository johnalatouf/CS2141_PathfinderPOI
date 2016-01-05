
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
			
			echo '<h2>'.$userID.'\'s Reviews</h2>';
		
			echo '<div id="user_review">';
			$reviewsQuery = "SELECT * FROM reviews WHERE user = '$userID'";
			$reviewsResult = mysqli_query($conn, $reviewsQuery);
			if (mysqli_num_rows($reviewsResult) > 0) {
				//already rating
				while($row = mysqli_fetch_array($reviewsResult)){
					$rev = stripslashes($row['content']);
					$date = $row['date_added'];
					$photo_url = $row['photo_url'];
					$attractionID = $row['attraction'];
					$revID = $row['reviewID'];
					echo '<div id="review_history">';
					//get the attraction name
					$attNameQuery = "SELECT * FROM attractions WHERE attractionID = $attractionID";
					$attNameResult = mysqli_query($conn, $attNameQuery);
					if (mysqli_num_rows($attNameResult) > 0){
						while($row = mysqli_fetch_array($attNameResult)){
							$attName = $row['name'];
							echo '<h4><a href="attraction.php?attr='.$attractionID.'">'.$attName.'</a></h4>';
						}
					}
					
					if (!empty($photo_url)){
						echo '<img src="'.$photo_url.'" />';
					}
					
					echo '
					<p>'.$date.'</p>
					<p>'.$rev.'</p>
					</div>';
					
					//make a delete button
					//echo $revID . '</br>';
					//form to delete attractions
					echo '<a href="deleteUserReview.php?revID='.$revID.'">Delete This Review</a><br /><br />';
				}
			}
		
		
			mysqli_close($conn);
			
		?>
<?php include 'footer.php';?>