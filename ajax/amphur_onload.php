<?php  session_start(); ?>
<?php require_once('../include/connect.php'); ?>
<?php	
    $id = $_SESSION['ss_id_card'];
	
	$sql_addr = "SELECT a.amp_name, a.id, a.provinceID FROM amphur a join member_emp m on m.amphur = a.id WHERE m.id_card = $id";
	$result_addr = mysql_query($sql_addr);
	$num_addr = mysql_num_rows($result_addr);
	$row_addr = mysql_fetch_array($result_addr);
    if($num_addr!=0){
	   echo "<option value='$row_addr[id]'>$row_addr[amp_name]</option>\n";
	}
	
	$province = $row_addr['provinceID'];
	$sql = "select * from amphur
			where provinceID = '$province'
			order by amp_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
    if($num==0)
		exit();
	
 
 while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[id]'>$row[amp_name]</option>\n";
  } 
  mysql_close($conn);
?>