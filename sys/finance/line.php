<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	require_once('../include/connect.php');
	define('LINE_API',"https://notify-api.line.me/api/notify");
	define('LINE_TOKEN','yyt9GuxI6UWyOqGzbDgJbc5rfL5qtOYsLzoD8UbsA76');
	
	$dates = date("Y-m-d");
	$arrstring = array();
	$arrcredit = array();
	$arrremain = array();
	
	// ซื้อของจ่ายเงินสด หรือ สำรองจ่ายไปก่อน
	$sql_cash = "SELECT e.e_id, e.e_name, SUM(po_price) poprice1 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE p.po_date = '$dates' AND p.po_credit != 1 GROUP BY po_buyer";
	$result_cash = mysql_query($sql_cash );
	$num_cash = mysql_num_rows($result_cash);
	
	// ซื้อของแบบเครดิต ยังไม่จ่ายเงิน
	$sql_credit = "SELECT e.e_id, e.e_name, SUM(po_price) poprice1 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE p.po_date = '$dates' AND p.po_credit = 1 GROUP BY po_buyer";
	$result_credit = mysql_query($sql_credit);
	$num_credit = mysql_num_rows($result_credit);
	
	//ยอดเงินเข้าทั้งหมดวันนี้รวมของทุกคน
	$in_come = mysql_fetch_array(mysql_query("SELECT SUM(pay_amount) income FROM tb_ord_pay WHERE pay_date = '$dates' "));
	$incomes = number_format($in_come['income'], 0, '.', ',');
	
	
	//เงินเข้าวันนี้แยกตามคนรับเงิน
	$sql_income = "SELECT e.e_id, e.e_name, SUM(pay_amount) income FROM tb_ord_pay ord JOIN tb_emp e ON e.e_id = ord.o_emp_receive WHERE pay_date = '$dates' GROUP BY ord.o_emp_receive";
	$result_income = mysql_query($sql_income);
	$num_income = mysql_num_rows($result_income);

	//เครดิตคงค้างที่ยังไม่ได้จ่าย
	$sql_remain = "SELECT e.e_id, e.e_name, SUM(po_price) poprice2 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE p.po_credit = 1 AND p.po_credit_complete != 1 GROUP BY po_buyer";
	$result_remain = mysql_query($sql_remain);
	$num_remain = mysql_num_rows($result_remain);

	//เงินกองกลางคงเหลือ
	$monery = mysql_fetch_array(mysql_query("SELECT cash_now FROM tb_cash_center ORDER BY cash_id DESC LIMIT 0,1"));
	$cur_cash = number_format($monery['cash_now'], 0, '.', ',');
	
	//ค่าใช้จ่ายทั้งหมดวันนี้ทั้ง เงินสดและเครดิต
	$sumdates = mysql_fetch_array(mysql_query("SELECT SUM(po_price) paydates FROM tb_po WHERE po_date = '$dates'"));
	$paydates = number_format($sumdates['paydates'], 0, '.', ',');
	

	for($i=1; $i<=$num_cash; $i++){
		$row_cash = mysql_fetch_array($result_cash);
		$arrstring[$i] = $row_cash['e_name'].' : '.number_format($row_cash['poprice1'], 0, '.', ',').' บาท ';					
		$paycash = $arrstring[1].$arrstring[2].$arrstring[3].$arrstring[4];

	}

	for($i=1; $i<=$num_credit; $i++){
		$row_credit = mysql_fetch_array($result_credit);
		$arrcredit[$i] = $row_credit['e_name'].' : '.number_format($row_credit['poprice1'], 0, '.', ',').' บาท ';					
		$paycredit = $arrcredit[1].$arrcredit[2].$arrcredit[3].$arrcredit[4];

	}	
	
	for($i=1; $i<=$num_remain; $i++){
		$row_remain = mysql_fetch_array($result_remain);
		$arrremain[$i] = $row_remain['e_name'].' : '.number_format($row_remain['poprice2'], 0, '.', ',').' บาท ';					
		$remain1 = $arrremain[1].$arrremain[2].$arrremain[3].$arrremain[4];

	}
	
	for($i=1; $i<=$num_income; $i++){
		$row_income = mysql_fetch_array($result_income);
		$arrincome[$i] = $row_income['e_name'].' : '.number_format($row_income['income'], 0, '.', ',').' บาท ';					
		$income1 = $arrincome[1].$arrincome[2].$arrincome[3].$arrincome[4];

	}


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
	
	$msg = "\nสรุปประวันที่ : ".$dates."\nวันนี้เงินเข้าแยกตามคน \n".$income1."\n\nรวมเงินเข้าทั้งหมดวันนี้ ". $incomes ." บาท \n". "ค่าใช้จ่ายเงินสดวันนี้ \n". $paycash. " \n\nเครดิตวันนี้ : " .$paycredit. " \nคงค้างเครดิต : " .$remain1. "\n\nรวมค่าใช้จ่ายทั้งหมดวันนี้ ".$paydates. "บาท"."\nเงินกองกลางเหลือ ".$cur_cash." บาท";
	//echo $msg;
	//exit();
	$res = notify_message($msg);
	var_dump($res);
	echo $res;
	
?>

</body>
</html>   
