<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	require_once('../include/connect.php');
	define('LINE_API',"https://notify-api.line.me/api/notify");
	//define('LINE_TOKEN','FqDeF0S1QKAO0K5R5ziEgjk5XbUeK7SIp7OYMOKPcHf'); //กลุ่มเอกสาร
	define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt');
	
	$dates = date("Y-m-d");
	//$dates = '2017-12-21';
	$nkpt = 2;
	$ktb = 3;

	//-------------------------------------------------------------------
	//ซื้อ
	$rowbuynkpt = mysql_fetch_array(mysql_query("SELECT COUNT(po_id) countpo, SUM(po_price) sumpo FROM tb_po WHERE po_date = '$dates' AND po_subyer = $nkpt"));
	$cntbuynkpt = $rowbuynkpt['countpo'];
	$sumbuynkpt = number_format($rowbuynkpt['sumpo'], 0, '.', ',');
	
	
	//เพิ่มสต็อค
	$rowstknkpt = mysql_fetch_array(mysql_query("SELECT SUM(t.t_cost_center) coststk, COUNT(pu.pu_id) countpu FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $nkpt"));
	$cntstknkpt = $rowstknkpt['countpu'];
	$coststknkpt = number_format($rowstknkpt['coststk'], 0, '.', ',');

	//เบิก
	$rowburknkpt = mysql_fetch_array(mysql_query("SELECT COUNT(orpd.orpd_id) countburk, SUM(t.t_cost_center) costburk FROM tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd_date = '$dates' AND orpd_wh = $nkpt"));
	$cntburknkpt = $rowburknkpt['countburk'];
	$costburknkpt = number_format($rowburknkpt['costburk'], 0, '.', ',');
	
	//nktp cash center
	$rowcashnkpt = mysql_fetch_array(mysql_query("SELECT cash1 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cashnkpt = number_format($rowcashnkpt['cash1'], 0, '.', ',');

	//----------------------------------------------------------------
	
	echo "cntbuynkpt : ".$cntbuynkpt."<br>";
	echo "sumbuynkpt : ".$sumbuynkpt."<br><br>";
	
	echo "cntstknkpt : ".$cntstknkpt."<br>";
	echo "coststknkpt : ".$coststknkpt."<br><br>";
	
	echo "cntburknkpt : ".$cntburknkpt."<br>";
	echo "costburknkpt : ".$costburknkpt."<br><br>";
	
	echo "cashnkpt : ".$cashnkpt."<br><br>";
	
	
	
	$rowbuyktb = mysql_fetch_array(mysql_query("SELECT COUNT(po_id) countpo, SUM(po_price) sumpo FROM tb_po WHERE po_date = '$dates' AND po_subyer = $ktb"));
	$cntbuyktb = $rowbuyktb['countpo'];
	$sumbuyktb = number_format($rowbuyktb['sumpo'], 0, '.', ',');
	
	
	//เพิ่มสต็อค
	$rowstkktb = mysql_fetch_array(mysql_query("SELECT SUM(t.t_cost_center) coststk, COUNT(pu.pu_id) countpu FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $ktb"));
	$cntstkktb = $rowstkktb['countpu'];
	$coststkktb = number_format($rowstkktb['coststk'], 0, '.', ',');

	//เบิก
	$rowburkktb = mysql_fetch_array(mysql_query("SELECT COUNT(orpd.orpd_id) countburk, SUM(t.t_cost_center) costburk FROM tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd_date = '$dates' AND orpd_wh = $ktb"));
	$cntburkktb = $rowburkktb['countburk'];
	$costburkktb = number_format($rowburkktb['costburk'], 0, '.', ',');
	
	//nktp cash center
	$rowcashktb = mysql_fetch_array(mysql_query("SELECT cash2 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cashktb = number_format($rowcashktb['cash2'], 0, '.', ',');
	
	
	echo "cntbuyktb : ".$cntbuyktb."<br>";
	echo "sumbuyktb : ".$sumbuyktb."<br><br>";
	
	echo "cntstkktb : ".$cntstkktb."<br>";
	echo "coststkktb : ".$coststkktb."<br><br>";
	
	echo "cntburkktb : ".$cntburkktb."<br>";
	echo "costburkktb : ".$costburkktb."<br><br>";
	
	echo "cashktb : ".$cashktb."<br><br>";
	


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
	
	
	function notify_messagektb($message){

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
		$resktb = json_decode($result);
		return $resktb;
	}
	
	//$msg = "\n\nสรุปประวันที่ : ".$dates."\nวันนี้เงินเข้าแยกตามคน \n".$cntbuynkpt."\n\nรวมเงินเข้าทั้งหมดวันนี้ ". $sumbuynkpt ." บาท \n". "ค่าใช้จ่ายเงินสดวันนี้ \n". $coststknkpt. " \n\nเครดิตวันนี้ : " .$cntburknkpt. " \nคงค้างเครดิต : " .$costburknkpt. "\n\nรวมค่าใช้จ่ายทั้งหมดวันนี้ ".$cashnkpt. "บาท"."\nเงินกองกลางเหลือ ".$cashnkpt." บาท"."\n\nดูรายละเอียดได้ที่ \nhttps://topcooling.net/sys/index.php";
	$msg = "\nสโตร์นครปฐม\nสรุปประวันที่ : ".$dates."\nซื้อ : ".$cntbuynkpt." รายการ  ".$sumbuynkpt." บาท\nใส่สต็อค : ".$cntstknkpt." รายการ  ทุน ".$coststknkpt." บาท\nเบิก : ".$cntburknkpt." รายการ  ทุน ".$costburknkpt." บาท\n\n เงินส่วนกลางนครปฐมเหลือ : ".$cashnkpt." บาท"."\n\nดูรายละเอียดได้ที่ \nwww.topcooling.net/sys/report/reportpo.php";
	$res = notify_message($msg);
	
	
	$msgktb = "\nสโตร์กระทุ่มแบน\nสรุปประวันที่ : ".$dates."\nซื้อ : ".$cntbuyktb." รายการ  ".$sumbuyktb." บาท\nใส่สต็อค : ".$cntstkktb." รายการ  ทุน ".$coststkktb." บาท\nเบิก : ".$cntburkktb." รายการ  ทุน ".$costburkktb." บาท\n\n เงินส่วนกลางกระทุ่มแบนเหลือ : ".$cashktb." บาท"."\n\nดูรายละเอียดได้ที่ \nwww.topcooling.net/sys/report/reportpo.php";
	$resktb = notify_messagektb($msgktb);
	
	
	
	/*var_dump($res);
	echo $res;*/
	
?>

</body>
</html>   
