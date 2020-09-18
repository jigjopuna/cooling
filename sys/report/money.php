<?php 
	require_once('../include/connect.php'); 
	$today = date("Y-m-d");
	$yearmonth = date("Y-m");
	$day = date("D");
	
	$credit = mysql_fetch_array(mysql_query("SELECT SUM(p.po_price)-SUM(p.po_mudjum) jaycredit FROM tb_po p WHERE p.po_credit = 1 AND p.po_credit_complete != 1"));

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
	
	
	
	
	$seven7 = mysql_fetch_array(mysql_query("SELECT SUM(duplicate.remains) tongjay7 FROM ( SELECT po_name, po_price, po_mudjum, po_price-po_mudjum remains FROM tb_po WHERE po_credit_due_date >= curdate() AND po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 7 day) AND po_credit = 1 AND po_credit_complete = 0 ) AS duplicate"));
	$jay7 = $seven7['tongjay7'];
	
	$seven14 = mysql_fetch_array(mysql_query("SELECT SUM(duplicate.remains) tongjay14 FROM ( SELECT po_name, po_price, po_mudjum, po_price-po_mudjum remains FROM tb_po WHERE po_credit_due_date >= curdate() AND po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 14 day) AND po_credit = 1 AND po_credit_complete = 0 ) AS duplicate"));
	$jay14 = $seven14['tongjay14'];
	
	$seven30 = mysql_fetch_array(mysql_query("SELECT SUM(duplicate.remains) tongjay30 FROM ( SELECT po_name, po_price, po_mudjum, po_price-po_mudjum remains FROM tb_po WHERE po_credit_due_date >= curdate() AND po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 60 day) AND po_credit = 1 AND po_credit_complete = 0 ) AS duplicate"));
	$jay30 = $seven30['tongjay30'];
	
	
	
	$msg = "\n".'ยอดเครดิตทั้งหมด : '.number_format($yodcredit, 2, '.', ',')."\n".
	'ยอดเงินเข้าทั้งหมด : '.number_format($yodin, 2, '.', ',')."\n".
	'ยอดเครดิตที่ต้องจ่าย '.number_format($yodjaycredit, 2, '.', ',')."\n\n".
	'อีก 7 วัน จ่าย '.number_format($jay7, 2, '.', ',')."\n".
	'อีก 14 วัน จ่าย '.number_format($jay14, 2, '.', ',')."\n".
	'อีก 30 วัน จ่าย '.number_format($jay30, 2, '.', ',')."\n\n".
	'https://topcooling.net/sys/report/print/credit_remind.php'.
	"\n\n".'ยอดเครดิต สิ้นเดือน : '."\n".'ยอดซื้อของทำงานให้ครบ : ';
	
	
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
	//define('LINE_TOKEN','p2BasIGUuINUyaOj4HnR3PDEzHiQ1EkLzTXWkeFY2sC');  
	define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt'); 
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




