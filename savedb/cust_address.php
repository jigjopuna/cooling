<?php 
	//1. receive data
	$province  = trim($_POST['province']);
	$amphur  = trim($_POST['amphur']);
	$tumbon  = trim($_POST['tumbon']);
	$cust_name  = $_POST['cust_name'];
	$cust_address  = trim($_POST['cust_address']);
	$cust_tel  = trim($_POST['cust_tel']);
	$custzip  = trim($_POST['custzip']);
	$cust_email  = trim($_POST['cust_email']);


	//2. insert into database	
	if($province!='' || $cust_name!=''){
		$sql_savecustaddr = "INSERT INTO tb_customer SET  
				cust_province='$province', 
				cust_amphur='$amphur', 
				cust_tumbon='$tumbon', 
				cust_name='$cust_name', 
				cust_address='$cust_address', 
				cust_tel='$cust_tel', 
				cust_zip='$custzip', 
				cust_email='$cust_email'";
		
		$result_savecustaddr = mysql_query($sql_savecustaddr);
		
		$sql_custaddr = "SELECT p.id, p.pro_name, a.amp_name, t.tum_name 
				FROM (province p JOIN amphur a ON p.id = a.provinceID) JOIN tumbon t ON t.amphurID = a.id
				WHERE p.id='$province' AND a.id = '$amphur' AND t.id = '$tumbon'";
		$result_custaddr = mysql_query($sql_custaddr);
		$row_custaddr = mysql_fetch_array($result_custaddr);
	}

?>
   