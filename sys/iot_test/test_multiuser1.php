<html lang="en">
<head>
	<meta charset="utf-8">
</head>
	<body>
	<?php 
		date_default_timezone_set("Asia/Bangkok");
		define('LINE_API',"https://notify-api.line.me/api/notify");
		
	   
	    $host = 'localhost';
        $user = 'u175850674_top';
        $pass = 'top18553';
        $db = 'u175850674_top';
		
	    @$conn = mysql_connect($host, $user, $pass) or exit('server fail');
        mysql_select_db($db, $conn) or die('Not found database');
        mysql_query('set names utf8'); 
	   
		define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt');//send to pu
		
		$sql = "SELECT cust_name, cust_iot_ch, cust_token, cust_url, cust_maxtemp, cust_mintemp, cust_periodtemp, cust_tel, cust_location FROM tb_customer WHERE cust_iot_ch != '' AND cust_notify=1";
		$result= mysql_query($sql);
		$num = mysql_num_rows($result);

		$periodset = 72;
		$hours = $periodset/12;
		$settemp = 0;
		$mintemp = Null;
		

		
		$curdate = date('Y-m-d');
			
		
		for($i=1; $i<=$num; $i++){
			$row = mysql_fetch_array($result);
			$max_temp = $row['cust_maxtemp'];
			$min_temp = $row['cust_mintemp'];
			$rank_timeh = $row['cust_periodtemp'];
			$time_period = $rank_timeh*12;
			$chanalapi = $row['cust_iot_ch'];
			$custname = $row['cust_name'];
			$custoken = $row['cust_token'];
			$cust_tel = $row['cust_tel'];
			$cust_location = $row['cust_location'];
			$cust_url = $row['cust_url'];
			
			$json_url1 = "https://api.thingspeak.com/channels/".$chanalapi."/feeds.json?results=1"; 
			$json1 = file_get_contents($json_url1);
			$data1 = json_decode($json1);
			$tempnow = $data1->feeds[0]->field1;
			
			$createat = $data1->feeds[0]->created_at;
			$splitdate = explode("T", $createat);
			$splitday = $splitdate[0];
			$splittime = rtrim($splitdate[1],"Z");
			

			$d1 = explode("-", $splitday);
			$t1 = explode(":", $splittime);
			
			$day1 = $d1[0];
			$day2 = $d1[1];                                                                             
			$day3 = $d1[2];
			
			$time1 = $t1[0];
			$time2 = $t1[1];
			$time3 = $t1[2];
			
			echo '<br>name '.$custname.'<br>  splitday : '.$splitday; echo '<br>  splittime : '.$splittime.' <br>curdate :'.$curdate; echo '<br>  time_period : '.$time_period;echo '<br>  day0 : '.$day1;echo '<br>  day1 : '.$day2;echo '<br>  day2 : '.$day3;echo '<br><br>  time1 : '.$time1; echo '<br>  time2 : '.$time2; echo '<br>  time3 : '.$time3;
			
			//เช็คก่อนว่าวันเดียวกันไหม ถ้าคนละวันก็จบเลย ไม่ต้องอะไรต่อ
			if($splitday==$curdate){ //วันเดียวกัน
				$json_url = "https://api.thingspeak.com/channels/".$chanalapi."/feeds.json?results=".$time_period;
				$json = file_get_contents($json_url);
				$data = json_decode($json);
				$tempnow = $data->feeds[0]->field1;
				echo '<br>'.$json_url."<br>";
				
				for($k=0; $k<=$time_period; $k++){
					$arrdate[$k] = $data->feeds[$k]->created_at;
					$arrtemp[$k] = $data->feeds[$k]->field1;							
				}
				
				include('inc_timeprevious.php');
				
				//ถ้าวันเดียวกัน ok แต่ถ้าคนละวันต้องเช็คต่อว่า เวลานั้นห่างกันตามจำนวนชั่วโมงที่กำหนดไว้หรือเปล่า
				if($predate==$postdate){ 
					//$msg = "  คุณ ".$row['cust_name']." ".sizeof($arrtemp);
					//$res = notify_message($msg, $row['cust_token']); //Send to Customer
					//$res1 = notify_tp($msg);
					process($arrtemp, $time_period, $min_temp, $custname, $cust_tel, $cust_location, $cust_url);
				}else{
					include('inc_chkday.php');
				}
		
			}else{ //ไม่ใช่วันเดียวกัน หมายถึงไม่ได้ใช้ iot มานานม๊ากกก		
				$msg = $row['cust_name']." wifi ไม่ดีนะจ๊ะ แต่เธอไม่รู้บ้างเลย";
				$res1 = notify_tp($msg);
			}
				
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
		
		
	function process($temparr, $periods, $settem, $cname, $ctel, $clocation, $url){
		   //process($arrtemp, $time_period(72), $min_temp, $custname, $cust_tel, $cust_location);
		$flag = 0;
		echo '<br>flag before:'.$flag."<br>";
		/*$arrtemp[$i] $settemp
			ถ้ามีอุณหภูมิค่าใดค่าหนึ่งในชั่วโมงที่ตั้งค่าไว้ ให้เซ็ต flag +1 
		*/
		for($i=1; $i<=$periods; $i++){
			if($temparr[$i]<$settem){ //  5  || 0
				$flag += 1;	
				echo 'flagin :'.$flag."|";
			}	
		}
		echo 'flag: '.$flag;
		if($flag < 2){
			$rankt = $periods/12;
			$msg = "ห้องเย็นคุณ ".$cname." ไม่ได้อุณหภูมิ ".$settem." องศา ภายใน ".$rankt." ชั่วโมง\n\nโทร ".$ctel."\n"."แผนที่ https://google.co.th/maps?q=".$clocation."\n\n"."ดูกราฟ http://topcooling.net/sys/iot/"."$url";
			//$res = notify_tp($msg);
			$linetokenn = "xJjue2hdFrLlCzSJF6xIDJqtr94vMBQrt4Xg7SLQkyC";
			$res = notify_message($msg, $linetokenn); //Send to Customer	
		}else if ($flag >= 2){
			$msg = "ห้องเย็นคุณ ".$cname." OK ".$settem." องศา Hit: ".$flag;
			$res = notify_tp($msg);	// send to pu
		}
	}

	?>
	</body>
</html>