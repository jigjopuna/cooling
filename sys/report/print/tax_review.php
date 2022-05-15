<?php session_start(); 
      require_once('../../include/connect.php'); 
	  
	  //$dates = date("Y-m-d");
	  $mont = date("m");
	  $year = date("Y");
	  
	  $dates =  $year.'-'.$mont.'%';
	  
  
	  $row_payin = mysql_fetch_array(mysql_query("SELECT SUM(pay_amount) AS sumin FROM tb_ord_pay WHERE pay_date LIKE '$dates'"));
	  $yodin = $row_payin['sumin'];
	  
	  $row_buy = mysql_fetch_array(mysql_query("SELECT SUM(po_price) AS sumpo FROM tb_po WHERE po_date LIKE '$dates'"));
	  $yodbuy = $row_buy['sumpo'];
	  
	  
	  $sql = "SELECT op.pay_id, c.cust_name, op.pay_amount, op.pay_date, o.o_id, op.pay_bill
			FROM (tb_orders o JOIN tb_ord_pay op ON o.o_id = op.o_id) 
				 JOIN tb_customer c ON c.cust_id = o.o_cust
			WHERE pay_date LIKE '$dates'
		    ORDER BY op.pay_date DESC LIMIT 0,200";
	  $result= mysql_query($sql);
	  $num = mysql_num_rows($result);
	  
	  
	  $sql_sue = "SELECT  po_id, po_name, po_orders, po_price, po_bill_pdf , po_bill_img, po_date, po_shop  
				  FROM tb_po  
				  WHERE po_date LIKE '$dates'
			      ORDER BY po_id DESC LIMIT 0,200";
	  $result_sue= mysql_query($sql_sue);
	  $num_sue = mysql_num_rows($result_sue);
	  

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>สรุปภาษี</title>
    <?php 
	
	 require_once('../../include/metatagsys.php');
	 //require_once('../../include/inc_role.php'); 
	// require_once('../../include/inc_ro_report.php'); 
	 
	 ?>
</head>
<body>
<?php 
		
		
		
		
?>
    <link rel="stylesheet" href="../../../css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style> 
		border-collapse: collapse;
		#report_detail table tr{ font-size: 12px; height: 8px; }
		.titopic { font-size:20px; font-weight:bold; text-align: center; height:40px; border: 1px solid black; border-collapse: collapse;}
		.intopic { font-size:18px; font-weight:bold; text-align: center; height:30px; border: 1px solid black; border-collapse: collapse;}
		.intd { font-size:14px;  text-align: center; border: 1px solid black; border-collapse: collapse;;}
		.subtable { width: 100%; }
		.header_report {font-size: 16px;}
		.outtd { overflow:hidden;}
		
		a {
			color: #000000;
			text-decoration: none;
		}

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
			
			<div class="header_report" style="padding-top: 50px;"><p> สรุปภาษี ซื้อ ขาย <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">ยอดรรับเงิน</td>											
									</tr>
									
									<tr>
										<td class="intopic">ยอดรับเงิน</td>
										<td class="intopic"> <?php echo number_format($yodin, 2, '.', ','); ?></td> 							
									</tr>
									
									<tr>
										<td class="intopic">VAT 7%</td>
										<td class="intopic"><?php echo number_format($yodin*.07, 2, '.', ','); ?> </td> 							
									</tr>
								</table>
							</td>
							
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">ยอดรายจ่าย</td>											
									</tr>
									<tr>
										<td class="intopic">ยอดซื้อ </td>
										<td class="intopic"><?php echo number_format($yodbuy, 2, '.', ','); ?></td> 
																	
									</tr>
									
									<tr>
										<td class="intopic">VAT 7%</td>
										<td class="intopic"><?php echo number_format($yodbuy*.07, 2, '.', ','); ?> </td> 
																	
									</tr>
								</table>
							
							</td>
						</tr>
					</table>
					
					<div>&nbsp;</div>
					
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">ลูกค้าที่จ่าย</td>											
									</tr>
									<tr>
										<td class="intopic">ลูกค้า</td>
										<td class="intopic">ยอด</td> 
																	
									</tr>
									
									<?php 
										for($i=1; $i <= $num; $i++){
											$row = mysql_fetch_array($result);
											$custname = $row['cust_name'];
											$pay_amount = $row['pay_amount'];
									?>
									<tr>
										<td class="intd"><?php echo $custname;?></td>
										<td class="intd"><?php echo number_format($pay_amount, 2, '.', ','); ?></td> 
																	
									</tr>
									
									<?php } ?>
									<tr>
										<td colspan='2' class="">&nbsp;</td>											
									</tr>
								</table>
								
							
							</td>
							
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">รายการที่ซื้อ</td>											
									</tr>
									<tr>
										<td class="intopic">รายการ</td>
										<td class="intopic">ยอดซื้อ</td> 
																	
									</tr>
									
									<?php 
										for($i=1; $i <= $num_sue; $i++){
											$row_sue = mysql_fetch_array($result_sue);
											
									?>
									<tr>
										<td class="intd">
											
											<a href="../../images/bill/<?php echo $row_sue['po_bill_img'];?>" target="_blank"><?php echo $row_sue['po_name']?></a> 
											
										
										</td>
										
										<td class="intd"><?php echo number_format($row_sue['po_price'], 0, '.', ',');?></td> 
																	
									</tr>
									
									<?php } ?>
									
									<tr>
										<td colspan='2' class="">&nbsp;</td>											
									</tr>
								</table>
							
							</td>
						</tr>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>