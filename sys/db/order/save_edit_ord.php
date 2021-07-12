<?php session_start();
	  require_once('../../include/connect.php');
	
	//1. receive data
	$ord_status = trim($_POST['ord_status']);	 
	$order_id = trim($_POST['order_id']);
	$e_ids = trim($_POST['e_ids']);
	
	//fine user line Token
	$sql_cust = mysql_fetch_array(mysql_query("SELECT cust_token FROM tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id WHERE o.o_id = '$order_id'"));
	$cust_token = $sql_cust['cust_token'];
	
	echo 'order_id: '.$order_id.'<br>';
	echo 'cust_token: '.$cust_token.'<br>';
	


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
	//define('LINE_TOKEN','rnkNl937MsFP8QGVRf4nKZQ0OIspR6MaVXe6GZdrE9G'); 
	define('LINE_TOKEN','DVkXOmyzLiMaXMhF8Ppoim48pl1A7foQgMTCsz1olfr');	
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
	
	function notify_message1($message){
		$queryData = array('message' => $message);
		$queryData = http_build_query($queryData,'','&');
		$headerOptions = array(
			'http'=>array(
				'method'=>'POST',
				'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
						  ."Authorization: Bearer ".LINE_TOKEN1."\r\n"
						  ."Content-Length: ".strlen($queryData)."\r\n",
				'content' => $queryData
			)
		);
		$context = stream_context_create($headerOptions);
		$result = file_get_contents(LINE_API,FALSE,$context);
		$res1 = json_decode($result);
		return $res1;
	}
	
	
	
	
	$rowemp = mysql_fetch_array(mysql_query("SELECT e_name FROM tb_emp WHERE e_id = '$e_ids'"));
	$emps = $rowemp['e_name'];
	
	/*echo "ord_status = ", $ord_status, "<br>";
	echo "order_id = ", $order_id, "<br>";	
	exit();*/
	
	$rowcname = mysql_fetch_array(mysql_query("SELECT c.cust_name FROM tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust WHERE o.o_id='$order_id'"));
	$custname = $rowcname['cust_name'];
	
	$rowst = mysql_fetch_array(mysql_query("SELECT ost_status, ost_cust_status FROM tb_ord_status WHERE ost_id='$ord_status'"));
	$statusname = $rowst['ost_status'];
	$cstatusname = $rowst['ost_cust_status'];
	
	echo 'statusname: '.$statusname.'<br>';
	echo 'cstatusname: '.$cstatusname.'<br>';
	
	//exit();
	
	//2. update into database	
	$sql = "UPDATE tb_orders SET o_status = '$ord_status' WHERE o_id = '$order_id'";
	$result1 = mysql_query($sql);
	
	if($result1){
		$msg = "ออเดอร์ของคุณ ".$custname.' เปลี่ยนเป็นสถานะ '.$statusname. ' ('.$emps. ')';
		$msg1 = "ห้องเย็นลูกค้า ".$custname.' เปลี่ยนเป็นสถานะ '.$cstatusname;
		$res = notify_message($msg);
		$res1 = notify_message1($msg1);
		exit("
			<script>
				alert('อัปเดทสถานะออเดอร์เรียบร้อยแล้วจร้า ^^ ');
				window.location='../../order/order.php';
			</script>
		");
	}
?>
</body>
</html>     




