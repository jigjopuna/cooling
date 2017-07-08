<?php require_once('../include/connect.php'); ?>
<?php	
	$province = trim($_POST[province]);

	$sql = "select * from amphur
			where provinceID = '$province'
			order by amp_name";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	echo "<option value='0'>เลือกอำเภอ</option>\n";
	


	if($num==0)
		exit();

 while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[id]'>$row[amp_name]</option>\n";
  } 
  mysql_close($conn);
?>