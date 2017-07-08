<?php  session_start(); ?>
<?php require_once('../include/connect.php'); ?>
<?php	
    $id = $_SESSION['ss_id_card'];
	
	$sql_addr = "SELECT t.tum_name, t.id,t.amphurID FROM tumbon t join member_emp m on m.district = t.id WHERE m.id_card = $id";
	$result_addr = mysql_query($sql_addr);
	$num_addr = mysql_num_rows($result_addr);
	$row_addr = mysql_fetch_array($result_addr);
    if($num_addr!=0){
	   echo "<option value='$row_addr[id]'>$row_addr[tum_name]</option>\n";
	}
	
	$amphur = $row_addr['amphurID'];
	$sql = "select * from tumbon
			where amphurID = '$amphur'
			order by tum_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
    if($num==0)
		exit();
	
 
 while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[id]'>$row[tum_name]</option>\n";
  } 
  mysql_close($conn);
?>