<!DOCTYPE html>
<html>
	<?php
		require_once("include/header.php");
		require_once ("include/connectDB.php");
    ?>
	<body>
	<?php
		require_once("include/navbar.php");
	?>
	<div class="container anncs-wrapper">
			<div class="detail-form">
	<?php
		if(isset($_GET['detail']))
		{
			$announce_id = $_GET['detail'];
			$query = "SELECT * FROM announce WHERE announce_id = ".$announce_id;
			if ($result = $databaseConnection->query($query))
            {
				$rows = $result->fetch_array(MYSQLI_ASSOC);
				echo "<b><h1 class='title'>".($rows['anncs_name'])."</h1></b>";
				echo "<p><h5 >".($rows['anncs_date'])."</h5></p>";
				echo "<p><h5 >".($rows['description'])."</h5></p>";
            }
		} 
		else
		{
			header("Location: ../home.php");
		}
	?>
			</div>
		</div>
	</body>
</html>