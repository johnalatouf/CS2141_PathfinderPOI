

<?php include 'header.php';?>
		
		
		<?php
			
			$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
			//check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			echo '<div>';
			echo '<h2 class="h2stat">Countries</h2>';
			$keyQuery = "SELECT * FROM countries";
			$keyResult = mysqli_query($conn, $keyQuery);
			if (mysqli_num_rows($keyResult) > 0) {
				while($row = mysqli_fetch_array($keyResult)) {
					$attName = $row['countryName'];
					$avgRating = $row['avgRating'];
					$popularity = $row['popularity'];
					echo '<div class="stat">';
					echo '<h3 id="attName">'.$attName.'</h3>';
					echo '<p id="avgRating">Average Rating: '.$avgRating.'</p>';
					echo '<p id="popularity">Popularity: '.$popularity.'</p>';
					echo '</div>';
				
				}
				
			}
			
			echo '<h2 class="h2stat">Cities</h2>';
			$keyQuery = "SELECT * FROM cities";
			$keyResult = mysqli_query($conn, $keyQuery);
			if (mysqli_num_rows($keyResult) > 0) {
				while($row = mysqli_fetch_array($keyResult)) {
					$attName = $row['cityName'];
					$avgRating = $row['avgRating'];
					$popularity = $row['popularity'];
					echo '<div class="stat">';
					echo '<h3 id="attName">'.$attName.'</h3>';
					echo '<p id="avgRating">Average Rating: '.$avgRating.'</p>';
					echo '<p id="popularity">Popularity: '.$popularity.'</p>';
					echo '</div>';
				
				}
				
			}
			
			echo '<h2 class="h2stat">Attractions</h2>';
			
			$keyQuery = "SELECT * FROM attractions";
			$keyResult = mysqli_query($conn, $keyQuery);
			if (mysqli_num_rows($keyResult) > 0) {
				while($row = mysqli_fetch_array($keyResult)) {
					$id = $row['attractionID'];
					$attName = $row['name'];
					$avgRating = $row['avgRating'];
					$popularity = $row['popularity'];
					echo '<div class="stat">';
					echo '<h3 id="attName"><a href="attraction.php?attr='.$id.'">'.$attName.'</a></h3>';
					echo '<p id="avgRating">Average Rating: '.$avgRating.'</p>';
					echo '<p id="popularity">Popularity: '.$popularity.'</p>';
					echo '</div>';
				
				}
				
				
				
			}
			
			echo '<h2 class="h2stat">Categories</h2>';
			
			$keyQuery = "SELECT * FROM categories";
			$keyResult = mysqli_query($conn, $keyQuery);
			if (mysqli_num_rows($keyResult) > 0) {
				while($row = mysqli_fetch_array($keyResult)) {
					$attName = $row['category'];
					$avgRating = $row['avgRating'];
					$popularity = $row['popularity'];
					echo '<div class="stat">';
					echo '<h3 id="attName">'.$attName.'</h3>';
					echo '<p id="avgRating">Average Rating: '.$avgRating.'</p>';
					echo '<p id="popularity">Popularity: '.$popularity.'</p>';
					echo '</div>';
				
				}
				
				
				
			}
				
			
			
			mysqli_close($conn);
		
		?>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
<?php include 'footer.php';?>