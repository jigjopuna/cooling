<!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<?php 
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");
	define('LINE_TOKEN','2UhB3XtIL2zPJLAm38RLHioi9OMup0D71zaewNOO2UB');
	
	$periodset = 72;
	$hours = 5;
	$json_url = "https://api.thingspeak.com/channels/346872/feeds.json?results=$periodset";
	$json = file_get_contents($json_url);
	$data = json_decode($json);
	
	$json_url1 = "https://api.thingspeak.com/channels/346872/feeds.json?results=1";
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
	
	
	echo '<br>  periodset : '.$periodset;
	echo '<br>  day0 : '.$day1;
	echo '<br>  day1 : '.$day2;
	echo '<br>  day2 : '.$day3;
	
	echo '<br>  time1 : '.$time1;
	echo '<br>  time2 : '.$time2;
	echo '<br>  time3 : '.$time3;
	
	

	//Think Speck Time Server
	echo '<br> thinkspeck time : '.$splitday.' : '.$splittime.'<br>';
	
	//Hostinger Time Server
	$dates = date('Y-m-d H:i:s');
	echo '<br>  hostinger time : '.$dates;
	
	
	for($k=0; $k<=$periodset; $k++){
		$arrdate[$k] = $data->feeds[$k]->created_at;
		$arrtemp[$k] = $data->feeds[$k]->field1;			
		//echo '<br><br>'.$arrdate[$k]."<br>";				
	}
	//เวลาย้อนหลัง
	$spd = explode("T", $arrdate[0]);
	$predate = $spd[0];
	$pretime = rtrim($spd[1],"Z");
	
	$d2 = explode("-", $predate);
	$t2 = explode(":", $pretime);
	
	//เวลาล่าสุด
	$spd11 = explode("T", $arrdate[$periodset-1]);
	$postdate = $spd11[0];
	$postime = rtrim($spd11[1],"Z");
	
	$d3 = explode("-", $postdate);
	$t3 = explode(":", $postime);
	
	echo '<br>'.$pretime.'<br>'.$d2[0].'-'.$d2[1].'-'.$d2[2].' | '.$t2[0].'-'.$t2[1].'-'.$t2[2];
	echo '<br><br>'.$postime.'<br>'.$d3[0].'-'.$d3[1].'-'.$d3[2].' | '.$t3[0].'-'.$t3[1].'-'.$t3[2];
	$a = (int)$d3[2];
	$b = (int)$d2[2];
	$diffday = $a-$b;
	$c = (int)$t3[0];
	$d = (int)$t2[0];
	$difftime = $c - $d;
	//ถ้าวันเดียวกัน ok แต่ถ้าคนละวันต้องเช็คต่อว่า เวลานั้นห่างกันตามจำนวนชั่วโมงที่กำหนดไว้หรือเปล่า
	if($predate==$postdate){ 
		echo '<br>the same';
		//a();
	} else {
		//echo '<br>44444<br>'.$d2[2].' | '. $d3[2].' : '.$diffday;
		if($diffday > 1){ //ผลต่างของวันที่ ต่างกันมากกว่า 1 วัน แสดงว่า ลูกค้าปิด wifi หรือ IoT มีปัญหา
			echo 'เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล'; 
		}else if($diffday == 1) {
			/*
				เข้าเงื่อนไขหมายถึงข้ามวันไปแล้วแต่อาจจะอยู่ในช่วงตี1 ตี2 ตี3 คือความห่างของช่วงเวลาอยู่อยู่ในช่วง เวลาปัจจุบันเทียบกับ $hours ชัวโมงที่ตั้งค่าไว้
			
			*/
			
			/* 		    24    
			
			       23		01
			     
			    22				02
			  
			21						03
			
			   20				04

				  19        05
				
					   18
					   
			
			3 ชั่วโมง
			ตี 1   01	22	=	-21
			ตี 2   02	23	=	-21
			ตี3    03	00	=	3
			
			4 ชั่วโมง
			ตี 1   01	21	=	-20
			ตี 2   02	22	=	-20
			ตี3    03	23	=	-20
			ตี4    04	00	=	4
			
			5 ชั่วโมง                                                                        6 ชั่วโมง
			ตี 1   01	20	=	-19			ตี1      01	19	=	-18
			ตี 2   02	21	=	-19			ตี2      02	20	=	-18
			ตี3    03	22	=	-19			ตี3      02	21	=	-18
			ตี4    04	23	=	-19			ตี4      04	22	=	-18
			ตี5    05	00	=	5			ตี5      05	23	=	-18
										ตี6      06	00	=	6
	
			*/
			echo '<br> | '.$t3[0].' | '.$t2[0]. ' : '.$difftime;
			if($hours==3){
				if($t3[0]-$t2[0] <= -21){
					echo '<br>in time';
				}else{
					echo '<br>in time';
				}
			}else if ($hours==4){
				if($difftime <= -20){
					process();
				}else{
					echo '<br>เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล';
				}
			}else if ($hours==5){
				if($difftime <= -19 || $difftime==$hours){
					process();
				}else{
					echo '<br>เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล';
				}
			}else if ($hours==6){
				
				if($difftime <= -18 || $difftime==$hours){
					process();
				}else{
					echo '<br>เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล';
				}
			}
			
		}
	}
	/*echo '<br><br>'.$arrdate[0].' | '.$arrdate[$periodset-1];
	echo '<br><br>'.$arrtemp[0].' | '.$arrtemp[$periodset-1];*/
	
	
	function process(){
		echo '<br>in process<br>';
	}	
			
	exit();
	
	/*
		1 ชม. = 12  point
		2 ชม. = 24 
		4 ชม. = 48
		6 ชม. = 72
	
	set point  -15 ภายใน 3 ชม.
	 
	6 ชม. เอาค่าแรกกับค่าสุดท้าย เช่น 20, -5  ต่างกัน 25
	               20, 11 
		
	ปัญหา
	1. ถ้าลูกค้าปิด wifi จะนับยังไง 
	*/
	
	
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
	
	
	$msg = "ห้องเย็นอุณหภูมิปัจจุบัน ".date("Y-m-d h:i:sa")." ".$tempnow." องศาเซลเซียส"." เฉลี่ย ".$avg." องศา". " สูงสุด ".$maxtemp. " ดูกราฟได้ที่ http://topcooling.net/sys/iot/tempcha.php";
	$res = notify_message($msg);
	var_dump($res);
	echo $res;
	
?>
</body>
</html>