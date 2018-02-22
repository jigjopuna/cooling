<?
			//เช็คก่อนว่าวันเดียวกันไหม ถ้าคนละวันก็จบเลย ไม่ต้องอะไรต่อ
			if($splitday==$curdate){ //วันเดียวกัน
				$json_url = "https://api.thingspeak.com/channels/".$chanalapi."/feeds.json?results=".$time_period;
				$json = file_get_contents($json_url);
				$data = json_decode($json);
				$tempnow = $data->feeds[0]->field1;
				echo $json_url."<br>";
				
				for($k=0; $k<=$time_period; $k++){
					$arrdate[$k] = $data->feeds[$k]->created_at;
					$arrtemp[$k] = $data->feeds[$k]->field1;							
				}
				
				include('inc_timeprevious.php');
				
				//ถ้าวันเดียวกัน ok แต่ถ้าคนละวันต้องเช็คต่อว่า เวลานั้นห่างกันตามจำนวนชั่วโมงที่กำหนดไว้หรือเปล่า
				if($predate==$postdate){ 
					$msg = "  คุณ ".$row['cust_name']." ".sizeof($arrtemp);
					//$res = notify_message($msg, $row['cust_token']); //Send to Customer
					$res1 = notify_tp($msg);
				}
				
				
			}else{			
				$msg = $row['cust_name']." จร้า";
				$res1 = notify_tp($msg);
			}
?>