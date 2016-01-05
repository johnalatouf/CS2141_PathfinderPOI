<?php include 'header.php';?>
		
		<p>All fields are optional</p>
		<form action="searchAttraction.php" method="post">
		keywords: <input type="text" name="keywords" /> </br>
		category: 
		<select name="category">
			<option value="-" selected>-</option>
			<option value="Nature">Nature</option>
			<option value="AmusementPark">Amusement Park</option>
			<option value="Business">Business</option>
			<option value="Historical">Historical</option>
			<option value="Event">Event</option>
		</select>
		
		<?php
			$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
			//check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			//only get the cities that are already in the db
			$cityQuery = "SELECT * FROM cities";
			$cityResults = mysqli_query($conn, $cityQuery);
			echo 'city:
				<select name="city">
				<option value="-" selected>-</option>';
			if (mysqli_num_rows($cityResults) > 0) {
				while($row = mysqli_fetch_array($cityResults)) {
				   echo '<option value="'.$row['cityName'].'">'.$row['cityName'].'</option>';
				}
				
			}
			echo '</select>';
			
			//only get the countries that are already in the db
			$sqlQuery = "SELECT * FROM countries";
			$queryResults = mysqli_query($conn, $sqlQuery);
			echo 'Country:
				<select name="country">
				<option value="-" selected>-</option>';
			if (mysqli_num_rows($queryResults) > 0) {
				while($row = mysqli_fetch_array($queryResults)) {
				   echo '<option value="'.$row['countryName'].'">'.$row['countryName'].'</option>';
				}
				
			}
			echo '</select>';
			mysqli_close($conn);
		?>
		</select></br>
		Continent:
		<select name="continent">
			<option value="-" selected>-</option>
			<option value="North America">North America</option>
			<option value="South America">South America</option>
			<option value="Africa">Africa</option>
			<option value="Europe">Europe</option>
			<option value="Asia">Asia</option>
			<option value="Australia">Australia</option>
			<option value="Antarctica">Antarctica</option>
		</select></br>
		Maximum Price: <input type="text" name="price" /></br>
		
		Minimum Rating:
		<select name="rating">
			<option value="0"></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select></br>
		
		Sort By:
		<select name="sorter">
			<option value="name">Name</option>
			<option value="avgRating">avgRating</option>
			<option value="popularity">Popularity</option>
		</select></br>
		
		<input type="submit" />
		</form>
<?php include 'footer.php';?>