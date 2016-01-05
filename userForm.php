<?php include 'header.php';?>
		<?php
			
		?>
		<form action="createUser.php" method="post">
		user name: <input type="text" name="userName" /> </br>
		real name <input type="text" name="name" /> </br>
		e-mail: <input type="text" name="email" /> </br>
		address: <input type="text" name="address" /></br>
		password: <input type="password" name="password" /></br>
		<input type="submit" />
		</form>
<?php include 'footer.php';?>