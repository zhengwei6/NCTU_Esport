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
				$sql  = "SELECT * FROM announce";
				$result = $databaseConnection->query($sql);
				$records_per_page = 5;
				if(isset($_GET["pages"])) $pages = $_GET["pages"];
				else                      $pages = 1;
				$total_fields = $result->field_count;
				$total_records = $result->num_rows;
				$total_pages = ceil($total_records / $records_per_page);
				$offset = ($pages - 1 ) * $records_per_page;
				$result->data_seek($offset);
			?> 
		<div class="container anncs-wrapper">
			<h3 class="title">最新公告</h3>
						<br>
            <p class="text-right"><a href="anncs/add_anncs.php">新增公告</a></p>
			<table class="table text-center">
			    <?php
				    $j = 1;
				    while($rows = $result->fetch_array(MYSQLI_ASSOC)and $j<=$records_per_page)
					{
					  
					  echo "<tr>";
					  echo "<td>".$rows["anncs_date"]."</td>";
					  echo "<td>".$rows["anncs_name"]."</td>";
					  echo "<td><a href='anncs.php?detail=".($rows["announce_id"])."'>詳細內容 </a>";
					  echo "<td><a href='anncs/edit_anncs.php?edit=".($rows["announce_id"])."'>修改 </a>";
					  echo "<a href='anncs/delete_anncs.php?delete=".($rows["announce_id"])."'>刪除</a>";
					  echo "</tr>";
					  $j++;
					}
				?>
			</table>
			<div class="col-md-3 col-md-offset-1">
            </div>
            <div class="col-md-2 col-md-offset-2">
            <?php
			   if( $pages > 1 )
			      echo "<a href='home.php?pages=".($pages-1)."' class='text-notify'>上一頁</a>|";
			   for($i = 1;$i<=$total_pages;$i++)
			      if($i!=$pages)
				     echo "<a href='home.php?pages=".$i."'class='text-notify'>".$i."</a> ";
				  else	 
			         echo $i." ";
			   if($pages < $total_pages)
			      echo "|<a href='home.php?pages=".($pages+1)."' class='text-notify'>下一頁</a> ";
			?>
            </div>
        </div>
	</body>
</html>