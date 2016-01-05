<?php
	// Start the session
	session_start();
?>
<?php include 'header.php';?>
		<?php
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$conn = mysqli_connect("localhost", "root", "root", "PathfinderPOI", "8889", "");
				//check connection
				if (mysqli_connect_errno()) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();
				}
			
				//variables for creating a user
			
				$id = $_POST["userName"];
				$password = $_POST["password"];
				$_SESSION["loggedIn"] = false;
			
				//hash correct password
				$sqlQuery = "SELECT pword FROM users WHERE userID='$id'";
				$pword = mysqli_query($conn, $sqlQuery);
				//$pword = '$2y$10$gP.vCe0wUYeDb0QTWoYKe.C4pm9OP8dVYNbhSf7FD2H6ylWPXiK7i';
				//$hash = password_hash($password, PASSWORD_DEFAULT);
				//echo $id ."</br>". $password ."</br>";
			
				if (mysqli_num_rows($pword) > 0) {
					//output
					while($row = mysqli_fetch_array($pword)) {
						//echo "attraction name: " . $row['pword'] . "</br>";
						$hash = $row['pword'];
					}
				} else {
					echo "0 results";
				}
			
				if (password_verify($password, $hash)) {
					// Success!
				
					echo "successful login</br>";
					$sqlAdmin = "SELECT isAdmin FROM users WHERE userID='$id'";
					$admin = mysqli_query($conn, $sqlAdmin);
					if (mysqli_num_rows($pword) > 0) {
						while($row = mysqli_fetch_array($admin)) {
							//echo "attraction name: " . $row['pword'] . "</br>";
							$isAdmin = $row['isAdmin'];
						}
					}
					$_SESSION["userID"] = $id;
					$_SESSION["isAdmin"] = $isAdmin;
					$_SESSION["loggedIn"] = true;
					
					echo "logged in as " . $_SESSION["userID"] . "</br>";
					//echo $_SESSION["isAdmin"];
					if ($_SESSION["isAdmin"] == 1){
						echo "User has admin privileges</br>";
					}
					die();
				}
				else {
					// Invalid credentials
					echo "invalid password</br>";
				}
			
			
			
			
			
				mysqli_close($conn);
			}
		?>
		
	
<?php include 'footer.php';?>