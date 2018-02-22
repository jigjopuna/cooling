<?php 
			echo '<br>คนละวัน วันก่อนหน้า : '.$d2[2].' |วันปัจจับัน : '. $d3[2].' เวลาห่าง  '.$diffday.'วัน';
			if($diffday > 1){ //ผลต่างของวันที่ ต่างกันมากกว่า 1 วัน แสดงว่า ลูกค้าปิด wifi หรือ IoT มีปัญหา
				echo 'เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล'; 
			}else if($diffday == 1) {
				/*
					เข้าเงื่อนไขหมายถึงข้ามวันไปแล้วแต่อาจจะอยู่ในช่วงตี1 ตี2 ตี3 คือความห่างของช่วงเวลาอยู่อยู่ในช่วง เวลาปัจจุบันเทียบกับ $rank_timeh ชัวโมงที่ตั้งค่าไว้
				
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
				echo '<br> H '.$t3[0].' | '.$t2[0]. ' : '.$difftime;
				echo '<br> rank_timeh : '.$rank_timeh.'<br>';
				if($rank_timeh==3){
					if($t3[0]-$t2[0] <= -21){
						echo '<br>in time -21';
					}else{
						echo '<br>in time -21 1';
					}
				}else if ($rank_timeh==4){
					if($difftime <= -20){
						process($arrtemp, $time_period, $min_temp, $custname, $cust_tel, $cust_location, $cust_url);
					}else{
						echo '<br>เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล -20';
					}
				}else if ($rank_timeh==5){
					if($difftime <= -19 || $difftime==$rank_timeh){
						process($arrtemp, $time_period, $min_temp, $custname, $cust_tel, $cust_location, $cust_url);
					}else{
						echo '<br>เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล -19';
					}
				}else if ($rank_timeh==6){
					
					if($difftime <= -18 || $difftime==$rank_timeh){
						process($arrtemp, $time_period, $min_temp, $custname, $cust_tel, $cust_location, $cust_url);
					}else{
						echo '<br>เก็บข้อมูลไม่ครบอาจเกิดจากการปิด wifi หรือ ตัว IoT มีปัญหา กรุณาติดต่อผู้ดูแล -18';
					}
				}
				
			}
?>