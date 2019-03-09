<?php session_start();
	require_once('../../include/connect.php');
	
	$cust_name = trim($_POST['cust_name']);
	$province = trim($_POST['province']);
	$amphur = trim($_POST['amphur']);
	$tumbon = trim($_POST['tumbon']);
	$address = trim($_POST['address']);
	$zipcode = trim($_POST['zipcode']);
	$phoneno = trim($_POST['phoneno']);
	$taxid = trim($_POST['taxid']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <title>บันทึกข้อมูลลูกค้า</title>

</head>
<body>

<?php 
	require_once('../../include/inc_role.php'); 
	
	echo "cust_name : ".$cust_name. "<br>";
	echo "province : ".$province. "<br>";
	echo "amphur : ".$amphur. "<br>";
	echo "tumbon : ".$tumbon. "<br>";
	echo "address : ".$address. "<br>";
	echo "zipcode : ".$zipcode. "<br>";
	echo "phoneno : ".$phoneno. "<br>";
	echo "cusprod : ".$cusprod. "<br>";
	
	//exit();
	
	
	$sql = "INSERT INTO tb_cust_part SET 
				cusp_name = '$cust_name', 
				cusp_addr = '$address', 
				cusp_prov = '$province', 
				cusp_amphur = '$amphur', 
				cusp_tumbon = '$tumbon', 
				cusp_tel = '$phoneno', 
				cusp_zip = '$zipcode',  
				cusp_tax = '$taxid',  
				cusp_day = now()";
	$result = mysql_query($sql);	
	
	if($result){
		exit("<script> alert('บันทึกข้อมูลลูกค้า สำเร็จ'); window.location='../../order/service.php';</script>");
	}else{
		exit("<script> alert('บันทึกข้อมูลลูกค้าไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../customer/cust_qoutation.php';</script>");
	}

?>
    

</body>

</html>
