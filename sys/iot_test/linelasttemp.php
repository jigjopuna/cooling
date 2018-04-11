<html lang="en">
<head>
	<meta charset="utf-8">
</head>
	<body>
	<?php 
		date_default_timezone_set("Asia/Bangkok");
		require_once('../include/connect.php');
		$sql = "SELECT cust_name, cust_iot_ch, cust_token, cust_url FROM tb_customer WHERE cust_iot_ch != '' AND cust_notify=1 AND cust_token != ''";
		$result= mysql_query($sql);
		$num = mysql_num_rows($result);
		
		date_default_timezone_set("Asia/Bangkok");	
		define('LINE_API',"https://notify-api.line.me/api/notify");
		
		
		for($i=1; $i<=$num; $i++){
			$row = mysql_fetch_array($result);
			$json_url = "https://api.thingspeak.com/channels/".$row['cust_iot_ch']."/feeds.json?results=1";
			$json = file_get_contents($json_url);
			$data = json_decode($json);
			
			$tempnow = $data->feeds[0]->field1;
			$createat = $data->feeds[0]->created_at;
			$splitdate = explode("T", $createat);
			$splitday = $splitdate[0];
			$splittime = rtrim($splitdate[1],"Z");
			//echo $row['cust_name'].$tempnow; echo "<br>"; echo $createat; echo "<br><br>";
			$d1 = explode("-", $splitday);
			$t1 = explode(":", $splittime);
			
			//echo '<br>name '.$custname.'<br>  splitday : '.$splitday; echo '<br>  splittime : '.$splittime.' <br>curdate :'.$curdate; echo '<br>  time_period : '.$time_period;echo '<br>  day0 : '.$day1;echo '<br>  day1 : '.$day2;echo '<br>  day2 : '.$day3;echo '<br><br>  time1 : '.$time1; echo '<br>  time2 : '.$time2; echo '<br>  time3 : '.$time3;
			$linetokenn = "xJjue2hdFrLlCzSJF6xIDJqtr94vMBQrt4Xg7SLQkyC";
			$msg = "ห้องเย็นคุณ ".$row['cust_name']."\n"."อุณหภูมิล่าสุด\n".$splitday." : ".$splittime."\n\n".$tempnow." องศาเซลเซียส"."\n\n"."ดูกราฟ\n"."http://topcooling.net/sys/iot/".$row['cust_url'];
			
			$res = notify_message($msg, $linetokenn);
			$res1 = notify_cust($msg, $row['cust_token']); //Send to TP topcoolint 
			echo $msg.'<br>';

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
		
		function notify_cust($message, $toke){
			$queryData = array('message' => $message);
			$queryData = http_build_query($queryData,'','&');
			$headerOptions = array(
				'http'=>array(
					'method'=>'POST',
					'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
							  ."Authorization: Bearer ".$toke."\r\n"
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