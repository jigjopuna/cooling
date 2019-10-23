<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>รายงาน</title>
</head>
<body>
<?php 
		$shop = trim($_GET['shop']);
		
		$result = mysql_query("SELECT p.po_id, p.po_name, s.sl_name, p.po_price,  p.po_mudjum,p.po_price-p.po_mudjum remains,  p.po_bill_img, p.po_comment, p.po_date
								FROM tb_po p JOIN tb_sellers s ON s.sl_id = p.po_shop  
								WHERE p.po_shop = '$shop' AND p.po_credit = 1 AND p.po_credit_complete = 0
								ORDER BY p.po_id DESC");
		$num = mysql_num_rows($result);
		
		$rowcount = mysql_fetch_array(mysql_query("SELECT s.sl_name, SUM(p.po_price) yodtem, SUM(p.po_mudjum) mudjum, SUM(p.po_price-p.po_mudjum) remains FROM tb_po p JOIN tb_sellers s ON s.sl_id = p.po_shop WHERE p.po_shop = '$shop' AND p.po_credit = 1 AND p.po_credit_complete = 0"));		  	
?>
    <link rel="stylesheet" href="../../../css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style>
		
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
				<img src="../../../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			<div class="header_report" style="padding-top: 50px; width: 70%;"><p>สรุป เครดิต  <?php echo $rowcount['sl_name'];?></p></div>
			<div class="header_report header_date" style="margin-top: -25px; width: 70%;"><p> ยอดเต็ม <?php echo number_format($rowcount['yodtem'], 0, '.', ',');?> บาท ||   มัดจำ <?php echo number_format($rowcount['mudjum'], 0, '.', ',');?> บาท </p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" style="height:50px; font-size: 17px; font-weight:bold;" align="center">ที่เครที่ต้องชำระ <?php echo number_format($rowcount['remains'], 0, '.', ',');?> บาท </td>
						</tr>
						<tr style="height:50px; font-size: 17px; font-weight:bold;" align="center">
							<td style="width:5%;">#####</td>
							<td align="center" style="width:36%;">รายการ</td>
							<td align="center" style="width:15%;">ยอดเต็ม</td>
							<td align="center" style="width:15%;">มัดจำ</td>
							<td align="center" style="width:15%;">คงเหลือ</td>
							<th align="center" style="width:15%;">วันที่</th>
						</tr>
						<?php for($i=1; $i<=$num; $i++) {  
							$row = mysql_fetch_array($result);
						?>
						
							<?php 
								  $page = 56;
								if($i==45 || $i==100 || $i==156 || $i==212 || $i==269 || $i==325 || $i==382){ 
									
							?>
							    <tr>
									<td colspan='6' style="height:100px;">&nbsp;</td>
									
								</tr>
							<?php } ?>
								<tr>
									<td><?php echo $row['po_id'];?></td>
									<td align="center"><?php echo $row['po_name'];?></td>
									<td align="center"><?php echo number_format($row['po_price'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row['po_mudjum'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row['remains'], 0, '.', ',');?></td>
									<td align="center"><?php echo $row['po_date'];?></td>
								</tr>
						<?php } ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td></td>
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