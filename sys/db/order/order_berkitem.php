<?php 
	require_once('../../include/connect.php'); 
	$sql = "SELECT c.cust_name, a.orderid, a.nub_item, a.o_cust customerid
			FROM tb_customer c JOIN 
				( SELECT orpd.o_id orderid, COUNT(orpd.o_id) nub_item, o.o_cust
				FROM tb_ord_prod orpd JOIN tb_orders o ON o.o_id = orpd.o_id
				WHERE o.o_status = 5 AND o.o_id > 363 AND o.o_type LIKE '1%'
				GROUP BY orpd.o_id 
				ORDER BY orpd.o_id DESC) AS a
			ON c.cust_id = a.o_cust
			ORDER BY a.orderid DESC";
	/*
	sub query
	คิวรี่แรกนับแต่ละออเดอร์ว่ามีการเบิกไปแล้วกี่รายการ ออเดอร์สถานะที่ปิดงาน และเป็นออเดอร์ห้องเย็น ตั้งแต่ออเดอร์ที่ 307 เป็นต้นไป
	คิวรี่ที่สอง เป็นการหาชื่อลูกค้า
	*/

	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	//exit();
	
	
	
	$sql2 = "SELECT c.cust_name, o.o_id, o.o_cust, o.o_type
			FROM (tb_orders o LEFT JOIN tb_ord_prod orpd ON o.o_id = orpd.o_id) JOIN tb_customer c ON o.o_cust = c.cust_id
			WHERE o.o_status = 5 AND o.o_id > 363 AND o.o_type LIKE '1%' AND orpd.o_id IS NULL

			";
	/* https://topcooling.net/doc/SQLJoin.jpg 
	https://www.itfinities.com/2017/01/join-sql.html

	*/
	
	$result2 = mysql_query($sql2);
	$num2 = mysql_num_rows($result2);
	
	
	
	
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
		
		if($row['nub_item'] < 70){
			//$string .= $value . " AND ";
			$intro = "ออเดอร์ปิดงาน แต่ยังลงเบิกของไม่ครบ \n";
			$string .= ' - '.$row['cust_name'].' ('.$row['orderid'].') '."\n";	
		}
	}
	
	for($i=1; $i<=$num2; $i++){
		$row2 = mysql_fetch_array($result2);
		
		$intro2 = "\n\nออเดอร์ปิดงานแล้ว แต่ยังไม่ลงเบิกของเลย \n";
		$string2 .= ' - '.$row2['cust_name'].' ('.$row2['o_id'].') '."\n";	
		
	}
	
	$msg = $intro.$string.$intro2.$string2;
	
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




