<?php require_once('../include/connect.php'); ?>
<?php	
	$province = trim($_POST['province']); 
	$sql = "select * from province order by pro_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	
	$sql_proupdate = "SELECT * FROM province where id = '$province'";
	$result_proupdate = mysql_query($sql_proupdate);
	$row_proupdate =  mysql_fetch_array($result_proupdate);
	
	
	

    if($num==0)
		exit();
	
    echo "<option value='$row_proupdate[id]'>$row_proupdate[pro_name]</option>\n";
 while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[id]'>$row[pro_name]</option>\n";
  } 
  mysql_close($conn);
?>