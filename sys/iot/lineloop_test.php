<html lang="en">
<head>
	<meta charset="utf-8">
</head>
	<body>
	<?php 
		date_default_timezone_set("Asia/Bangkok");
		require_once('../include/connect.php');
		define('LINE_TOKEN','lEFvu2sU1pK5JnhkZkjN17ULJzBQBqC7swCWx05FEB9');
		$sql = "SELECT cust_nickname, cust_iot_ch, cust_token, cust_url FROM tb_customer WHERE cust_iot_ch != ''";
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
			$json_url = "https://api.thingspeak.com/channels/".$row['cust_iot_ch']."/feeds.json?results=288";
			$json = file_get_contents($json_url);
			$data = json_decode($json);
			$tempnow = $data->feeds[0]->field1;
			echo $json_url."<br>";
			
			
			for($k=0; $k<=287; $k++){
				$arrtemp[$k] = $data->feeds[$k]->field1;			
				//echo $arrtemp[$k].",";				
			}
			
			for($j=0; $j<=sizeof($arrtemp); $j++ ){
				$sum = $sum+$arrtemp[$j];
				//echo "<br> sum in loop : ".$sum;
			}
			
			echo "sum : ".$sum." | <br>";
			$avg = number_format($sum/sizeof($arrtemp), 2, '.', ',');
			$maxtemp = max(array_values($arrtemp));
			$mintemp = min(array_values($arrtemp));
			echo "mintemp : ".$mintemp."<br>";
			
			echo "avg : ".$avg."<br>";
			echo "maxtemp : ".$maxtemp."<br>";
			echo " <br>";
			//$msg = "ห้องเย็นคุณ".$row['cust_nickname']."อุณหภูมิเฉลี่ยวันนี้ ".$avg." องศาเซลเซียส". " สูงสุด ".$maxtemp. " ดูกราฟได้ที่ http://topcooling.net/sys/iot/tempn.php";		
			$msg = "สวัสดีค่ะ \nรายงานอุณหภูมิห้องเย็น \nประจำวันที่ ".date("d-m-Y")."\nเวลา ".date("H:i")." น.\n\nห้องเย็นคุณ".$row['cust_nickname']."\nอุณหภูมิปัจจุบัน ".$tempnow." องศาเซลเซียส\n\n"."ข้อมูล 24 ชม. ล่าสุด \nเฉลี่ย ".$avg." องศา". "\nสูงสุด ".$maxtemp." องศา". "\nต่ำสุด ".$mintemp." องศา". "\n\nดูกราฟได้ที่ http://topcooling.net/sys/iot/".$row['cust_url'];
	
			//$res = notify_message($msg, $row['cust_token']); //Send to Customer
			$res1 = notify_tp($msg); //Send to TP topcoolint 
			$sum = 0;
			
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