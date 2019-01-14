<?php session_start();
	  require_once('../include/connect.php');
	
	$sql = "SELECT * FROM tb_emp WHERE e_publish = 1 AND e_company != 3";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$today = date("Y-m-d");
	$day = date("D");
	
	$cnt_duplicate = mysql_fetch_array(mysql_query("SELECT COUNT(*) cntdup FROM tb_workday WHERE wd_day = '$today'"));
	
?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<title>EMPLOYEE CHECKING</title>
	<link rel="stylesheet" href="../../css/quotation.css">
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once('../include/inc_role.php'); ?>
		
	<style>
		#wrapper{ 
			width:80%;
			margin:0 auto 50px auto;
			/*padding:50px;*/
			background:white;
			position:relative; 
		}
		h1{
			text-align:center;
			padding:50px 0;
			font-size:30px;
			margin:0;
			font-weight:200;
			color:#454545;
		}
		form{ width: 100%; background-color:#EEEEEE;}
		tr { height:30px; }
	</style>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			var cntdup = $('#cntdup').html();
			if(cntdup > 0) { alert('วันนี้บันทึกข้อมูลพนักงานแล้วนะ'); $('#btn').prop('disabled',true); return false; } else { $('#btn').prop('disabled',false); }
		});
	</script>
	
</head>
<body>
	<h1>EMPLOYEE CHECKING <strong><u><?php echo $today;?></u></strong></h1>
	<div id="wrapper">
		<form action="../db/finance/working_day.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
			<table>
				<tr style="border-bottom: 1px solid black;">
					<td style="width:5%; font-size:18px; font-weight:bold;">#</td>
					<td style="width:8%; font-size:18px; font-weight:bold;">ชื่อพนักงาน</td>
					<td style="width:8%; font-size:18px; font-weight:bold;">ทำงาน</td>
					<td style="width:8%; font-size:18px; font-weight:bold;">ลากิจ</td>
					<td style="width:8%; font-size:18px; font-weight:bold;">ลาพักร้อน</td>
					<td style="width:8%; font-size:18px; font-weight:bold;">ลาป่วย</td>
					<td style="width:8%; font-size:18px; font-weight:bold;">ครึ่งวัน</td>
					<td style="width:10%; font-size:18px; font-weight:bold;">โอที (ชม.)</td>
					<td style="width:10%; font-size:18px; font-weight:bold;">เบิกล่วงหน้า</td>
					<td style="width:10%; font-size:18px; font-weight:bold;">หมายเหตุ</td>
				</tr>
				
				<tr>
					<td colspan='10'><hr></td>
				</tr>
				
				<?php 
					for($i=1; $i<=$num; $i++){
						$row = mysql_fetch_array($result);
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $row['e_name']?></td>
					<td><input type="radio" name="emp<?php echo $row['e_id']?>" value="1" checked></td>
					<td><input type="radio" name="emp<?php echo $row['e_id']?>" value="2"></td>
					<td><input type="radio" name="emp<?php echo $row['e_id']?>" value="3"></td>
					<td><input type="radio" name="emp<?php echo $row['e_id']?>" value="4"></td>
					<td><input type="checkbox" name="halfday<?php echo $row['e_id']?>"></td>
					<td><input type="text" name="ot<?php echo $row['e_id']?>" style="width:30px;"></td>
					<td><input type="text" name="adv<?php echo $row['e_id']?>" style="width:50px;"></td>
					<td><input type="text" name="note<?php echo $row['e_id']?>"></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan='8'><input type="submit" id="btn" value="บันทึก "> </td>
				</tr>
			</table>
		</form>	
	</div>
	<div id='cntdup' style="display:none;"><?php echo $cnt_duplicate['cntdup'];?></div>
</body>
</html>