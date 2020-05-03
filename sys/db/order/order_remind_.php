<?php 
	require_once('../../include/connect.php'); 
	$today = date("Y-m-d");
	$yearmonth = date("Y-m");
	$day = date("D");
	$sql = "SELECT COUNT(*) count FROM tb_orders WHERE o_date LIKE '$yearmonth%'";
	$row= mysql_fetch_array(mysql_query($sql));
	$countorder = $row['count'];
	
	/*
	SELECT c.cust_name, p.pro_name, ot.ort_name, o.o_price
	FROM ((tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust) 
		  JOIN province p ON p.id = o.o_cuprovin) 
		  JOIN tb_ord_type ot ON ot.ort_type = o.o_type 
	WHERE o_date like '%2019-08%'
	*/
	
	if($countorder > 10){
		$msg = 'ยินดีด้วยจร้าเดือนนี้ทะลุทะลวงเป้าได้ จะไปเที่ยวไหนกันดี';
	}else{
		$remain = 10-$countorder;
		$msg = "\n".'เดือนนี้ได้  '.$countorder.' ห้องแล้วนะ '."\n".'เก่งจุงเบย';
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
	define('LINE_TOKEN','rnkNl937MsFP8QGVRf4nKZQ0OIspR6MaVXe6GZdrE9G');  
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




