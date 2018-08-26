<?php
   $query = "SELECT DISTINCT a.team_name FROM sign_up a WHERE a.event_id=".$_SESSION['URL'];
   $result = $databaseConnection->query($query);
   $total_records = $result->num_rows;
   echo "<p>已報名隊伍: ".$total_records." 隊</p>";
   echo "<p class='warning'>尚可報名：".($rows['team_limit']-$total_records)." 隊</p></div>";
   echo "<script>if(".(int)($rows['team_limit']-$total_records);
   echo 
   "<=0){
	   can_sumit = 0;
   }
   else{
	   can_sumit = 1
   }
   </script>";
   
   echo "<script>  mem_num = 0 ;mem_limit =".$rows['max_team_members'].";</script>";
?>
