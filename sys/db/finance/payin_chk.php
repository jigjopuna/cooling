<?php 
	require_once('../../include/connect.php'); 
	$sql = "SELECT c.cust_name, a.o_id, a.summoney, a.o_price, a.o_price - a.summoney sub
			FROM tb_customer c JOIN
				(SELECT o.o_id, SUM(op.pay_amount) summoney, o.o_price, o.o_cust
				FROM tb_orders o JOIN tb_ord_pay op ON o.o_id = op.o_id
				WHERE o.o_status = 5 AND o.o_id > 250 AND o.o_type LIKE '1%'
				GROUP BY op.o_id
				ORDER BY op.o_id DESC) AS a
			ON c.cust_id = a.o_cust
			ORDER BY a.o_id DESC";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
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
	define('LINE_TOKEN','DVkXOmyzLiMaXMhF8Ppoim48pl1A7foQgMTCsz1olfr'); 
	
	
	$msg = '';
	for($i=1; $i<=$num; $i++){
		$row = mysql_fetch_array($result);
		
		if($row['sub'] != 0){
			//$string .= $value . " AND ";
			$string .= ' - '.$row['cust_name'].' ('.$row['sub'].') '."\n";	
		}
	}
	
	
	$intro = "ออเดอร์ปิดงาน แต่ยังลงสลิปเงินเข้าไม่ครบ \n";
	$msg = $intro.$string;
	
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
	
	$res = notify_message($msg);

?>
</body>
</html>     




