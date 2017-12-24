<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	require_once('../include/connect.php');
	define('LINE_API',"https://notify-api.line.me/api/notify");
	define('LINE_TOKEN','FqDeF0S1QKAO0K5R5ziEgjk5XbUeK7SIp7OYMOKPcHf');
	
	$dates = date("Y-m-d");

	include('../include/sql_report1.php');
	
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
	
	$msg = "\nสรุปประวันที่ : ".$dates."\nวันนี้เงินเข้าแยกตามคน \n".$income1."\n\nรวมเงินเข้าทั้งหมดวันนี้ ". $incomes ." บาท \n". "ค่าใช้จ่ายเงินสดวันนี้ \n". $paycash. " \n\nเครดิตวันนี้ : " .$paycredit. " \nคงค้างเครดิต : " .$remain1. "\n\nรวมค่าใช้จ่ายทั้งหมดวันนี้ ".$paydates. "บาท"."\nเงินกองกลางเหลือ ".$cur_cash." บาท"."\n\nดูรายละเอียดได้ที่ \nwww.topcooling.net/sys/index.php";
	//echo $msg;
	//exit();
	$res = notify_message($msg);
	var_dump($res);
	echo $res;
	
?>

</body>
</html>   
