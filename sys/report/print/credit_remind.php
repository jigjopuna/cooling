<?php session_start(); 
      require_once('../../include/connect.php'); 
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>รอบเครดิต</title>
    <?php 
	
	 require_once('../../include/metatagsys.php');
	 require_once('../../include/inc_role.php'); 
	 require_once('../../include/inc_ro_report.php'); 
	 
	 ?>
</head>
<body>
<?php 
		$dates = date("Y-m-d");
		
		//query เครดิตที่ครบดิว ภายใน 60 วัน วันที่เลือกก็คือ วันครบดิวที่มากกว่าวันปัจจุบันแต่น้อยกว่า 60 วันข้างหน้า ฉะนัน query จะไม่แสดง duo_date ย้อนหลังนะ
		$sql_duedate = "SELECT p.po_id, p.po_name, p.po_price, p.po_shop, p.po_mudjum, p.po_credit, p.po_credit_complete, p.po_credit_due_date, p.po_date, s.sl_name 
						FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id
						WHERE p.po_credit = 1 AND p.po_credit_complete = 0 AND p.po_credit_due_date >= curdate() AND p.po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 60 day)
						ORDER BY p.po_credit_due_date ASC";
		$result_duedate = mysql_query($sql_duedate);
		$num_duedate = mysql_num_rows($result_duedate);
		
		
		
		//query ที่ไม่ได้ใส่ due date 
		$sql_nodue =   "SELECT p.po_id, p.po_name, p.po_price, p.po_shop, p.po_mudjum, p.po_credit, p.po_credit_complete, p.po_credit_due_date, p.po_date, s.sl_name 
						FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id 
						WHERE p.po_credit = 1 AND p.po_credit_complete = 0 AND p.po_credit_due_date LIKE '0%' 
						ORDER BY po_date ASC";
		$result_nodue = mysql_query($sql_nodue);
		$num_nodue = mysql_num_rows($result_nodue);
		
		//query ย้อนหลัง 180 ที่ไม่ยอกจ่าย
		$sql_duedate = "SELECT p.po_id, p.po_name, p.po_price, p.po_shop, p.po_mudjum, p.po_credit, p.po_credit_complete, p.po_credit_due_date, p.po_date, s.sl_name 
						FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id 
						WHERE p.po_credit = 1 AND p.po_credit_complete = 0 AND p.po_credit_due_date >= DATE_SUB(curdate(),INTERVAL 180 day)  AND p.po_credit_due_date <= curdate() 
						ORDER BY po_credit_due_date ASC";
		$result_prev = mysql_query($sql_prev);
		$num_prev = mysql_num_rows($result_prev);
	
	
	    $credit = mysql_fetch_array(mysql_query("SELECT SUM(p.po_price)-SUM(p.po_mudjum) jaycredit FROM tb_po p WHERE p.po_credit = 1 AND p.po_credit_complete != 1"));
		$yodcredit = $credit['jaycredit'];
		
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
			
			<div class="header_report" style="padding-top: 50px;"><p>เครดิตรวมทุกร้าน</p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>วันที่ <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">รายการเครดิตที่ต้องชำระ ภายใน 60 วันนี้</td>
						</tr>
						<tr>
							<td align="center" style="width:10%;">PO no.</td>
							<td align="center" style="width:25%;">ชื่อรายการ</td>
							<td align="center" style="width:18%;">ร้านค้า</td>
							<td align="center" style="width:10%;">ยอดเต็ม</td>
							<th align="center" style="width:10%;">คงเหลือ</th>
							<th align="center" style="width:12%; background-color:yellow; color:red; font-weight:bold;">ครบดิว</th>
							<td align="center" style="width:9%;">วันที่สั่งซื้อ</td>
						</tr>
						<?php for($i=1; $i<=$num_duedate; $i++) {  
							$row_duedate = mysql_fetch_array($result_duedate);
						?>
								<tr>
									<td align="center"><?php echo $row_duedate['po_id'];;?></td>
									<td align="center"><?php echo $row_duedate['po_name'];?></td>
									<td align="center"><?php echo $row_duedate['sl_name'];?></td>
									<td align="center"><?php echo number_format($row_duedate['po_price'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row_duedate['po_price']-$row_duedate['po_mudjum'], 0, '.', ',');?></td>
									<td align="center" style="background-color:yellow; color:red; font-weight:bold;"><?php echo $row_duedate['po_credit_due_date'];?></td>
									<td align="center"><?php echo $row_duedate['po_date'];?></td>
								</tr>
						<?php } ?>
						
						
						        <tr>
									<td colspan='7' style="height:50px;">&nbsp;</td>
									
								</tr>
								
								<tr>
									<td colspan='7' style="height:35px;" align="center">ยังไม่ได้กำหนดวันครบดิว</td>
									
								</tr>
						
						<?php for($i=1; $i<=$num_nodue; $i++) {  
							$row_nodue = mysql_fetch_array($result_nodue);
						?>
						
						
								<tr>
									<td align="center"><?php echo $row_nodue['po_id'];;?></td>
									<td align="center"><?php echo $row_nodue['po_name'];?></td>
									<td align="center"><?php echo $row_nodue['sl_name'];?></td>
									<td align="center"><?php echo number_format($row_nodue['po_price'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row_nodue['po_price']-$row_nodue['po_mudjum'], 0, '.', ',');?></td>
									<td align="center"><?php echo $row_nodue['po_credit_due_date'];?></td>
									<td align="center"><?php echo $row_nodue['po_date'];?></td>
								</tr>
						<?php } ?>
								
								
						
						
						
								<tr>
									<td colspan='7' style="height:50px;">&nbsp;</td>
									
								</tr>
								
								<tr>
									<td colspan='7' style="height:35px;" align="center">เกินดิวแล้วช่วง 180 วัน</td>
									
								</tr>
								
						<?php for($i=1; $i<=$num_prev; $i++) {  
							$row_prev = mysql_fetch_array($result_prev);
						?>
						
						
								<tr>
									<td align="center"><?php echo $row_prev['po_id'];;?></td>
									<td align="center"><?php echo $row_prev['po_name'];?></td>
									<td align="center"><?php echo $row_prev['sl_name'];?></td>
									<td align="center"><?php echo number_format($row_prev['po_price'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row_prev['po_price']-$row_prev['po_mudjum'], 0, '.', ',');?></td>
									<td align="center"><?php echo $row_prev['po_credit_due_date'];?></td>
									<td align="center"><?php echo $row_prev['po_date'];?></td>
								</tr>
						<?php } ?>

						
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo number_format($yodcredit, 0, '.', ',');?> </td>
							<td>บาท</td>
						</tr>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>