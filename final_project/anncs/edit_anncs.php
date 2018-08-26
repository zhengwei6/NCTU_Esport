<!DOCTYPE html>
<html>
<head>
<?php
		   require("include/connectDB.php");
		   require("include/header.php");
?>
<script type="text/javascript">//防止輸入空白
    function validateForm()
    {
        var a=document.forms["Form"]["anncs_name"].value;
        var b=document.forms["Form"]["description"].value;
		
        if (a==null || a=="",b==null || b=="")
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
      if(!isset($_GET['edit'])){
	    header("Location: ../home.php");
	  }
      if (isset($_POST['submit'])){
	  $announce_id = $_POST['announce_id'];
      $anncs_name  = $_POST['anncs_name'];
	  $description = $_POST['description'];
	  $anncs_date  = (string)date("Y-m-d");
	  $query = "UPDATE announce SET anncs_name = ?, description = ?, anncs_date = ? WHERE announce_id= ?";
	  $statement = $databaseConnection->prepare($query);
	  $statement->bind_param("sssi",$anncs_name,$description,$anncs_date,$announce_id);		      
	  $statement->execute();
      $statement->store_result();
      if ($statement->error)
      {
        die('資料庫查詢錯誤: ' . $statement->error);
      }

      $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
      if ($creationWasSuccessful)
      {
        header ("Location: ../home.php");
      }
      else
      {
        echo '錯誤: 編輯頁面錯誤...';
     }       
		   
	   
	  }
?>
<div class="container anncs-wrapper anncs-list">
     <h3 class="title"><b>修改公告</b></h3>
     <form action="edit_anncs.php" method="post" onsubmit="return validateForm()" name="Form">
      <fieldset>
      <ol>
         <li>
         <input type="hidden" id="announce_id" name="announce_id" value="<?php echo $_GET['edit'] ?>"  />
            <label for="anncs_name">公告名稱:</label>       
            <input type="text" name="anncs_name" value="" id="anncs_name" /> 
         </li>
         <li>
             <label for="description">公告內容:</label>
			<input type="text" name="description" value="" id="description" /> 
         </li>
      </ol>
      <input type="submit" name="submit" value="儲存" />
      <p>
                <a href="..\home.php">取消</a>
      </p>
      </fieldset>
    </form>
</div>
</body>
</html>