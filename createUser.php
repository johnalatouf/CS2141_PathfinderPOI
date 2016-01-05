<?php include 'header.php';?>
		<?php
			$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
			//check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			//variables for creating a user
			$name = mysqli_real_escape_string($conn, $_POST["name"]);
			$id = mysqli_real_escape_string($conn, $_POST["userName"]);
			$email = mysqli_real_escape_string($conn, $_POST["email"]);
			$address = mysqli_real_escape_string($conn, $_POST["address"]);
			$password = mysqli_real_escape_string($conn, $_POST["password"]);
			$hash = password_hash($password, PASSWORD_DEFAULT);
			
			$sqlQuery = "SELECT userID FROM users WHERE userID='$id'";
			$queryResults = mysqli_query($conn, $sqlQuery);
			//check it's not in already
			if (mysqli_num_rows($queryResults) > 0) {
				//output
				echo "That username already exists<br />";
				
			} else {
				$stmt = $conn->prepare("INSERT INTO users (userID, name, email, address, pword) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("sssss", $id, $name, $email, $address, $hash);
				$stmt->execute();
				
				if ($stmt->affected_rows>0) {
					echo "user added<br />";
				} else {
					echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
				}

			}
			
			
			
			$stmt->close();
			mysqli_close($conn);
			
		?>
<?php include 'footer.php';?>