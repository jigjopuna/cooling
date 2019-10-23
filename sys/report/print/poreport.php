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
		$dates = trim($_GET['dates']);
		
		$result_po = mysql_query("SELECT p.po_id, p.po_name, t.to_typename, p.po_emp, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_subyer, p.po_bill_img, p.po_date, p.po_shop, p.po_credit, p.po_credit_complete   
					 FROM tb_po p JOIN tb_tools_type t ON p.po_cate = t.to_typeid
					 WHERE p.po_date LIKE '$dates'
					 ORDER BY t.to_typeid, p.po_shop");
		$num_po = mysql_num_rows($result_po);
		
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice FROM tb_po WHERE po_date LIKE '$dates'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$dates'"));
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
				<img src="../../../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			<div class="header_report" style="padding-top: 50px;"><p>สรุป ค่าใช้จ่าย </p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>ประจำวันที่ <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">รายการสั่งซื้อ / ค่าใช้จ่าย <?php echo $rowcount;?> รายการ</td>
						</tr>
						<tr>
							<td style="width:3%;">###</td>
							<td align="center" style="width:42%;">รายการ</td>
							<td align="center" style="width:15%;">ประเภท</td>
							<td align="center" style="width:10%;">จำนวน</td>
							<td align="center" style="width:7%;">ราคา</td>
							<th align="center" style="width:20%;">ร้านค้า</th>
						</tr>
						<?php for($i=1; $i<=$num_po; $i++) {  
							$row_po = mysql_fetch_array($result_po);
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
									<td><?php echo $i.'.';?></td>
									<td><?php echo $row_po['po_name'];?></td>
									<td><?php echo $row_po['to_typename'];?></td>
									<td align="center"><?php echo $row_po['po_qty'];?></td>
									<td><?php echo number_format($row_po['po_price'], 0, '.', ',');?></td>
									<td align="center"><?php echo $row_po['po_shop'];?></td>
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