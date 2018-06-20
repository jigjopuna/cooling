<?php session_start();
	require_once('../../include/connect.php');
	
	$qcust_id = trim($_GET['qcust_id']);
	$row = mysql_fetch_array(mysql_query("SELECT * FROM  tb_quo_cust WHERE qcust_id = '$qcust_id'"));
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

	$qcust_name = $row['qcust_name'];
	$qcust_addr = $row['qcust_addr'];
	$qcust_prov = $row['qcust_prov'];
	$qcuat_amphur = $row['qcuat_amphur'];
	$qcust_tumbon = $row['qcust_tumbon'];
	$qcust_tel = $row['qcust_tel'];
	$qcust_zip = $row['qcust_zip'];
	$qcust_tax = $row['qcust_tax'];
	
	/*echo 'qcust_id : '.$qcust_id.'<br>';
	echo 'qcust_name : '.$qcust_name.'<br>';
	echo 'qcust_addr : '.$qcust_addr.'<br>';
	echo 'qcust_prov : '.$qcust_prov.'<br>';
	echo 'qcuat_amphur : '.$qcuat_amphur.'<br>';
	echo 'qcust_tumbon : '.$qcust_tumbon.'<br>';
	echo 'qcust_tel : '.$qcust_tel.'<br>';
	echo 'qcust_zip : '.$qcust_zip.'<br>';
	echo 'qcust_tax : '.$qcust_tax.'<br>';*/

	$sql = "INSERT INTO tb_customer SET 
				cust_name = '$qcust_name', 
				cust_address = '$qcust_addr', 
				cust_province = '$qcust_prov', 
				cust_amphur = '$qcuat_amphur', 
				cust_tumbon = '$qcust_tumbon', 
				cust_tel = '$qcust_tel', 
				cust_zip = '$qcust_zip',  
				cust_tax = '$qcust_tax', 
				cust_day = now()";
	$result = mysql_query($sql);	
	
	if($result){
		$a = mysql_insert_id($conn);
		mysql_query("UPDATE tb_quo_cust SET qcust_status = 1 WHERE qcust_id='$qcust_id'");
		//SELECT * FROM tb_quotation_log WHERE qou_cust = '$qcust_name' ORDER BY qou_id DESC LIMIT 0,1 
		//INSERT INTO tb_orders SET o_cust = '$a', o_status = 1, o_size ='$', o_width='$', o_high='$', o_price='$', o_temp='$'
		exit("<script> alert('อัปเดทเป็นลูกค้าที่สั่งซื้อแล้ว'); window.location='../../finance/inpay.php';</script>");
	}else{
		exit("<script> alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../customer/cust_qoutation.php';</script>");
	}

?>
    

</body>

</html>
