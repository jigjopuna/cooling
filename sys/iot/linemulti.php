<?php 
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");
	//define('LINE_TOKEN','5NyGjwO4G92GOhIYVb6i3jeAu7Uwowx6kBLtjDKsmwZ');
	require_once('inc/333590.php');
	
	
	$arrtemp = array();
	$sum = 0;
	$avg = 0;

	for($i=0; $i<=288; $i++){
		//print_r($data->feeds[$i]->field1);
		$arrtemp[$i] = $data->feeds[$i]->field1;
		
	}
	for($j=0; $j<=sizeof($arrtemp); $j++ ){
		//echo $sum+$arrtemp[$j];
		$sum = $sum+$arrtemp[$j];
	}
	$avg = number_format($sum/sizeof($arrtemp), 2, '.', ',');
	$maxtemp = max(array_values($arrtemp));

	function notify_message($message, $tokens){

		$queryData = array('message' => $message);
		$queryData = http_build_query($queryData,'','&');
		$headerOptions = array(
			'http'=>array(
				'method'=>'POST',
				'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
						  ."Authorization: Bearer ".$tokens."\r\n"
						  ."Content-Length: ".strlen($queryData)."\r\n",
				'content' => $queryData
			)
		);
		$context = stream_context_create($headerOptions);
		$result = file_get_contents(LINE_API,FALSE,$context);
		$res = json_decode($result);
		return $res;
	}
	
	
	$msg = "ห้องเย็นคุณหนึ่ง อุณหภูมิปัจจุบัน ".date("Y-m-d h:i:sa")." ".$tempnow." องศาเซลเซียส"." เฉลี่ย ".$avg." องศา". " สูงสุด ".$maxtemp. " ดูกราฟได้ที่ http://topcooling.net/sys/iot/tempn.php";
	$msg1 = "ทดสอบ";
	$res = notify_message($msg, $token);
	$res = notify_message($msg1, $token1);
	var_dump($res);
	echo $res;
	
?>
