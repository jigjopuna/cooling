<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>น้ำมัน</title>
</head>
<body>
<?php 
		$mont = date("m");
	    $year = date("Y");
	  
	    $dates =  $year.'-'.$mont.'%';
	    //$dates =  '2022-5%';
		
		$result_po = mysql_query("SELECT p.po_name, p.po_id, p.po_price, p.po_subyer, p.po_qty, p.po_cate, p.po_date, v.v_id, v.v_name, v.v_tabian, s.sl_name, o.oil_emp, o.oil_unit
								FROM ((tb_po p JOIN tb_oil o ON o.oil_po = p.po_id) 
									  JOIN tb_vehicle v ON v.v_id = o.oil_car)
									  JOIN tb_sellers s ON p.po_shop = s.sl_id 
								WHERE p.po_cate = 6 AND p.po_date LIKE '$dates' AND p.po_publish = 1 
								ORDER BY v.v_id");
		$num_po = mysql_num_rows($result_po);
		
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice FROM tb_po p JOIN tb_oil o ON o.oil_po = p.po_id WHERE p.po_cate = 6 AND p.po_date LIKE '$dates' AND po_publish = 1 AND po_subcate != 0"));
		
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po p JOIN tb_oil o ON o.oil_po = p.po_id WHERE po_cate = 6 AND po_date LIKE '$dates' AND po_publish = 1 AND po_subcate != 0"));
		
		
		$rowsum = $rowsum_['poprice'];
		$rowcount = $rowcount_['countpo'];
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
				<?php include ('../../../include/cpn_addr.php'); ?>
			</div><!--end cover_header-->
			
			<div class="header_report" style="padding-top: 50px;"><p>สรุป น้ำมัน </p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>ประจำเดือน <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">ค่าใช้จ่ายน้ำมัน  <?php echo $rowcount;?> รายการ</td>
						</tr>
						<tr>
							<td style="width:3%;">###</td>
							<td style="width:5%;">ID</td>
							<td align="center" style="width:20%;">รายการ</td>
							<td align="right" style="width:10%;">ราคา</td>
							<td align="right" style="width:10%;">จำนวน/ลิตร</td>
							<td align="right" style="width:10%;">ยอดจ่าย</td>
							<th align="center" style="width:10%;">ปั๊ม</th>
							<th align="center" style="width:10%;">การจ่าย</th>
							<th align="center" style="width:10%;">พนักงาน</th>
						</tr>
						<?php for($i=1; $i<=$num_po; $i++) {  
							$row_po = mysql_fetch_array($result_po);
							
							if($rowtype != $row_po['v_id']){ echo '<tr><td colspan="9" align="center"><hr></td></tr> <tr><td colspan="6" align="left" style="font-weight:bold; font-family: Kanit, sans-serif">'.$row_po["v_name"].'</td></tr>'; $rowtype = $row_po['v_id'];}
						?>
						
								<tr>
									<td><?php echo $i.'.';?></td>
									<td><?php echo $row_po['po_id'];?></td>
									<td align="left"><?php echo $row_po['po_name'];?></td>
									<td align="right"><?php echo number_format($row_po['oil_unit'], 2, '.', ',');?> </td>
									<td align="right"><?php echo number_format($row_po['po_qty'], 2, '.', ',');?> </td>
									<td align="right"><?php echo number_format($row_po['po_price'], 2, '.', ',');?></td>
									<td align="center"><?php echo $row_po['sl_name'];?></td>
									<td align="right"><?php echo $row_po['po_subyer'];?></td>
									<td align="center"><?php echo $row_po['oil_emp'];?></td>
								</tr>
						<?php } ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo number_format($rowsum, 0, '.', ',');?> บาท</td>
							<th>&nbsp;</th>
						</tr>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>