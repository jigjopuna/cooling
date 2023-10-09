<?php session_start();
	require_once('../../include/connect.php');
	$e_id = $_SESSION["ss_emp_id"];
	$cust_name = trim($_POST['cust_name']);
	$cust_tel = trim($_POST['cust_tel']);
	
	$province = trim($_POST['province']);
	$detail = trim($_POST['detail']);
	
	$action = trim($_POST['action']);
	$occu = trim($_POST['occu']);
	
	$ord_type = trim($_POST['ord_type']);
	$serverity = trim($_POST['serverity']);
	
	$datepick = trim($_POST['datepick']);
	
	$emp = mysql_fetch_array(mysql_query("SELECT e_name FROM tb_emp WHERE e_id = '$e_id'"));
	$e_name = $emp['e_name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <title>บันทึกข้อมูล</title>

</head>
<body>

<?php 
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php'; </script>");}
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");	
	//define('LINE_TOKEN','N8WRhbnxviDlBzQp2b6yTqRluxoBiUWEoIN79zjEvAW');  
	//define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt'); 
	function notify_message($message){

		$queryData = array('message' => $message);
		$queryData = http_build_query($queryData,'','&');
		$headerOptions = array(
			'http'=>array(
				'method'=>'POST',
				'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
						  ."Authorization: Bearer ".LINE_TOKEN."\r\n"
						  ."Content-Length: ".strlen($queryData)."\r\n",
				'content' => $queryData
			)
		);
		$context = stream_context_create($headerOptions);
		$result = file_get_contents(LINE_API,FALSE,$context);
		$res = json_decode($result);
		return $res;
	}
	
	echo 'e_id='.$e_id.'<br>';
	echo 'cust_name:'.$cust_name.'<br>';
	
	echo 'cust_tel:'.$cust_tel.'<br>';
	echo 'province:'.$province.'<br>';
	
	echo 'detail:'.$detail.'<br>';
	echo 'action: '.$action.'<br>';
	
	echo 'occu:'.$occu.'<br>';
	echo 'datepick:'.$datepick.'<br>';
	
	echo 'e_name:'.$e_name.'<br>';
	
	$sql = "INSERT INTO tb_sell_contact SET 
				sc_name = '$cust_name', 
				sc_province = '$province', 
				sc_detail = '$detail', 
				sc_action = '$action', 
				sc_occu = '$occu', 
				sc_tel = '$cust_tel', 
				sc_date = '$datepick', 
				sc_emp = '$e_id', 
				sc_severity = '$serverity', 
				sc_ord_type = '$ord_type' ";
	$result = mysql_query($sql);	
	
	if($result){
		$msg = $cust_name.' ดูแลลูกค้า Line ชื่อ '.$sc_tel;
		$res = notify_message($msg);
		exit("<script> alert('บันทึกเรียบร้อย'); window.location='../../customer/cust_sell.php';</script>");
	}else{
		exit("<script> alert('บันทึกไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../customer/cust_qoutation.php';</script>");
	}

?>
</body>
</html>
