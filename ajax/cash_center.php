<?php require_once('../include/connect.php'); ?>
<?php
	$poprice = $_POST['poprice'];		
	
	$sql = "SELECT cash1 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 0,1"; //select last record
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	$cash = $row['cash1'];
	if($poprice > $cash){
		echo 1;
	}else{
		echo 2;
	}

	mysql_close($conn);

	
?>



