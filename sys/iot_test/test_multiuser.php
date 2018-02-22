<html lang="en">
<head>
	<meta charset="utf-8">
</head>
	<body>
	<?php 
		date_default_timezone_set("Asia/Bangkok");
		require_once('../include/connect.php');
		define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt');
		$sql = "SELECT cust_name, cust_iot_ch, cust_token, cust_url, cust_maxtemp, cust_mintemp, cust_periodtemp FROM tb_customer WHERE cust_iot_ch != ''";
		$result= mysql_query($sql);
		$num = mysql_num_rows($result);
		
		date_default_timezone_set("Asia/Bangkok");	
		define('LINE_API',"https://notify-api.line.me/api/notify");
		
		$arrtemp = array();
		$sum = 0;
		$avg = 0;
		echo "num : ".$num."<br>";
		
		for($i=1; $i<=$num; $i++){
			$row = mysql_fetch_array($result);
			$max_temp = $row['cust_maxtemp'];
			$min_temp = $row['cust_mintemp'];
			$time_period = $row['cust_periodtemp']*12;
			$chanalapi = $row['cust_iot_ch'];
			
			$json_url = "https://api.thingspeak.com/channels/".$chanalapi."/feeds.json?results=".$time_period;
			$json = file_get_contents($json_url);
			$data = json_decode($json);
			$tempnow = $data->feeds[0]->field1;
			echo $json_url."<br>";
			
			for($k=0; $k<=$time_period; $k++){
				$arrtemp[$k] = $data->feeds[$k]->field1;							
			}
			

			
			
			$msg = "  คุณ ".$row['cust_name']." ".sizeof($arrtemp);
			
			//$res = notify_message($msg, $row['cust_token']); //Send to Customer
			$res1 = notify_tp($msg);	
		}
		
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
		
		function notify_tp($message){
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

	?>
	</body>
</html>