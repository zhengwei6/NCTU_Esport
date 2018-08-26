<?php
   require_once ("include/connectDB.php");
   session_start();
   if(isset($_POST['team_name'])){
       $team_name = $_POST['team_name'];
	   $event_id  = $_SESSION["URL"];
	   	   
	   
	   $query = "SELECT COUNT(*) FROM event a WHERE a.event_id = ".$event_id;
	   $result=$databaseConnection->query($query);
	   if($result)
	   { 
	     $total_records = $result->num_rows;
	     if($total_records!=1){
		        $_SESSION["warn_events"] = "沒有這個活動項目";
				header("Location: signup.php?signup=".$_SESSION["URL"]);
				exit;
		 }
	   }
	   else{
		  $_SESSION["warn_events"] = "查活動失敗";
		  header("Location: signup.php?signup=".$_SESSION["URL"]);
		  exit;
	   }
	   $query = "SELECT * FROM sign_up b WHERE b.team_name='".$team_name."' AND b.event_id=".$event_id;
	   if($result=$databaseConnection->query($query))
	   {
		  $total_records = $result->num_rows;
		  if($total_records>0){
		  $_SESSION["warn_events"] = "這個活動有相同的隊伍名稱";
		  header("Location: signup.php?signup=".$_SESSION["URL"]);	
		  exit;	    
		  }
	   }
	   else{
		  $_SESSION["warn_events"] = "活動查詢失敗";
		  header("Location: signup.php?signup=".$_SESSION["URL"]);	
		  exit;
	   }
	   $dat = (string)date("Y-m-d");
	   $mem_num = 0;
	   while(list($arr,$value)=each($_COOKIE)){
	    if(isset($_COOKIE[$arr])&&is_array($_COOKIE[$arr])&&isset($_COOKIE[$arr]['NAME'])){
	        if($_COOKIE[$arr]["ok_events"]==0){
		      $_SESSION["warn_events"] = "有不合法成員";
		      header("Location: signup.php?signup=".$_SESSION["URL"]);
			  exit;		          
		    }
			$mem_num += 1;
          }
	   }
	   
	   
       reset($_COOKIE);
	   while(list($arr,$value)=each($_COOKIE)){
		 if(isset($_COOKIE[$arr])&&is_array($_COOKIE[$arr])&&isset($_COOKIE[$arr]['NAME'])){
			 $student_id = $_COOKIE[$arr]['ID'];
			 while(list($name,$value) = each($_COOKIE[$arr])){
                   setcookie($arr."[".$name."]","",time()-3600);
             }
			 $query = "INSERT INTO sign_up (event_id,team_name,student_id,time) VALUES (?,?,?,?)";
			 $statement = $databaseConnection->prepare($query);
			 $statement->bind_param('isss',$event_id,$team_name,$student_id,$dat);
			 $statement->execute();
			 $statement->store_result();
			 if ($statement->error)
             {
                die('Database query failed: ' . $statement->error);
             }
	     }   
	   }
	   header("Location: signup.php?signup=".$_SESSION["URL"]);
	   
	   
   }

?>