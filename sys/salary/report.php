<?php session_start();
	  require_once('../include/connect.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once('../include/inc_role.php'); ?>
	<title>เงินเดือน</title>
	<link rel="stylesheet" href="../../css/quotation.css">
	<style>
		.text_strong { font-weight: bold; }
		.text_emunder { text-decoration:underline; font-weight: bold; }
		
		@media print { 
			 #btn-calngod { display: none !important; } 
		}

	</style>
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<script>
</script>

<?php 
	require_once('../include/connect.php');
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	$thatdate = $date."/".$nMonth."/".$year;
	$otrate = 50;
	
	$fday = date("Y-m");
	$todays = date("d");
	$day = date("D");
	
	/*	
		เงินจะคิดเฉพาะในเดือนนั้นๆ จะไม่ข้ามเดือน ฉะนั้นเวลาแสดงก็ต้องแสดงเฉพาะเดือนนั้นๆ 
		จะคิดจากวันที่ 16 กับ วันสิ้นเดือนของเดือนนั้นๆ ถ้าตรงกับวันหยุด (วันอาทิตย์) ให้เลื่อนขึ้นมา
		ถ้าครึ่งเดือนแรกก็ให้เริ่มจากวันที่ 1 ถ้า ครึ่งหลังให้เริ่ม 17
        
	*/
	
	//นับก่อนมีทั้งหมดกี่คน
	$sqlcntemp = "SELECT e_id FROM tb_emp WHERE e_publish = 1 AND e_company != 3";
	$resultcntemp= mysql_query($sqlcntemp);
	$numcntemp = mysql_num_rows($resultcntemp);
	for($i=1; $i<=$numcntemp; $i++){
		$rowcntemp = mysql_fetch_array($resultcntemp);
		$employee[] = array($rowcntemp['e_id']);
	}

	//print_r($employee);
	//echo $numcntemp;

	if($todays <= 16 ){
		$timepay = $fday.'-01';
	}else{
		$timepay = $fday.'-17';
	}

	/*
		echo 'fday: '.$fday.'<br>';
		echo 'todays: '.$todays.'<br>';
		echo 'day: '.$day.'<br>';
		echo 'timepay: '.$timepay.'<br>';
	*/
	
	
	/*for($k=0; $k<$numcntemp; $k++){
		$emp_id = $employee[$k][0];
	}*/
	
?>
</head>
<body>
<div class="book">

  <?php for($j=0; $j<$numcntemp; $j++) { 
	$emp_id = $employee[$j][0];
	$sql = "SELECT w.wd_work, COUNT(w.wd_work) tamngan, SUM(w.wd_ot) tamot, SUM(w.wd_halfday) lakrungwan, SUM(wd_advance) berklongna
			FROM tb_workday w 
			WHERE w.wd_emp = '$emp_id' AND  (w.wd_day BETWEEN '$timepay' AND CURDATE())
			GROUP BY w.wd_work";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sql_detail = "SELECT *  
				FROM tb_workday w
				WHERE w.wd_emp = '$emp_id' AND  (w.wd_day BETWEEN '$timepay' AND CURDATE())
				ORDER BY w.wd_day DESC";
	$result_detail = mysql_query($sql_detail);
	$num_detail = mysql_num_rows($result_detail);
	
	
	
	
	//รวม ot เบิกล่วงหน้า และลาครึ่งวัน
	$result1 = mysql_fetch_array(mysql_query("SELECT COUNT(wd_id) cntallday, SUM(wd_ot) w_ot, SUM(wd_advance) w_advance, SUM(wd_halfday) w_halfday FROM tb_workday WHERE wd_emp = '$emp_id' AND  (wd_day BETWEEN '$timepay' AND CURDATE())")); 
	$cntallday = $result1['cntallday'];
	$sumot = $result1['w_ot'];
	$sumadv = $result1['w_advance'];
	$sumhd = $result1['w_halfday'];
	
	$datework = mysql_fetch_array(mysql_query("SELECT COUNT(wd_emp) cntdaywork FROM tb_workday WHERE wd_work = 1 AND wd_emp = '$emp_id' AND  (wd_day BETWEEN '$timepay' AND CURDATE())"));
	$rowdwork = $datework['cntdaywork'];
	
	$money = mysql_fetch_array(mysql_query("SELECT e_name, e_salary FROM tb_emp WHERE e_id = '$emp_id'"));
	$emp_name = $money['e_name'];
	$salary = $money['e_salary'];
	
	$calsal = $rowdwork*$salary; //รวมเงินเดือน
	$calot = $sumot*$otrate; //รวมโอที
	$calhd = $sumhd*($salary/2); //รวมลาครึ่งวัน
	
	$sum = $calsal+ $calot+ $calhd; //รวมเงินที่ต้องจ่าย ก่อนหักเบิกล่วงหน้า
	$pay = $sum - $sumadv; //หักเบิกล่วงหน้า
	
	
  ?>
    <div class="page">
        <div class="subpage">
            <div id="cover_header">
				<img src="../../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			<div id="product_price" style="margin-top:105px; clear:both">
				<?php 
					echo 'รหัสพนักงาน: '.$emp_id.'<br>';
					echo 'รายการ: '.$num.'<br>';
					echo 'เริ่มนับวันที่: '.$timepay.'<br>';
				?>
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style=" height: 30px; font-size:20px; font-weight:bold; background: #DAD7D7; border: 1px solid black;">เงินเดือน <?php echo $emp_name;?></td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center" style="height: 30px; font-size:18px; font-weight:bold; text-decoration: underline;">
						<td>สถานะ</td>
						<td>วัน</td>
						<td>โอที ชม.</td>
						<td>ลาครึ่งวัน (ครั้ง)</td>
						<td>เบิกล่วงหน้า</td>
					</tr>
					
					<?php for($i=1; $i<=$num; $i++) { 
						$row = mysql_fetch_array($result);
						if($row['wd_work']==1){$status = 'ทำงาน';}else if($row['wd_work']==2){$status = 'ลากิจ';}else if($row['wd_work']==3){ $status = 'ลาพักร้อน'; }else if($row['wd_work']==4){ $status = 'ลาป่วย';}
					?>
					<tr border='1' align="center">
						<td><?php echo $status;?></td>
						<td><?php echo $row['tamngan'];?></td>
						<td><?php echo $row['tamot'];?></td>
						<td><?php echo $row['lakrungwan'];?></td>
						<td><?php echo number_format($row['berklongna'], 0, '.', ',');?></td>
					</tr>
					<?php } ?>
					
					<tr border='1' align="center">
						<td>รวม</td>
						<td><?php echo $cntallday;?></td>
						<td><?php echo $sumot;?></td>
						<td><?php echo $sumhd;?></td>
						<td><?php echo number_format($sumadv, 0, '.', ',');?></td>
					</tr>
					
					<tr border='1' align="center">
						<td>เงินเดือน</td>
						<td><?php echo number_format($calsal, 0, '.', ','); ?></td>
						<td><?php echo number_format($calot, 0, '.', ',');?></td>
						<td><?php echo number_format($calhd, 0, '.', ',');?></td>
						<td><?php echo number_format($sumadv, 0, '.', ',');?></td>
					</tr>
					
					<tr border='1' align="center" style="height:50px;">
						<td>ทำจ่าย</td>
						<td><?php echo number_format($sum, 0, '.', ',').'-'.number_format($sumadv, 0, '.', ','); ?></td>
						<td><span style="font-size:18px; color:red; font-weight:bold;"><?php echo number_format($pay, 2, '.', ','); ?></span></td>
						<td><?php  ?></td>
						<td><?php  ?></td>
					</tr>
					
				</table>
				
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse; margin-top:20px;">
					<tr>
						<td colspan="7" align="center" style=" height: 30px; font-size:20px; font-weight:bold; background: #DAD7D7; border: 1px solid black;">รายละเอียดต่างๆ <?php echo $emp_name;?></td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center" style="height: 30px; font-size:18px; font-weight:bold; text-decoration: underline;">
						<td>#</td>
						<td>วันที่</td>
						<td>สถานะ</td>
						<td>โอที ชม.</td>
						<td>ลาครึ่งวัน (ครั้ง)</td>
						<td>เบิกล่วงหน้า</td>
						<td>หมายเหตุ</td>
					</tr>
					
					<?php for($m=1; $m<=$num_detail; $m++) { 
						$row_detail = mysql_fetch_array($result_detail);
						if($row_detail['wd_work']==1){$status1 = 'ทำงาน';}else if($row_detail['wd_work']==2){$status1 = 'ลากิจ';}else if($row_detail['wd_work']==3){ $status1 = 'ลาพักร้อน'; }else if($row_detail['wd_work']==4){ $status1 = 'ลาป่วย';}
					?>
					<tr border='1' align="center">
						<td><?php echo $row_detail['wd_id'];?></td>
						<td><?php echo $row_detail['wd_day'];?></td>
						<td><?php echo $status1;?></td>
						<td><?php echo $row_detail['wd_ot'];?></td>
						<td><?php echo $row_detail['wd_halfday'];?></td>
						<td><?php echo number_format($row_detail['wd_advance'], 0, '.', ',');?></td>
						<td><?php echo $row_detail['wd_note'];?></td>
					</tr>
					<?php } ?>
					
				</table>
			</div><!--end product_price-->
        </div>  <!--end subpage-->
    </div> <!--end page-->
	<?php $calsalary[] = array($emp_id, $pay); ?>
  
  <?php } //end main loop Page
	  //print_r($calsalary); 
	  
	  $cntsalary = count($calsalary);
	  for($i=0; $i<$cntsalary; $i++){
		  $totalsal += $calsalary[$i][1];
	  }
	  echo '<br> รวมเงินต้องส่งให้พนักงาน '.number_format($totalsal, 0, '.', ',');
  ?>
</div>
</body>
</html>