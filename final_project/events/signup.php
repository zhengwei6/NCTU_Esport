<!DOCTYPE html>
<html>
	<head>
    <script type="text/javascript">
	function submiteam(){
	       var a=document.forms["new_team"]["team_name"].value;
		   if(a==null||a==""){
		      alert("Please Fill All Required Field");
			  return;
		   }
		   document.getElementById("new_team").submit();
	}
	</script>
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
     <div class="container event-wrapper">
			<div class="signup-form">
     <?php
		   if(isset($_GET['signup'])){
			  $_SESSION["URL"] = $_GET['signup'];
			  $event_id = $_GET['signup'];
			  $query = "SELECT * FROM event WHERE event_id = ".$event_id;
			  if ($result = $databaseConnection->query($query))
              {
					 $rows = $result->fetch_array(MYSQLI_ASSOC);
					 echo "<h3 class='text-center'>".($rows['name'])."</h3>";
					 echo "<div class='description'>";
					 echo "<p>每隊上限: ".$rows['max_team_members']." 人</p>";
					 require_once("num_team.php");
              }
			  
		   } 
		   else{
			  header("Location: ../events.php");
		   }
	 ?>
				<br>
				<label class="text-center" for="team_name">隊伍名稱</label>
                <form action="new_team.php" method="post" id="new_team" name="new_team">
				    <input type="text" id="team_name" name="team_name" class="form-control" value="">
                </form>
				<br>
				<label class="text-center" for="team_name">隊伍人員</label>
				<table class="table">
					<tr>
						<th class="student-id">隊員學號</th>
						<th>姓名</th>
						<th></th>
					</tr>
                    <?php
					      while(list($arr,$value)=each($_COOKIE)){
						     if(isset($_COOKIE[$arr])&&is_array($_COOKIE[$arr])&&isset($_COOKIE[$arr]['NAME'])){
								echo "<tr>";
							    while(list($name,$value)=each($_COOKIE[$arr])){
								   if($name=="ID")  echo "<td class='student-id'>".$value."</td>";
								   if($name=="NAME") echo "<td>".$value."</td>"; 
								}
								echo "<td class='text-right'><button class='btn btn-new' style='margin-right:30px'>修改</button>";
								echo "<a href='mem_delete.php?ID=".$arr."' class='btn btn-remove'>取消</a>";      
								echo "</td>";
								echo "</tr>";
								echo "<script> mem_num +=1  ;</script>";
							 }
						  }
						  echo "<form action='search_nam.php' method='post' name='Form'>";
					?>
                      <fieldset>
						<td class="student-id"><input type="text" name="id" class="form-control"></td>
						<td></td>
                        <td class="text-right"><button type="submit" class="btn btn-new" style="margin-right:30px" id = "new_mem" >新增隊員</button></td>
                      </fieldset>
                    </form>
						
					</tr>
				</table>
                <?php
				      if(isset($_SESSION["warn_events"])){
					      echo "<div>".$_SESSION["warn_events"]."</div>";
		                  unset($_SESSION["warn_events"]);
				      }
				?>
				<div class="text-left form-bottom" >
					<button class="btn btn-default" onClick="submiteam()" id = "signup_submit">提交報名表</button>
				</div>
                <script>
				     if(can_sumit<=0)
		                document.getElementById("signup_submit").style.display="none";
		             else
		                document.getElementById("signup_submit").style.display="block";;
				     if(mem_num>=mem_limit)
					    document.getElementById("new_mem").style.visibility="hidden";
					    
				</script>
				
			</div>
		</div>
	</body>
</html>