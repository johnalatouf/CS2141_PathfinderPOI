
<?php include 'header.php';?>
		<?php
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
				//check connection
				if (mysqli_connect_errno()) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				
				//variables from form
				$attractionID = intval($_POST["attractionID"]);
				$rating = floatval($_POST["rating"]);
				$review = mysqli_real_escape_string($conn, $_POST["review"]);
				$photo_url = mysqli_real_escape_string($conn, $_POST["photo"]);
				$date_visited = mysqli_real_escape_string($conn, $_POST["date_visited"]);
				
				////////////////////////////////////////////////////////////////////////////////////
				//now hook up the ratings
				$userID = $_SESSION["userID"];
				
				$stmt = $conn->prepare("INSERT INTO ratings (attraction, user, rating, date_visited) VALUES($attractionID, ?, $rating, ?)");
				$stmt->bind_param("ss", $userID, $date_visited);
				$stmt->execute();
				
				if ($stmt->affected_rows>0) {
					echo "rating added<br />";
				} else {
					echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
				}
				
				
				
				/*$sqlAddRating = "INSERT INTO ratings (attraction, user, rating) VALUES($attractionID, '$userID', $rating)";
				if (mysqli_query($conn, $sqlAddRating)) {
					echo "rating added<br />";
				} else {
					echo "Error: " . $sqlAddRating . "<br />" . mysqli_error($conn);
				}*/
				
				/*$sqlAddReview = "INSERT INTO reviews (attraction, user, content, photo_url) VALUES ($attractionID, '$userID', '$review', '$photo_url')"; 
				if (mysqli_query($conn, $sqlAddReview)) {
					echo "review added<br />";
				} else {
					echo "Error: " . $sqlAddReview . "<br />" . mysqli_error($conn);
				}*/
				
				$stmtRev = $conn->prepare("INSERT INTO reviews (attraction, user, content, photo_url) VALUES ($attractionID, ?, ?, ?)");
				$stmtRev->bind_param("sss", $userID, $review, $photo_url);
				$stmtRev->execute();
				
				if ($stmtRev->affected_rows>0) {
					echo "review added<br />";
				} else {
					echo "Error: " . $stmtRev . "<br />" . mysqli_error($conn);
				}	
					
			
			
				mysqli_close($conn);
			}
		?>
<?php include 'footer.php';?>