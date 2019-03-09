<?php session_start();
	  require_once('../../include/connect.php'); 
	  $e_id = $_SESSION['ss_emp_id'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");	
	define('LINE_TOKEN','N8WRhbnxviDlBzQp2b6yTqRluxoBiUWEoIN79zjEvAW');  
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
	
	//1. receive data
	$cu_status = trim($_POST['cu_status']);	 
	$order_id = trim($_POST['order_id']);
	$linecust = trim($_POST['linecust']);
	
	
	$rowemp = mysql_fetch_array(mysql_query("SELECT e_name FROM tb_emp WHERE e_id = '$e_id'"));
	$emps = $rowemp['e_name'];
	
	$rowcname = mysql_fetch_array(mysql_query("SELECT * FROM tb_custsell WHERE cuse_id ='$linecust'"));
	$custname = $rowcname['cuse_line'];
	
	$rowst = mysql_fetch_array(mysql_query("SELECT ost_status FROM tb_ord_status WHERE ost_id='$cu_status'"));
	$statusname = $rowst['ost_status'];
	
	//2. update into database	
	$sql = "UPDATE tb_custsell SET cuse_status = '$cu_status' WHERE cuse_id = '$linecust'";
	
	$result1 = mysql_query($sql);
	
	if($result1){
		$msg = "ลูกค้าไลน์ชื่อ ".$custname.' เปลี่ยนเป็นสถานะเป็น '.$statusname. ' ('.$emps. ')';
		$res = notify_message($msg);
		exit("
			<script>
				alert('อัปเดทสถานะงานเรียบร้อยแล้วจร้า ^^ ');
				window.location='../../customer/cust_sell.php';
			</script>
		");
	}
?>
</body>
</html>     




