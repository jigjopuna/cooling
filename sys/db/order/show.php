<?php 
	require_once('../../include/connect.php'); 
	$today = date("Y-m-d");
	$yearmonth = date("Y-m");
	$day = date("D");
	$sql = "SELECT COUNT(*) count FROM tb_orders WHERE o_type LIKE '1%' AND o_date LIKE '$yearmonth%'";
	$row = mysql_fetch_array(mysql_query($sql));
	
	$countorder = $row['count'];
	
	if($countorder > 10){
		$msg = ' ยอดขายปี 2564 รวม 39,086,500.00 บาท  จะไปเที่ยวไหนกันดี';
	}else{
		$remain = 10-$countorder;
		$msg = ' ยอดขายปี 2564 รวม 39,086,500.00 บาท  จะไปเที่ยวไหนกันดี';
	}
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
	//define('LINE_TOKEN','DVkXOmyzLiMaXMhF8Ppoim48pl1A7foQgMTCsz1olfr');  //กลุ่ม เอกสาร   CPN
	//define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt');  //ไลน์ปู jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt  
	define('LINE_TOKEN1','rnkNl937MsFP8QGVRf4nKZQ0OIspR6MaVXe6GZdrE9G');  //กลุ่ม เอกสาร   CPN
	
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
		$res = json_decode($result);
		return $res;
	}
	
	$res = notify_message($msg);
	$res1 = notify_message1($msg);

?>
</body>
</html>     




