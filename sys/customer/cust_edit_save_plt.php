<?php session_start();
	require_once('../include/connect.php');
	
	$cust_id = trim($_POST['cust_id']);
	
	$cust_name = trim($_POST['cust_name']);
	$province = trim($_POST['province']);
	$amphur = trim($_POST['amphur']);
	$tumbon = trim($_POST['tumbon']);
	$address = trim($_POST['address']);
	$zipcode = trim($_POST['zipcode']);
	$phoneno = trim($_POST['phoneno']);
	$email = trim($_POST['email']);
	$line_id = trim($_POST['line_id']);
	$cust_map = trim($_POST['cust_map']);
	$cust_tax = trim($_POST['taxid']);
	
	$cust_token = trim($_POST['token']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <title>แก้ไขข้อมูลลูกค้า</title>

</head>
<body>

<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = '../pages/login/login.php';
				</script>");
		}
	
	echo "cust_id : ".$cust_id. "<br>";
	echo "cust_name : ".$cust_name. "<br>";
	echo "cust_corp : ".$cust_corp. "<br>";
	echo "province : ".$province. "<br>";
	echo "amphur : ".$amphur. "<br>";
	echo "tumbon : ".$tumbon. "<br>";
	echo "address : ".$address. "<br>";
	echo "zipcode : ".$zipcode. "<br>";
	echo "phoneno : ".$phoneno. "<br>";
	echo "email : ".$email. "<br>";
	echo "other : ".$other. "<br>";
	
	
	$sql = "UPDATE tb_cust_depo SET 
				cuplt_name = '$cust_name',  
				cuplt_address = '$address', 
				cuplt_province = '$province', 
				cuplt_amphur = '$amphur', 
				cuplt_tumbon = '$tumbon', 
				cuplt_tel = '$phoneno', 
				cuplt_email = '$email', 
				cuplt_zip = '$zipcode', 
				cuplt_token = '$cust_token', 
				cuplt_lineid = '$line_id',  
				cuplt_tax = '$cust_tax',  
				cuplt_location = '$cust_map'  
			WHERE cuplt_id = '$cust_id'
			";
	$result = mysql_query($sql);
	
	if($result){
		exit("<script> alert('แก้ไขข้อมูลลูกค้า สำเร็จ'); window.location='cusplt.php';</script>");
	}else{
		exit("<script> alert('แก้ไขข้อมูลลูกค้าไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='cusplt.php';</script>");
	}

?>
    

</body>
</html>
