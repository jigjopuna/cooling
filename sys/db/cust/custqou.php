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
	$cusprod = trim($_POST['cusprod']);
	
	$company = trim($_POST['company']);
	$cust_status = trim($_POST['cust_status']);
	
	$cusproduct = trim($_POST['cusproduct']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <title>บันทึกข้อมูลลูกค้า</title>

</head>
<body>

<?php 
	$e_id = $_SESSION[ss_emp_id];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php'; </script>");}
		
	echo "cust_name : ".$cust_name. "<br>";
	echo "province : ".$province. "<br>";
	echo "amphur : ".$amphur. "<br>";
	echo "tumbon : ".$tumbon. "<br>";
	echo "address : ".$address. "<br>";
	echo "zipcode : ".$zipcode. "<br>";
	echo "phoneno : ".$phoneno. "<br>";
	echo "cusprod : ".$cusprod. "<br>";
	echo "cusproduct : ".$cusproduct. "<br>";
	
	//exit();
	
	
	$sql = "INSERT INTO tb_quo_cust SET 
				qcust_name = '$cust_name', 
				qcust_corp = '$company', 
				qcust_progress = '$cust_status', 
				qcust_addr = '$address', 
				qcust_prov = '$province', 
				qcuat_amphur = '$amphur', 
				qcust_tumbon = '$tumbon', 
				qcust_tel = '$phoneno', 
				qcust_zip = '$zipcode',  
				qcust_tax = '$taxid', 
				qcust_prod = '$cusproduct', 
				qcust_prodtype = '$cusprod', 
				qcust_emp = '$e_id', 
				qcust_day = now()";
	$result = mysql_query($sql);	
	
	if($result){
		exit("<script> alert('บันทึกข้อมูลลูกค้า สำเร็จ ขอใบเสนอราคาต่อได้'); window.location='../../quotation/cust_q.php';</script>");
	}else{
		exit("<script> alert('บันทึกข้อมูลลูกค้าไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../customer/cust_qoutation.php';</script>");
	}

?>
    

</body>

</html>
