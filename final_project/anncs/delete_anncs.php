<!DOCTYPE html>
<html>
<head>
<?php
		   require_once("include/header.php");
		   require_once ("include/connectDB.php");
?>
</head>

<body>
<?php
           require_once("include/navbar.php");
			
		   if(isset($_GET['delete']) ){
		      $delete_id = $_GET['delete'];
			  $query = "DELETE FROM announce WHERE announce_id = ?";
		      $statement = $databaseConnection->prepare($query);
			  $statement->bind_param('i',$delete_id);
			  $statement->execute();
			  $statement->store_result();
			  if ($statement->error)
              {
                   die('Database query failed: ' . $statement->error);
              }
			  $deletionWasSuccessful = $statement->affected_rows > 0 ? true : false;
        	  if ($deletionWasSuccessful)
              {
                   header ("Location: ../home.php");
              }
			  else
              {
                   echo "錯誤: 刪除錯誤...";
              }
		   }
?>
</body>
</html>