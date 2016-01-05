<?php include 'header.php';?>
		<?php
			
			session_destroy();
			header("Location: index.php");
			
		?>
<?php include 'footer.php';?>