<?php 
	require_once('../include/connect.php'); 
	$today = date("Y-m-d");
	$yearmonth = date("Y-m");
	$day = date("D");
	
	$credit = mysql_fetch_array(mysql_query("SELECT SUM(p.po_price)-SUM(p.po_mudjum) jaycredit FROM tb_po p WHERE p.po_credit = 1 AND p.po_credit_complete != 1 AND p.po_date LIKE '2019%'"));

	$payin = mysql_fetch_array(mysql_query("SELECT SUM(s.sub) total FROM (
			SELECT c.cust_name, oid, o_cust, payamount, o_price, sub 
			FROM tb_customer c JOIN (
				SELECT o.o_id oid, o.o_cust, b.o_id, b.payamount, o.o_price,  o.o_price - b.payamount as sub
				FROM tb_orders o JOIN (
					 SELECT o_id, SUM(pay_amount) as payamount
					 FROM tb_ord_pay 
					 GROUP BY o_id) AS b
					WHERE o.o_id = b.o_id AND o.o_status != 5) AS t
				WHERE c.cust_id = t.o_cust
			) as s
		"));
		
	$yodcredit = $credit['jaycredit'];
	$yodin = $payin['total'];
	$yodjaycredit = $yodcredit-$yodin;
	
	
	
	
	$msg = "\n".'ยอดเครดิตทั้งหมด : '.number_format($yodcredit, 2, '.', ',')."\n".'ยอดเงินเข้าทั้งหมด : '.number_format($yodin, 2, '.', ',')."\n".'ยอดเครดิตที่ต้องจ่าย '.number_format($yodjaycredit, 2, '.', ',')."\n\n".'ยอดเครดิต สิ้นเดือน : '."\n".'ยอดซื้อของทำงานให้ครบ : ';
	
	
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
	define('LINE_TOKEN','p2BasIGUuINUyaOj4HnR3PDEzHiQ1EkLzTXWkeFY2sC');  
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
	
	$res = notify_message($msg);

?>
</body>
</html>     




