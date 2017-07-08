<?php require_once('../include/connect.php'); ?>
<?php	
	$amphur = trim($_POST[amphur]);

	$sql = "select * from tumbon
			where amphurID = '$amphur'
			order by tum_name";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	echo "<option value=''>เลือกตำบล</option>\n";

	if($num==0)
		exit();

 while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[id]'>$row[tum_name]</option>\n";
  } 
  mysql_close($conn);
?>