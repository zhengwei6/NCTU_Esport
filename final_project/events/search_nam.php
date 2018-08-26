<?php
  session_start();
  if(isset($_POST["id"])){
     $id = $_POST["id"];
	 $_SESSION["ID"] = $id;
     require_once ("include/connectDB.php");
	 $sql = "SELECT * FROM user WHERE user.student_id=".$id;
	 $result = $databaseConnection->query($sql);
	 $total_records = $result->num_rows;
	 if($total_records==0){
	   $_SESSION["NAME"] = "NO";
	   $_SESSION["ok_events"] = 0; 
	 }
	 else if($total_records==1){
	   $rows = $result->fetch_array(MYSQLI_ASSOC);
	   $_SESSION["NAME"] = $rows["student_name"];
	   $_SESSION["ok_events"] = 1; 
	 }
	 else{
	   $_SESSION["NAME"] = "TOO_MUNCH";
	   $_SESSION["ok_events"] = 0; 
	 }
  }
  header("Location: new_member.php");
?>