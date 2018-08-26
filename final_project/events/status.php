<!DOCTYPE html>
<html>
       <head>
       <?php
	       session_start();
		   require_once("include/header.php");
		   require_once ("include/connectDB.php");
       ?>
       </head>
       <body>
       <?php
	       require_once("include/navbar.php");
	   ?>       
       
       <div class="container event-wrapper event-list">
       <h1 class="title">報名狀況</h3>
       <?php
		    if(isset($_GET["status"])&&isset($_GET["name"])){
				 $event_id = $_GET["status"];
				 $event_name = $_GET["name"];
		         echo "<div><h2 class='title'>".$event_name."</h>"."</div>";
				 $query  = "SELECT DISTINCT(a.team_name) AS team_name FROM  sign_up a WHERE a.event_id =".$event_id;
				 if ($result = $databaseConnection->query($query)){
			         while($rows = $result->fetch_array(MYSQLI_ASSOC)){
				       $query2 = "SELECT b.student_id,b.student_name FROM sign_up a, user b WHERE a.student_id=b.student_id AND";
					   $query2 = $query2." a.event_id=".$event_id." AND a.team_name='".$rows["team_name"]."'";
					   if($result2 = $databaseConnection->query($query2)){
						   while($rows2 = $result2->fetch_array(MYSQLI_ASSOC)){
							   echo $rows["team_name"];
							   echo $rows2["student_name"]; 
							   echo "<br>";
						   }
					   }
					 }
				 }
			}   
		?>   
       </div>
       </body>
</html>