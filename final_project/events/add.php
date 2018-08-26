<!DOCTYPE html >
<html >
<head>
<?php
		   require_once("include/header.php");
		   require_once ("include/connectDB.php");
?>
<script type="text/javascript">//防止輸入空白
    function validateForm()
    {
        var a=document.forms["Form"]["event_name"].value;
        var b=document.forms["Form"]["event_date"].value;
        var c=document.forms["Form"]["teamlimit"].value;
        var d=document.forms["Form"]["max_mem"].value;
		var e=document.forms["Form"]["min_mem"].value;
		var f=document.forms["Form"]["content"].value;
		
        if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="" ,e==null||e=="",f==null||f=="")
        {
            alert("Please Fill All Required Field");
            return false;
        }
    }
</script>
</head>

<body>
<?php
  require_once("include/navbar.php");
  if (isset($_POST['submit'])){
      $event_name = $_POST['event_name'];
	  $event_date = $_POST['event_date'];
	  $teamlimit  = (int)$_POST['teamlimit'];
	  $max_mem    = (int)$_POST['max_mem'];
	  $min_mem    = (int)$_POST['min_mem']; 
	  $content    = $_POST['content'];
	  $query = "INSERT INTO event ( name , date , team_limit , max_team_members , min_team_members ,content ) VALUES (?,?,?,?,?,?)";
	  $statement = $databaseConnection->prepare($query);
	  $statement->bind_param('ssiiis',$event_name,$event_date,$teamlimit,$max_mem,$min_mem,$content);
	  $statement->execute();
	  $statement->store_result();
	  if ($statement->error)
      {
            die('Database query failed: ' . $statement->error);
      }

      $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
      if ($creationWasSuccessful)
      {
            header ("Location: ../events.php");
      }
      else
      {
            echo '錯誤: 新增活動失敗...';
      }
  }
?>
<div class="container event-wrapper event-list">
     <h3 class="title">新增活動</h3>
     <form action="add.php" method="post" name = "Form" onsubmit="return validateForm()">
      <fieldset>
      <ol>
         <li>
            <label for="event_name">活動名稱:</label>       
            <input type="text" name="event_name" value="" id="event_name" /> 
         </li>
         <li>
            <label for="event_date">活動日期:</label>
            <input type="text" name="event_date" value="" id="event_date" /> 
         </li>
         <li>
            <label for="teamlimit">隊伍限制:</label>
            <input type="text" name="teamlimit" value="" id="teamlimit" />
         </li>
         <li>
            <label for="max_mem">隊員限制(MAX):</label>
            <input type="text" name="max_mem" value="" id="max_mem" /> 
         </li>
         <li>
            <label for="min_mem">隊員限制(MIN):</label>
            <input type="text" name="min_mem" value="" id="min_mem" /> 
         </li>
         <li>
             <label for="content">活動內容</label>
             <textarea name="content" name="content" id="content"></textarea>
         </li>
      </ol>
      <input type="submit" name="submit" value="新增" />
      <p>
                <a href="../events.php">取消</a>
      </p>
      </fieldset>
    </form>
</div>

</body>
</html>