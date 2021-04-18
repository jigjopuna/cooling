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
	$linefb = trim($_POST['linefb']);
	
	
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
	
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");	
	define('LINE_TOKEN','unssmF5QMBemRuMk3YSAVP5dmVPRkbMd5sE9nAwFLzA');
	define('LINE_TOKEN1', $cust_token); 
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
		
	/*echo "cust_name : ".$cust_name. "<br>";
	echo "province : ".$province. "<br>";
	echo "amphur : ".$amphur. "<br>";
	echo "tumbon : ".$tumbon. "<br>";
	echo "address : ".$address. "<br>";
	echo "zipcode : ".$zipcode. "<br>";
	echo "phoneno : ".$phoneno. "<br>";
	echo "cusprod : ".$cusprod. "<br>";
	echo "cusproduct : ".$cusproduct. "<br>";*/
	
	//exit();
	
	
	$sql = "INSERT INTO tb_cust_depo SET 
				cuplt_name = '$cust_name', 
				cuplt_address = '$address', 
				cuplt_province = '$province', 
				cuplt_amphur = '$amphur', 
				cuplt_tumbon = '$tumbon', 
				cuplt_tel = '$phoneno', 
				cuplt_zip = '$zipcode',  
				cuplt_tax = '$taxid', 
				cuplt_lineid = '$linefb', 
				cuplt_day = now()";
	$result = mysql_query($sql);	
	
	
	
	if($result){
		$msg = ' เพิ่มลูกค้า '.$cust_name.' ฝากสินค้า เบอร์ : '.$phoneno;	
		$res = notify_message($msg);
		exit("<script> alert('บันทึกข้อมูลลูกค้า สำเร็จ '); window.location='../../order/ord_plt.php';</script>");
	}else{
		exit("<script> alert('บันทึกข้อมูลลูกค้าไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../customer/cust_plt.php';</script>");
	}

?>
   
</body>
</html>
