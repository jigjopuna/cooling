<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>การเดินทาง</title>
</head>
<body>
<?php 
		$mont = date("m");
	    $year = date("Y");
	    $dates =  $year.'-'.$mont.'%';
	    
		$eid = $_GET['e_id'];
		
		$sql_jour = "SELECT * 
					 FROM (tb_journey j JOIN tb_vehicle v on j.j_car = v.v_id)
						   JOIN tb_emp e on e.e_id = j.j_emp 
					 WHERE j_emp = '$eid' 
					 ORDER BY j_id DESC";
		$result_jour = mysql_query($sql_jour);
		$num_jour = mysql_num_rows($result_jour);
		
?>
    <link rel="stylesheet" href="../../../css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style>
		<style>
		.boder td { border: 1px solid black; }

	</style>

	</style>

</style>
</head>

<body>

<div class="book">
	<div class="page">
        <div class="subpage">
			<div id="cover_header">
				<?php include ('../../../include/cpn_addr.php'); ?>
			</div><!--end cover_header-->
			
			<div class="header_report" style="padding-top: 50px;"><p>สรุป การเดินทาง </p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>ประจำเดือน <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">การเดินทางทั้งหมด  <?php echo $num_jour;?> รายการ</td>
						</tr>
						<tr>
								<th style='width: 5%;'>ลำดับ</th>
                                <th style='width: 30%; text-align: left;'>รายการ</th>
								<th style='width: 8%;'>รถ </th>
								<th style='width: 10%;'>พนักงาน </th>
								<th style='width: 8%; text-align: right;'>กิโลเริ่ม</th>
								<th style='width: 8%; text-align: right;'>กิโลท้าย</th>
								<th style='width: 7%; text-align: right;'>ระยะ</th>
								<th style='width: 12%;'>วันที่เริ่ม</th>
								<th style='width: 10%;'>วันที่สุดท้าย</th>

                        </tr>
						<?php for($i=1; $i<=$num_jour; $i++) {  
							$row_jour = mysql_fetch_array($result_jour);
							
						?>
						
							<tr class="boder">
								<td style=" text-align: center;"><?php echo $row_jour['j_id']?></td>
                                <td style="text-align: left;"><?php echo $row_jour['j_name']?></td>
								<td><?php echo $row_jour['v_name']?></td>
								<td style="text-align: center;"><?php echo $row_jour['e_name']?></td>
								<td style="text-align: right;"><?php echo number_format($row_jour['j_kilo1'], 0, '.', ','); ?></td>
								<td style="text-align: right;"><?php echo number_format($row_jour['j_kilo2'], 0, '.', ','); ?></td>
								<td style="text-align: right;"><?php echo number_format($row_jour['j_kilo2']-$row_jour['j_kilo1'], 0, '.', ','); ?></td>
								<td style="background-color:#EEEEEE; font-weight:bold;"><?php echo $row_jour['j_time1']?></td>
								<td><?php echo $row_jour['j_time2']?></td>
                            </tr>
						<?php } ?>
						
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>