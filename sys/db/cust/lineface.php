<?php session_start();
	require_once('../../include/connect.php');
	
	$referer = trim($_POST['referer']);
	$cust_name = trim($_POST['cust_name']);
	$fb_province = trim($_POST['fb_province']);
	$fb_status = trim($_POST['fb_status']);
	$fb_phoneno = trim($_POST['fb_phoneno']);
	$datecontact = trim($_POST['datecontact']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <title>บันทึกข้อมูลลูกค้า</title>

</head>
<body>

<?php 
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php'; </script>");}
		
	echo "referer : ".$referer. "<br>";
	echo "cust_name : ".$cust_name. "<br>";
	echo "fb_province : ".$fb_province. "<br>";
	echo "fb_status : ".$fb_status. "<br>";
	echo "fb_phoneno : ".$fb_phoneno. "<br>";
	echo "datecontact : ".$datecontact. "<br>";
	
	exit();
	
	
	$sql = "INSERT INTO tb_quo_cust SET 
				qcust_name = '$cust_name', 
				qcust_addr = '$address', 
				qcust_prov = '$province', 
				qcuat_amphur = '$amphur', 
				qcust_tumbon = '$tumbon', 
				qcust_tel = '$phoneno', 
				qcust_zip = '$zipcode',  
				qcust_tax = '$taxid', 
				qcust_day = now()";
	$result = mysql_query($sql);	
	
	if($result){
		exit("<script> alert('บันทึกผู้ติดต่อ สำเร็จ'); window.location='../../customer/cust_line_fb.php';</script>");
	}else{
		exit("<script> alert('บันทึกผู้ติดต่อไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../customer/cust_line_fb.php';</script>");
	}

?>
    

</body>

</html>
