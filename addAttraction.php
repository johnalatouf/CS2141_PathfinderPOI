
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
				$attName = mysqli_real_escape_string($conn, $_POST["attName"]);
				$category = mysqli_real_escape_string($conn, $_POST["category"]);
				$country = mysqli_real_escape_string($conn, $_POST["country"]);
				$continent = mysqli_real_escape_string($conn, $_POST["continent"]);
				$address = mysqli_real_escape_string($conn, $_POST["address"]);
				$location = mysqli_real_escape_string($conn, $_POST["location"]);
				$city = mysqli_real_escape_string($conn, $_POST["city"]);
				$state = mysqli_real_escape_string($conn, $_POST["state"]);
				$price = floatval($_POST["price"]);
				$geoLat = floatval($_POST["geoLat"]);
				$geoLong = floatval($_POST["geoLong"]);
				$rating = floatval($_POST["rating"]);
				$review = mysqli_real_escape_string($conn, $_POST["review"]);
				$photo_url = mysqli_real_escape_string($conn, $_POST["photo"]);
				$date_visited = mysqli_real_escape_string($conn, $_POST["date_visited"]);
				
				//vars for program
				$countryID = 0;
				$cityID = 0;
				$locationID = 0;
				$popularity = 1;
				
				//check if it's already there
				$stmt = $conn->prepare("SELECT * FROM attractions WHERE name=?");
				$stmt->bind_param("s", $attName);
				$stmt->execute();
				mysqli_stmt_store_result ($stmt);
				if (mysqli_stmt_num_rows($stmt) > 0) {
					//don't add duplicates
					echo "an attraction by that name already exists.";
				} else {
				
					////////////////////////////////////////////////////////////////////////////////////
					//check if country is in DB, if not, add, otherwise get 
					$stmt = $conn->prepare("SELECT countryID FROM countries WHERE countryName=?");
					$stmt->bind_param("s", $country);
					$stmt->execute();
					mysqli_stmt_store_result ($stmt);
					//$countryQuery = "SELECT * FROM countries WHERE countryName='$country'";
					//$cResult = mysqli_query($conn, $countryQuery);
					if (mysqli_stmt_num_rows($stmt) <= 0) {
						//add to the db
						//$sqlAdd = "INSERT INTO countries (countryName, continent) VALUES ('$country', '$continent')";
						$stmt = $conn->prepare("INSERT INTO countries (countryName, continent) VALUES (?, ?)");
						$stmt->bind_param("ss", $country, $continent);
						$result = $stmt->execute();
						if (mysqli_stmt_store_result ($stmt)) {
							echo "country added<br />";
							//set ID
							$stmt = $conn->prepare("SELECT countryID FROM countries WHERE countryName=?");
							$stmt->bind_param("s", $country);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_bind_result($stmt, $row);
							$stmt->execute();
							while (mysqli_stmt_fetch($stmt)) {
								$countryID = $row;
							}
						} else {
							echo "Error: " . $sqlAdd . "<br>" . mysqli_error($conn);
						}
					} else {
						//set ID
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt, $row);
						while (mysqli_stmt_fetch($stmt)) {
							$countryID = $row;
						}
					}
					
					////////////////////////////////////////////////////////////////////////////////////
					//check if city is in DB, if not, add, otherwise get 
					//$cityQuery = "SELECT * FROM cities WHERE cityName='$city'";
					//$cityResult = mysqli_query($conn, $cityQuery);
					$stmt = $conn->prepare("SELECT cityID FROM cities WHERE cityName=?");
					$stmt->bind_param("s", $city);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result ($stmt);
					if (mysqli_stmt_num_rows($stmt) <= 0) {
						//add to the db
						//$sqlAdd = "INSERT INTO cities (cityName, countryID, state) VALUES ('$city', $countryID, '$state')";
						$sqlAdd = $conn->prepare("INSERT INTO cities (cityName, countryID, state) VALUES (?, $countryID, ?)");
						$sqlAdd->bind_param("ss", $city, $state);
						$sqlAdd->execute();
						if (mysqli_stmt_store_result ($sqlAdd)) {
							echo "city added<br />";
							//set id
							$stmt = $conn->prepare("SELECT cityID FROM cities WHERE cityName=?");
							$stmt->bind_param("s", $city);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result ($stmt);
							mysqli_stmt_bind_result($stmt, $row);
							while (mysqli_stmt_fetch($stmt)) {
								$cityID = $row;
							}
						} else {
							echo "Error: " . $sqlAdd . "<br>" . mysqli_error($conn);
						}
					} else {
						//set ID
						mysqli_stmt_bind_result($stmt, $row);
						while (mysqli_stmt_fetch($stmt)) {
							$cityID = $row;
						}
					}
					
					
					
					////////////////////////////////////////////////////////////////////////////////////
					//now insert the whole thing
					//$sqlAddAtt = "INSERT INTO attractions (name, `category`, address, city, state, country, price, geoLatitude, geoLongitude, popularity) VALUES ('$attName', '$category', '$address', $cityID, '$state', $countryID, $price, $geoLat, $geoLong, $popularity)";
					$stmt = $conn->prepare("INSERT INTO attractions (name, `category`, address, city, state, country, price, geoLatitude, geoLongitude, popularity) VALUES (?, ?, ?, $cityID, ?, $countryID, $price, $geoLat, $geoLong, $popularity)");
					$stmt->bind_param("ssss", $attName, $category, $address, $state);
					$stmt->execute();
					printf("%d Row inserted.\n", $stmt->affected_rows);
					if ($stmt->affected_rows>=0) {
						echo "New record created successfully<br />";
					} else {
						echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
					}
				
				
					////////////////////////////////////////////////////////////////////////////////////
					//now hook up the ratings
					
					$sqlGetAtt = "SELECT * FROM attractions WHERE name='$attName'";
					$aResult = mysqli_query($conn, $sqlGetAtt);
					$attractionID = 0;
					$userID = $_SESSION["userID"];
					if (mysqli_num_rows($aResult) > 0) {
						//output
						while($row = mysqli_fetch_array($aResult)) {
							$attractionID = $row['attractionID'];
						}
					} else {
						echo "0 results";
					}
					
					$stmt = $conn->prepare("INSERT INTO ratings (attraction, user, rating, date_visited) VALUES($attractionID, ?, $rating, ?)");
					$stmt->bind_param("ss", $userID, $date_visited);
					$stmt->execute();
					
					if ($stmt->affected_rows>0) {
						echo "rating added<br />";
					} else {
						echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
					}
					
					/*$sqlAVGrating = "UPDATE attractions SET avgRating = (SELECT AVG(rating) FROM ratings WHERE attraction = $attractionID) WHERE attractionID = $attractionID";
					if (mysqli_query($conn, $sqlAVGrating)) {
						echo "rating avg<br />";
					} else {
						echo "Error: " . $sqlAVGrating . "<br />" . mysqli_error($conn);
					}*/
					
					/*
					echo $attractionID;
					echo $userID;
					echo $rating;
					mysqli_select_db($conn, 'PathfinderPOI');
					$sqlAddRating = mysqli_query($conn, "CALL PathfinderPOI.addRating('$userID', $attractionID, $rating)") or die(mysql_error());
					*/
				
				
				}
			
				////////////////////////////////////////////////////////////////////////////////////
				//now hook up the reviews
				
				$stmtRev = $conn->prepare("INSERT INTO reviews (attraction, user, content, photo_url) VALUES ($attractionID, ?, ?, ?)");
				$stmtRev->bind_param("sss", $userID, $review, $photo_url);
				$stmtRev->execute();
				
				if ($stmtRev->affected_rows>0) {
					echo "review added<br />";
				} else {
					echo "Error: " . $stmtRev . "<br />" . mysqli_error($conn);
				}	
				
				//close stuff
				$stmt->close();
				$stmtRev->close();
				mysqli_close($conn);
			}
		?>
		<br />
		<br />
<?php include 'footer.php';?>