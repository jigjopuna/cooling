<?php session_start(); 
    require_once('../../include/connect.php');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	$sql = "SELECT e_id FROM tb_emp ORDER BY e_id";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	/*
	   จะ Listพนักงานทั้งหมดที่อยู่ในตารางออกมา ต้องเรียงตาม id จาก 1 ไปเรื่อยๆ ตัวเลขห้ามหายนะ เพราะจะเทียบค่ากับค่า i ที่เพิ่มขึ้นทีละ 1 
	  เนื่องจากว่าในแบบฟอร์มหน้า working.php จะแสดงพนังงานที่ publish อยู่เท่านั้น ซึ่งพนักงานที่ publish อยู่นี้ เลข id จะโดดข้ามได้ 
	  ถ้าโดดข้าม เลขพนักงานจะไม่ตรงกับค่า i ทำให้ข้อมูลผิดพลาดได้
	  
	  ฉะนั้นตอนเพิ่มพนักงานห้ามข้ามตัวเลข
	*/
	for($i=1; $i<=$num; $i++){
		$row = mysql_fetch_array($result);
		$emp_id = 'emp'.$row['e_id'];
		//echo $emp_id."<br>";
		$varemp = 'emp'.$i;
		$varot = 'ot'.$i;
		$varadv = 'adv'.$i;
		$varnote = 'note'.$i;
		$varhalfday = 'halfday'.$i;
		//echo 'emp'.$i.": ". trim($_POST[$varemp]).'<br>'; 
		
		//$employee = array();
		if($emp_id==$varemp){
			echo 'ok'.'<br>';
			echo $emp_id.' '.$varemp.' '.$varot.' '.$varadv.' '.$varnote.' '.$varhalfday.'<br>';
			
			
			//ถ้าการทำงานมากกว่า 0 
			if(trim($_POST[$varemp]) > 0){
				//$employee = trim($_POST[$varemp]);
				//$employee[] = array("workstatus"=>trim($_POST[$varemp]));
				$employee[] = array($i,trim($_POST[$varemp]),trim($_POST[$varot]),trim($_POST[$varadv]),trim($_POST[$varnote]),trim($_POST[$varhalfday]));
				/*
				
					https://stackoverflow.com/questions/45168714/push-data-into-array-with-for-loop
					
					$employee[x][y];
					[x] คือจำนวนพนักงาน หรือ index ของ array นั่นเองเริ่มจาก 0 เสมอ เพราะ array index เริ่มจาก 0
					[y] คือข้อมูล
					0: {
						0: "2",  เลขประจำตัวพนักงาน
						1: "3", สถานะการทำงาน
						2: "1", โอที ชม.
						3: "", เบิกล่วงหน้า
						4: "", หมายเหตุ
						5:"" ลาครึ่งวัน
						},
					1: {
						0: "2",
						1: "3",
						2: "1",
						3: "2000",
						4: "หมายเหตุ",
						5: ""ลาครึ่งวัน
						},
				*/
			}
		}else{
			echo 'no data'; echo '<br>';
			echo $emp_id.' '.$varemp.'<br>';
		}
	}

	print_r($employee);
	$countemp = count($employee);
	$countvar = count($employee[0]);
	
	echo '<br><br><br> นับตัวแปรข้อมูลทั้งหมดของพนักงาน 1 คน  : '.$countvar.'<br>';
	echo ' นับพนักงานทั้งหมด : '.$countemp.'<br><br><br>';
	//echo $employee[0][2];
	
	
	for($i=0; $i<$countemp; $i++){
		//echo '<br>'.'พนักงานที่ : '.$employee[$i][0].' สถานะการทำงาน: '.$employee[$i][1].' โอที: '.$employee[$i][2].' เบิกล่วงหน้า : '.$employee[$i][3].' หมายเหตุ: '.$employee[$i][4].'<br>';
		$a0 = $employee[$i][0];
		$a1 = $employee[$i][1];
		$a2 = $employee[$i][2];
		$a3 = $employee[$i][3];
		$a4 = $employee[$i][4];
		$a5 = $employee[$i][5];
		
		if($a5=='on'){ $a55 = 1; } else { $a55 = 0; }
		$sqlwork = "INSERT INTO tb_workday SET 
						wd_emp = '$a0', 
						wd_work = '$a1', 
						wd_ot = '$a2', 
						wd_advance = '$a3', 
						wd_note = '$a4', 
						wd_halfday = '$a55',  
						wd_day = now
					";
		$resultwork = mysql_query($sqlwork);
	}
	
	if($resultwork) {
		exit("<script>alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');window.location='../../finance/working1.php';</script>");
	} else {
		exit("<script>alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ');window.location='../../finance/working1.php';</script>");
	}	
	

?>
</body>
</html>     