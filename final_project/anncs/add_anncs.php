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
	if (isset($_POST['submit'])){
		$anncs_name  = $_POST['anncs_name'];
		$description = $_POST['description'];
		$anncs_date = (string)date("Y-m-d");
		$query = "INSERT INTO announce ( anncs_name ,description ,anncs_date) VALUES (?,?,?)";
		$statement = $databaseConnection->prepare($query);
		$statement->bind_param("sss",$anncs_name,$description,$anncs_date);
		$statement->execute();
		$statement->store_result();
		if ($statement->error)
		{
            die('Database query failed: ' . $statement->error);
		}

		$creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
		if ($creationWasSuccessful)
		{
			header ("Location: ../home.php");
		}
		else
		{
            echo '錯誤: 新增公告失敗...';
		}
	}
?>
<div class="container anncs-wrapper anncs-list">
    <h3 class="title">新增公告</h3>
		<form action="add_anncs.php" method="post">
			<fieldset>
				<ol>
					<li>
						<label for="anncs_name">公告名稱:</label>       
						<input type="text" name="anncs_name" value="" id="anncs_name" /> 
					</li>
					<li>
						<label for="description">公告內容:</label>
						<input type="text" name="description" value="" id="description" /> </textarea>
					</li>
				</ol>
				<input type="submit" name="submit" value="發佈" />
				<p>
					<a href="../home.php">取消</a>
				</p>
			</fieldset>
		</form>
</div>

</body>
</html>