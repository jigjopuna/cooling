<?php require_once('../include/connect.php'); ?>
<?php	
	$sql = "select * from province order by pro_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	

    if($num==0)
		exit();
	
    echo "<option value='0'>เลือกจังหวัด</option>\n";
 while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[id]'>$row[pro_name]</option>\n";
  } 
  mysql_close($conn);
?>