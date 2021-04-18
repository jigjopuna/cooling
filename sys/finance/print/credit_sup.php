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
		
		$result = mysql_query("SELECT p.po_id, p.po_name, s.sl_name, s.sl_credit_date, p.po_price,  p.po_mudjum,p.po_price-p.po_mudjum remains,  p.po_bill_img, p.po_comment, p.po_date, p.po_credit_due_date, DATEDIFF( NOW(), p.po_credit_due_date) as countday
								FROM tb_po p JOIN tb_sellers s ON s.sl_id = p.po_shop  
								WHERE p.po_shop = '$shop' AND p.po_credit = 1 AND p.po_credit_complete = 0
								ORDER BY p.po_id DESC");
		$num = mysql_num_rows($result);
		
		$rowcount = mysql_fetch_array(mysql_query("SELECT s.sl_name, SUM(p.po_price) yodtem, SUM(p.po_mudjum) mudjum, SUM(p.po_price-p.po_mudjum) remains FROM tb_po p JOIN tb_sellers s ON s.sl_id = p.po_shop WHERE p.po_shop = '$shop' AND p.po_credit = 1 AND p.po_credit_complete = 0"));		

        $sqlcopr = mysql_fetch_array(mysql_query("SELECT sl_corp FROM tb_sellers WHERE sl_id = '$shop'"));
		$rowcopr = $sqlcopr['sl_corp']; 
		
		$today = date("d-m-Y");
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
			<div class="cover_header">
				<?php 
					if($rowcopr == 2)
						include ('../../../include/tcl_addr.php');
					else 
						include ('../../../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
			
			<div class="header_report" style="padding-top: 80px; width: 70%;"><p>สรุป เครดิต  <?php echo $rowcount['sl_name'];?></p></div>
			<div class="header_report header_date" style="margin-top: -25px; width: 70%;"><p> ยอดเต็ม <?php echo number_format($rowcount['yodtem'], 0, '.', ',');?> บาท ||   มัดจำ <?php echo number_format($rowcount['mudjum'], 0, '.', ',');?> บาท </p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="8" align="right"><?php echo $today;?> </td>
						</tr>
						<tr>
							<td colspan="8" style="height:50px; font-size: 17px; font-weight:bold;" align="center">ที่เครที่ต้องชำระ <?php echo number_format($rowcount['remains'], 0, '.', ',');?> บาท </td>
						</tr>
						<tr style="height:50px; font-size: 17px; font-weight:bold;" align="center">
							<td style="width:3%;">###</td>
							<td align="center" style="width:30%;">รายการ</td>
							<td align="center" style="width:10%;">ยอดเต็ม</td>
							<td align="center" style="width:10%;">มัดจำ</td>
							<td align="center" style="width:10%;">คงเหลือ</td>
							<td align="center" style="width:8%;">ดิว</td>
							<th align="center" style="width:11%;">วันที่</th> 
							<th align="center" style="width:12%;">ครบดิว</th> 
						</tr>
						<?php for($i=1; $i<=$num; $i++) {  
							$row = mysql_fetch_array($result);
							$dewdate = $row['countday'];
							$crediteDate = $row['sl_credit_date'];
							
						?>
						
							<?php 
								  $page = 56;
								if($i==32 || $i==100 || $i==156 || $i==212 || $i==269 || $i==325 || $i==382){ 
									
							?>
							    <tr>
									<td colspan='6' style="height:120px;">&nbsp;</td>
									
								</tr>
							<?php } ?>
								<tr <?php if($dewdate > $crediteDate ) { ?> style="color:red; font-weight:bold;" <?php } ?>>
									<td><?php echo $row['po_id'];?></td>
									<td align="left"><?php echo $row['po_name'];?></td>
									<td align="center"><?php echo number_format($row['po_price'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row['po_mudjum'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row['remains'], 0, '.', ',');?></td>
									
									<?php if($dewdate > $crediteDate ) { ?>
										<td align="center" style="font-size:18px; color:red; font-size:18; font-weight:bold;"><?php echo $dewdate;?></td>
									<?php } else { ?>
										<td align="center"><?php echo $dewdate;?></td>
									<?php } ?>
											
										
									<td align="center"><?php echo date("d-m-Y", strtotime($row['po_date']));?></td>
									<td align="center" style="color:red; background-color:yellow; font-weight:bold;"><?php echo date("d-m-Y", strtotime($row['po_credit_due_date']));?></td>
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