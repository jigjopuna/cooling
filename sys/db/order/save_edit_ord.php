<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");	
	define('LINE_TOKEN','FqDeF0S1QKAO0K5R5ziEgjk5XbUeK7SIp7OYMOKPcHf');
	
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
	$ord_status = trim($_POST['ord_status']);	 
	$order_id = trim($_POST['order_id']);
	
	/*echo "ord_status = ", $ord_status, "<br>";
	echo "order_id = ", $order_id, "<br>";	
	exit();*/
	
	$rowcname = mysql_fetch_array(mysql_query("SELECT c.cust_name FROM tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust WHERE o.o_id='$order_id'"));
	$custname = $rowcname['cust_name'];
	
	$rowst = mysql_fetch_array(mysql_query("SELECT ost_status FROM tb_ord_status WHERE ost_id='$ord_status'"));
	$statusname = $rowst['ost_status'];
	
	//2. update into database	
	$sql = "UPDATE tb_orders SET o_status = '$ord_status' WHERE o_id = '$order_id'";
	
	$result1 = mysql_query($sql);
	
	if($result1){
		$msg = "ออเดอร์ของคุณ ".$custname.' เปลี่ยนเป็นสถานะ '.$statusname;
		$res = notify_message($msg);
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




