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
		$curdate = date('Y-m-d');
		$year = date('Y');
		$month = date('m');
	  
	    $select_month =  $year.'-'.$rep_month.'%';
		$days = $dates.'%';
		
		$sql = "SELECT c.cash_id, c.cash_po, c.cash_now, c.cash1, c.cash_out, c.cash_in, c.cash_ord, c.cash_date
				FROM tb_cash_center c 
				WHERE c.cash_times LIKE '$days' 
				ORDER BY c.cash_id DESC 
				LIMIT 0,500";
		$result= mysql_query($sql);
		$num = mysql_num_rows($result);
		
		$results = mysql_fetch_array(mysql_query("SELECT SUM(cash_in) cashins, SUM(cash_out) cashouts FROM tb_cash_center WHERE cash_date LIKE '$days'"));
		$rowcashin = $results['cashins'];
		$rowcahsouts = $results['cashouts'];
		
		$sql_out = "SELECT c.cash_id, po.po_id, po.po_name, c.cash_in, c.cash_out, c.cash_ord, c.cash1, c.cash_date
					FROM tb_cash_center c JOIN (SELECT po_id, po_name, po_credit, po_credit_complete FROM tb_po WHERE po_date LIKE '$days' OR po_credit_pay LIKE '$days') AS po 
						 ON c.cash_po = po.po_id
					ORDER BY c.cash_id DESC";
					
		$result_out = mysql_query($sql_out);
		$num_out = mysql_num_rows($result_out);
		
		$sql_in = "SELECT vee.cash_id, vee.cash_ord, vee.cash_in, vee.cash1, vee.o_id, vee.cash_date, c.cust_name
					FROM tb_orders o JOIN (SELECT pu.cash_id, pu.cash_ord, pu.cash_in, pu.cash1, pu.cash_date, od.o_id FROM tb_ord_pay od JOIN (SELECT cash_id, cash_ord, cash_in, cash1, cash_date FROM tb_cash_center WHERE cash_date LIKE '$days' AND cash_po = 0) as pu ON od.pay_id = pu.cash_ord) AS vee ON vee.o_id = o.o_id
						  JOIN tb_customer c ON c.cust_id = o.o_cust 
					ORDER BY vee.cash_id DESC";
		$result_in = mysql_query($sql_in);
		$num_in = mysql_num_rows($result_in);
		

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
			
			<div class="header_report" style="padding-top: 50px;"><p>การเคลื่อนไหวเงิน </p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>ประจำวันที่ <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="8" align="center">รายการเคลื่อนไหวเงิน <?php echo $num;?> รายการ</td>
						</tr>
						<tr>
							<td style="width:5%;">###</td>
							<td align="center" style="width:5%;">เลขสั่งซื้อ</td>
							<td align="center" style="width:20%;">NOTE</td>
							<td align="center" style="width:10%;">เลขเงินเข้า</td>
							<td align="center" style="width:10%;">เงินเข้า (บาท)</td>
							<td align="center" style="width:10%;">เงินออก</td>
							<th align="center" style="width:15%;">เงินเหลือ</th>
							<th align="center" style="width:20%;">เวลา</th>
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
									<td align="center"><?php echo $row['cash_id'];?></td>
									<td align="center"><?php echo $row['cash_po'];?></td>
									<td align="center"> </td>
									<td align="center"><?php echo $row['cash_ord'];?></td>
									<td align="center"><?php echo number_format($row['cash_in'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row['cash_out'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row['cash1'], 0, '.', ',');?></td>
									<td align="center"><?php echo $row['cash_date']?></td>
								</tr>
						<?php } ?>
						<tr>
							<td>.</td>
						</tr>
						
						<tr>
							<td colspan="8">เงินเข้า <?php echo number_format($rowcashin, 0, '.', ',');?> บาท || เงินออก <?php echo number_format($rowcahsouts, 0, '.', ',');?> บาท</td>
							
						</tr>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	
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
			
			<div class="header_report" style="padding-top: 50px;"><p>เงินออก </p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>ประจำวันที่ <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr style="background-color: #EEEEEE; font-size:18px; font-weight:bold;">
							<td colspan="8" align="center">รายการเงินออก <?php echo $num_out;?> รายการ</td>
						</tr>
						<tr style="background-color: #EEEEEE; font-size:18px; font-weight:bold;">
							<td style="width:5%;">###</td>
							<td align="center" style="width:15%;">เลขสั่งซื้อ</td>
							<td align="center" style="width:30%;">รายการซื้อ</td>
							<td align="center" style="width:12%;">เงินออก</td>
							<th align="center" style="width:12%;">เงินเหลือ</th>
							<th align="center" style="width:15%;">เวลา</th>
						</tr>
						<?php for($i=1; $i<=$num_out; $i++) {  
							$row_out = mysql_fetch_array($result_out);
						?>
						
						<tr> 
							<td align="center"><?php echo $row_out['cash_id'];?></td>
							<td align="center"><?php echo $row_out['po_id'];?></td>
							<td align="center"><?php echo $row_out['po_name'];?></td>
							<td align="center"><?php echo number_format($row_out['cash_out'], 0, '.', ',');?></td>
							<td align="center"><?php echo number_format($row_out['cash1'], 0, '.', ',');?></td>
							<td align="center"><?php echo $row_out['cash_date']?></td>
						</tr>
						<?php } ?>
						<tr>
							<td>.</td>
						</tr>
						
					</table>
					
					<br><br>
					
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="8" align="center" style="background-color: #EEEEEE; font-size:18px; font-weight:bold;">รายการเงินเข้า <?php echo $num_in;?> รายการ</td>
						</tr>
						<tr style="background-color: #EEEEEE; font-size:18px; font-weight:bold;">
							<td style="width:15%;">เลขเงินเข้า</td>
							<td align="center" style="width:15%;">เลขออเดอร์</td>
							<td align="center" style="width:30%;">ลูกค้า</td>
							<td align="center" style="width:12%;">เงินเข้า</td>
							<th align="center" style="width:12%;">เงินเหลือ</th>
							<th align="center" style="width:15%;">เวลา</th>
						</tr> 
						<?php for($i=1; $i<=$num_in; $i++) {  
							$row_in = mysql_fetch_array($result_in);
						?>
						
						<tr> 
							<td align="center"><?php echo $row_in['cash_id'];?></td>
							<td align="center"><?php echo $row_in['cash_ord'];?></td>
							<td align="center"><?php echo $row_in['cust_name'];?></td>
							<td align="center"><?php echo number_format($row_in['cash_in'], 0, '.', ',');?></td>
							<td align="center"><?php echo number_format($row_in['cash1'], 0, '.', ',');?></td>
							<td align="center"><?php echo $row_in['cash_date']?></td>
						</tr>
						<?php } ?>
						<tr>
							<td>.</td>
						</tr>
						
					</table>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	
	
</div>
</body>
</html>