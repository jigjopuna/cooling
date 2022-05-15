<?php session_start(); 
	  require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../../content/images/favicon.png">
	<title>รายงานขายอะไหล่</title>
</head>
<body>
<?php 
		
		include('../../include/inc_role.php'); 
		$date = trim($_GET['date']);
		$typeid = trim($_GET['typeid']);
		$year = date("Y");
		$month = date('m');
		$years = $year.'%';
		$select_month =  $year.'-'.$months.'%';
		
		$dates = $years;
		
	
		$result = mysql_query("SELECT c.cust_name, c.cust_lineid, c.cust_tel, t.t_id, o.o_note, o.o_id, o.o_date, t.t_name, t.t_cost, o.o_price, ot.ort_name
									FROM ((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id)
										JOIN tb_tools t ON t.t_id = o.o_part_id) 
										JOIN tb_ord_type ot ON ot.ort_type = o.o_type
									WHERE o.o_type LIKE '4%' AND o.o_date LIKE '$dates'
									ORDER BY o.o_id DESC");
		$num = mysql_num_rows($result);
		
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(o_price) AS kai, SUM(t_cost) AS tun,  SUM(o_price) - SUM(t_cost) AS kumrai
												FROM tb_orders o JOIN tb_tools t ON t.t_id = o.o_part_id
												WHERE o.o_type LIKE '4%' AND o.o_date LIKE '$dates'"));		  
												
		$kai = $rowsum_['kai'];
		$tun = $rowsum_['tun'];
		$kumrai = $rowsum_['kumrai'];
		
?>
    <link rel="stylesheet" href="../../../css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style>
		#report_detail table tr{ font-size: 12px; height: 8px; }
		@media print { 
			 #btn-calngod,  #btn-addroom { display: none !important; } 
		}

	</style>

</style>
</head>

<body>

<div class="book">
	<div class="page">
        <div class="subpage">
			<div id="cover_header">
				<?php include('../../../include/cpn_addr.php');?> 
			</div><!--end cover_header-->
			
			<div class="header_report" style="padding-top: 50px;"><p>สรุป ขายอะไหล่ </p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>ประจำวันที่ <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">รายการขาย<?php echo $num;?> รายการ</td>
						</tr>
						<tr>
							
							
							<th style='width: 3%;'>ลำดับ</th>
							<th style='width: 3%;'>รหัสสินค้า</th>
                            <th style='width: 28%;'>ลูกค้า</th>
							<th style='width: 33%;'>รายการ</th>
							<th style='width: 6%;'>ราคาขาย</th>
							<th style='width: 6%;'>ราคาทุน</th>
							<th style='width: 6%;'>กำไร</th>
							<th style='width: 10%;'>วันที่</th>
										
						</tr>
						<?php for($i=1; $i<=$num; $i++) {  
							$row = mysql_fetch_array($result);
						?>
						
							<?php 
								  $page = 56;
								if($i==45 || $i==102 || $i==158 || $i==214 || $i==271 || $i==327 || $i==384){ 
									
							?>
							    <tr>
									<td colspan='6' style="height:100px;">&nbsp;</td>
									
								</tr>
							<?php } ?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $row['t_id'];?></td>
									<td><?php echo $row['cust_name'];?></td>
									<td><?php echo $row['t_name'];?></td>
									<td><?php echo number_format($row['o_price'], 0, '.', ',');?></td>
									<td><?php echo number_format($row['t_cost'], 0, '.', ',');?></td>
									<td><?php echo number_format($row['o_price'] - $row['t_cost'], 0, '.', ',');?></td>
									<td align="center"><?php echo $row['o_date'];?></td>
									
						<?php } ?>
						
						<tr>
							<th colspan="7">&nbsp; </th>
							
						</tr>
						<tr style="font-size:14px; color:blue; font-weight:bold;">
							<th colspan="4">รวมขาย </th>
							<td colspan="3"><?php echo number_format($kai, 2, '.', ',');?> บาท</td>
							
						</tr>
						<tr style="font-size:14px; color:green; font-weight:bold;">
							<th colspan="4">รวมต้นทุน </th>
							<td colspan="3"><?php echo number_format($tun, 2, '.', ',');?> บาท</td>
							
						</tr>
						<tr style="font-size:16px; color:olive; font-weight:bold;">
							<th colspan="4">รวมกำไร </th>
							<td colspan="3"><?php echo number_format($kumrai, 2, '.', ',');?> บาท</td>
							
						</tr>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>