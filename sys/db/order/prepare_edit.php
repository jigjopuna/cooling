<?php session_start();
	  require_once('../../include/connect.php');
	  require_once('../../include/inc_role.php');
	
	//1. receive data	 
	$ord_id = trim($_POST['ord_id']);
	$ord_prepare = trim($_POST['ord_prepare']);
	
	echo 'ord_id. '.$ord_id.'<br>';
	echo 'ord_prepare. '.$ord_prepare.'<br>';
	echo 'e_id. '.$e_id.'<br>';
	
	if($ord_prepare == 'on'){
		$o_prepare = 1;
	}else{
		$o_prepare = 0;
	}
	
	//exit();


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
	define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt');  
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
	
	
	$rowemp = mysql_fetch_array(mysql_query("SELECT e_name FROM tb_emp WHERE e_id = '$e_id'"));
	$emps = $rowemp['e_name'];
	
	/*echo "ord_status = ", $ord_status, "<br>";
	echo "order_id = ", $order_id, "<br>";	
	exit();*/
	
	$rowcname = mysql_fetch_array(mysql_query("SELECT c.cust_name FROM tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust WHERE o.o_id='$ord_id'"));
	$custname = $rowcname['cust_name'];
	

	
	//2. update into database	
	$sql = "UPDATE tb_orders SET o_prepare = '$o_prepare' WHERE o_id = '$ord_id'";
	$result1 = mysql_query($sql);
	
	if($result1){
		if($o_prepare == 1){
			$msg = "จัดของออเดอร์ ".$custname.' เสร็จเแล้ว '. ' ('.$emps. ')';
			$res = notify_message($msg);
		}

		exit("
			<script>
				alert('อัปเดทการจัดของเสร็จแล้วจร้า ^^ ');
				window.location='../../order/order.php';
			</script>
		");
	}
?>
</body>
</html>     




