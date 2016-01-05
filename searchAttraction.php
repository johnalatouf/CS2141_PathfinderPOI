
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
				$keywords = mysqli_real_escape_string($conn, $_POST["keywords"]);
				$category = mysqli_real_escape_string($conn, $_POST["category"]);
				$country = mysqli_real_escape_string($conn, $_POST["country"]);
				$continent = mysqli_real_escape_string($conn, $_POST["continent"]);
				$city = mysqli_real_escape_string($conn, $_POST["city"]);
				$price = floatval($_POST["price"]);
				$rating = floatval($_POST["rating"]);
				$sorter = mysqli_real_escape_string($conn, $_POST["sorter"]);
				
				//vars for program
				$attractions = array(); //holds the attractions to display
				$countryID = 0;
				$cityID = 0;
				$popularity = 1;
				
				
				//break up keywords
				$keyword = preg_split("/[\s,]+/ ", $keywords);
				//print_r($keyword);
				
				
				
				//if keywords is empty, add all items to the array, otherwise search for keywords
				if (empty($keywords)){
					//the keywords were empty, so we can start with a full array of attractions
					$keyQuery = "SELECT * FROM attractions ORDER BY $sorter";
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
				
				} else {
					//check for keywords
					foreach ($keyword as $key) {
						$keyQuery = "SELECT * FROM attractions WHERE name LIKE '%$key%' ORDER BY $sorter";
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
					}
					
					//check for keywords in description/review
					foreach ($keyword as $key) {
						$keyQuery = "SELECT * FROM reviews WHERE content LIKE '%$key%'";
						$keyResult = mysqli_query($conn, $keyQuery);
						if (mysqli_num_rows($keyResult) > 0) {
							while($row = mysqli_fetch_array($keyResult)) {
							$id = $row['attraction'];
							   if (in_array($id, $attractions)) {
									//in there
								} else {
									array_push($attractions, $id);
									//print_r($attractions);
									//echo 'add<br />';
								}
							}
						} 
					}
				}
				
				
				//now search the attractions array for other details
				$catArray = array(); //check the category
				if($category != '-') {
					$catQuery = "SELECT * FROM attractions WHERE category LIKE '%$category%' ORDER BY $sorter";
					$catResult = mysqli_query($conn, $catQuery);
					if (mysqli_num_rows($catResult) > 0) {
						while($row = mysqli_fetch_array($catResult)) {
						$id = $row['attractionID'];
						   if (in_array($id, $attractions)) {
								//add to the catArray
								array_push($catArray, $id);
							} 
						}
					}
					$attractions = $catArray; //keep only the attractions in that category
				}
				
				//does attractionID -> city?
				$citArray = array();
				if($city != '-') {
					$citQuery = "SELECT * FROM attractions WHERE city= (SELECT cityID from cities WHERE cityName LIKE '%$city%')";
					$citResult = mysqli_query($conn, $citQuery);
					if (mysqli_num_rows($citResult) > 0) {
						while($row = mysqli_fetch_array($citResult)) {
						$id = $row['attractionID'];
						   if (in_array($id, $attractions)) {
								//add to the catArray
								array_push($citArray, $id);
							} 
						}
					}
					$attractions = $citArray; //keep only the attractions in that category
					//print_r($attractions);
				}
				
				//does attractionID -> country?
				$countArray = array();
				if($country != '-') {
					$countQuery = "SELECT * FROM attractions WHERE country= (SELECT countryID from countries WHERE countryName LIKE '%$country%') ORDER BY $sorter";
					$countResult = mysqli_query($conn, $countQuery);
					if (mysqli_num_rows($countResult) > 0) {
						while($row = mysqli_fetch_array($countResult)) {
						$id = $row['attractionID'];
						   if (in_array($id, $attractions)) {
								//add to the catArray
								array_push($countArray, $id);
							} 
						}
					}
					$attractions = $countArray; //keep only the attractions in that category
					//print_r($attractions);
				}
				
				//does attractionID -> continent?
				$contArray = array();
				if($continent != '-') {
					//$contQuery = "SELECT * FROM attractions WHERE country= (SELECT countryID from contries WHERE continent LIKE '%$continent%')";
					$contQuery = "SELECT * FROM (SELECT attractionID, name, country, continent FROM attractions INNER JOIN countries ON attractions.country = countries.countryID WHERE continent LIKE '%$continent%') AS conts ORDER BY $sorter";
					$contResult = mysqli_query($conn, $contQuery);
					if (mysqli_num_rows($contResult) > 0) {
						while($row = mysqli_fetch_array($contResult)) {
						$id = $row['attractionID'];
						   if (in_array($id, $attractions)) {
								//add to the catArray
								array_push($contArray, $id);
							} 
						}
					}
					$attractions = $contArray; //keep only the attractions in that category
					//print_r($attractions);
				}
				
				//does attractionID -> price?
				$priceArray = array();
				if($price>0.0) {
					$priceQuery = "SELECT * FROM attractions WHERE price<=$price ORDER BY $sorter";
					$priceResult = mysqli_query($conn, $priceQuery);
					if (mysqli_num_rows($priceResult) > 0) {
						while($row = mysqli_fetch_array($priceResult)) {
						$id = $row['attractionID'];
						   if (in_array($id, $attractions)) {
								//add to the catArray
								array_push($priceArray, $id);
							} 
						}
					}
					$attractions = $priceArray; //keep only the attractions in that category
					//print_r($attractions);
				}
				
				
				//does attractionID -> rating?
				$ratArray = array();
				if($rating>0 || $rating<5) {
					$ratQuery = "SELECT * FROM attractions WHERE avgRating>=$rating ORDER BY $sorter";
					$ratResult = mysqli_query($conn, $ratQuery);
					if (mysqli_num_rows($ratResult) > 0) {
						while($row = mysqli_fetch_array($ratResult)) {
						$id = $row['attractionID'];
						   if (in_array($id, $attractions)) {
								//add to the catArray
								array_push($ratArray, $id);
							} 
						}
					}
					$attractions = $ratArray; //keep only the attractions in that category
					//print_r($attractions);
				}
				
				
				//now display results!
				echo '<div id="results"><h2>Results</h2>';
				foreach($attractions as $att){
					$resQuery = "SELECT * FROM attractions WHERE attractionID = $att ORDER BY $sorter";
					$resResult = mysqli_query($conn, $resQuery);
					if (mysqli_num_rows($resResult) > 0){
						while($row = mysqli_fetch_array($resResult)){
							$attID = $row['attractionID'];
							$attName = $row['name'];
							echo '<a href="attraction.php?attr='.$attID.'">'.$attName.'</a><br />';
						
						}
					
					}
				
				
				}
			
			
			
				mysqli_close($conn);
			}
		?>
<?php include 'footer.php';?>