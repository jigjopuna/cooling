<?php session_start();
	require_once('../include/connect.php');
	
	$cust_id = trim($_POST['cust_id']);
	
	$cust_name = trim($_POST['cust_name']);
	$cust_corp = trim($_POST['cust_corp']);
	$province = trim($_POST['province']);
	$amphur = trim($_POST['amphur']);
	$tumbon = trim($_POST['tumbon']);
	$address = trim($_POST['address']);
	$zipcode = trim($_POST['zipcode']);
	$phoneno = trim($_POST['phoneno']);
	$email = trim($_POST['email']);
	$other = trim($_POST['other']);
	$line_id = trim($_POST['line_id']);
	$cust_map = trim($_POST['cust_map']);
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
	
	$sql = "UPDATE tb_customer SET 
				cust_name = '$cust_name', 
				cust_corp = '$cust_corp', 
				cust_address = '$address', 
				cust_province = '$province', 
				cust_amphur = '$amphur', 
				cust_tumbon = '$tumbon', 
				cust_tel = '$phoneno', 
				cust_email = '$email', 
				cust_zip = '$zipcode', 
				cust_lineid = '$line_id', 
				cust_other = '$other', 
				cust_location = '$cust_map'  
			WHERE cust_id = '$cust_id'
			";
	$result = mysql_query($sql);
	
	if($result){
		exit("<script> alert('แก้ไขข้อมูลลูกค้า สำเร็จ'); window.location='customer.php';</script>");
	}else{
		exit("<script> alert('แก้ไขข้อมูลลูกค้าไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='customer.php';</script>");
	}

?>
    

</body>

</html>
