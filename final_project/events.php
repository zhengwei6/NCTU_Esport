<!DOCTYPE html>
<html>
     <?php
		   require_once("include/header.php");
		   require_once ("include/connectDB.php");
     ?>
	<body>
    <?php
	 require_once("include/navbar.php");
	 $sql  = "SELECT * FROM event";
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
		<div class="container event-wrapper event-list">
			<h3 class="title">活動列表</h3>
			<br>
            <p class="text-right"><a href="events/add.php">新增活動</a></p>
			<table class="table text-center">
				<tr>
					<th class="text-center">項目</th>
					<th class="text-center">規則</th>
					<th class="text-center">報名</th>
                    <th class="text-center">操作</th>
				</tr>
                <?php
				    $j = 1;
				    while($rows = $result->fetch_array(MYSQLI_ASSOC)
					  and $j<=$records_per_page){
					  echo "<tr>";
					  echo "<td>".$rows["name"]."</td>";
					  echo "<td>".$rows["content"]."</td>";
					  echo "<td><a href='events/signup.php?signup=".($rows["event_id"])."'>"."<button class='btn btn-default btn-event'>報名</button></a></td>";  
					  echo "<td><a href='events/edit.php?edit=".($rows["event_id"])."'>修改   </a>";
					  echo "<a href='events/status.php?status=".($rows["event_id"])."&name=".($rows["name"])."'>報名狀況    </a>";
					  echo "<a href='events/delete.php?delete=".($rows["event_id"])."'>刪除</a>";
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
			      echo "<a href='events.php?pages=".($pages-1)."' class='text-notify'>上一頁</a>|";
			   for($i = 1;$i<=$total_pages;$i++)
			      if($i!=$pages)
				     echo "<a href='events.php?pages=".$i."'class='text-notify'>".$i."</a> ";
				  else	 
			         echo $i." ";
			   if($pages < $total_pages)
			      echo "|<a href='events.php?pages=".($pages+1)."' class='text-notify'>下一頁</a> ";
			?>
            </div>
		</div>
	</body>
</html>