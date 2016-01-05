

<?php include 'header.php';?>
		
		
		<?php
			
			$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
			//check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			
			//variables from form
			$attID = $_GET['attr'];
			$keyQuery = "SELECT * FROM attractions WHERE attractionID = $attID";
			$keyResult = mysqli_query($conn, $keyQuery);
				if (mysqli_num_rows($keyResult) > 0) {
					while($row = mysqli_fetch_array($keyResult)) {
						$attName = $row['name'];
						$category = $row['category'];
						$country = $row['country'];
						$address = $row['address'];
						$city = $row['city'];
						$state = $row['state'];
						$price = $row['price'];
						$geoLat = $row['geolatitude'];
						$geoLong = $row['geoLongitude'];
						$avgRating = $row['avgRating'];
						$popularity = $row['popularity'];
					}
					echo '<div id="attDisplay">';
					echo '<h2 id="attName">'.$attName.'</h2>';
					echo '<p id="category">'.$category.'</p>';
					echo '<p id="address">'.$address.'</p>';
					//get city and country names
					$citQuery = "SELECT * FROM cities WHERE cityID = $city";
					$citResult = mysqli_query($conn, $citQuery);
					if (mysqli_num_rows($citResult) > 0) {
						//already rating
						while($row = mysqli_fetch_array($citResult)){
							$cit = $row['cityName'];
							echo '<p id="city">'.$cit.'</p>';
						}
					}
					echo '<p id="state">'.$state.'</p>';
					//get coounty and country names
					$coQuery = "SELECT * FROM countries WHERE countryID = $country";
					$coResult = mysqli_query($conn, $coQuery);
					if (mysqli_num_rows($coResult) > 0) {
						//already rating
						while($row = mysqli_fetch_array($coResult)){
							$co = $row['countryName'];
							echo '<p id="country">'.$co.'</p>';
						}
					}
					//////////////
					echo '<p id="pricy">Price: '.$price.'</p>';
					echo '<p id="geoCoords"> Geo Coords: '.$geoLat.' | ';
					echo ''.$geoLong.'</p>';
					echo '<p id="avgRating">Average Rating: '.$avgRating.'</p>';
					echo '<p id="popularity">Popularity: '.$popularity.'</p>';
					echo '<p><a href="addToWishList.php?attr='.$attID.'">Add to my wishlist</a>';
					echo '</div>';
					
					
					//make the firest review the main description and image
					echo '<div id="main_review">';
					$reviewsQuery = "SELECT * FROM reviews WHERE attraction = $attID ORDER BY date_added ASC LIMIT 1";
					$reviewsResult = mysqli_query($conn, $reviewsQuery);
					if (mysqli_num_rows($reviewsResult) > 0) {
						//already rating
						while($row = mysqli_fetch_array($reviewsResult)){
							$rev = stripslashes($row['content']);
							$user = $row['user'];
							$date = $row['date_added'];
							$photo_url = $row['photo_url'];
							echo '<div>
							<img src="'.$photo_url.'" />
							<p>'.$rev.'</p>
							<p>'.$user.'</p>
							<p>'.$date.'</p>
							</div>';
						}
					}
			
					echo '</div>';
					
					
					
					//section for your rating
					$id = $_SESSION["userID"];
					$ratQuery = "SELECT * FROM ratings WHERE attraction = $attID AND user ='$id'";
					$ratResult = mysqli_query($conn, $ratQuery);
					if (mysqli_num_rows($ratResult) > 0) {
						//already rating
						while($row = mysqli_fetch_array($ratResult)){
							$rat = $row['rating'];
							echo '<p id="yourRating">Your rating: '.$rat.'</p>';
						}
					} else {
						//not yet rated
						echo '<div id="addRating"><form action="addRating.php" method="post">
						<input type="hidden" name="attractionID" value="'.$attID.'">
						Add Rating:
						<select name="rating">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select><br />
						Date visited (YYYY-MM-DD):
						<input type="text" name="date_visited" /><br />
						Review<br />
						<textarea rows="4" cols="50" name="review">
						type review here...</textarea>
						<br />Photo URL: 
						<input type="text" name = "photo" />
						<br />
						<input type="submit" />
						</form></div>';
					}
				}
				
			
			
			//////////////////////////////////////////////////
			//display reviews
			echo '<div id="reviews">';
			$reviewsQuery = "SELECT * FROM reviews WHERE attraction = $attID";
			$reviewsResult = mysqli_query($conn, $reviewsQuery);
			if (mysqli_num_rows($reviewsResult) > 0) {
				//already rating
				while($row = mysqli_fetch_array($reviewsResult)){
					$rev = stripslashes($row['content']);
					$user = $row['user'];
					$date = $row['date_added'];
					$photo_url = $row['photo_url'];
					echo '<div class="rev">
					<p>'.$user.'</p>
					<p>'.$date.'</p>
					<p>'.$rev.'</p>
					<img src="'.$photo_url.'" />
					</div>';
				}
			}
			
			//echo '</div>';
		
			mysqli_close($conn);
		
		?>
		<br />
		<br />
<?php include 'footer.php';?>