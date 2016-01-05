<?php
		// Start the session
		session_start();
	?>

<!DOCTYPE html>
<html>
	<head>
	<title>PathfinderPOI</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<div id="wrapper">
	<div id="header"> <h1><a href="index.php">PATHFINDER POI</a></h1> </div>
	<div id="menu">
	<a href="login.php">Login</a>
	<a href="userForm.php">Create User</a>
	
	<a href="searchAttractionForm.php">Search Attractions</a>
	<?php
		if ($_SESSION["isAdmin"] == 1){
			echo '<a href="deleteAttractionForm.php">Delete Attraction</a>';
		}
		
		if ($_SESSION["loggedIn"] == true){
			echo '<a href="addAttractionForm.php">Add Attraction</a>
				<a href="userReviews.php">My Reviews</a>
				<a href="userHistory.php">Travel Log</a>
				<a href="searchUserForm.php">Find User</a>';
		}
	?>
	<!--<a href="deleteAttractionForm.php">Delete Attraction</a>
	<a href="userReviews.php">My Reviews</a>
	<a href="userHistory.php">Travel Log</a>-->
	<a href="stats.php">Stats</a>
	<a href="logout.php">Logout</a>
	
	</div>
	<div id="content">