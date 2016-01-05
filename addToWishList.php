
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
			$userID = $_SESSION["userID"];
				
			$stmt = $conn->prepare("INSERT INTO user_wishlist (attraction, userID) VALUES($attID, ?)");
			$stmt->bind_param("s", $userID);
			$stmt->execute();
			
			if ($stmt->affected_rows>0) {
				echo "wishlist added<br />";
			} else {
				echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
			}
				
			$stmt->close();
			mysqli_close($conn);
			
		?>
		<br />
		<br />
<?php include 'footer.php';?>