<?php session_start(); 
      require_once('../../include/connect.php'); 
	  
	  //$dates = date("Y-m-d");
	  $mont = date("m");
	  $year = date("Y");
	  
	  $dates =  $year.'-'.$mont.'%';
	  
  
	  $row_novat = mysql_fetch_array(mysql_query("SELECT SUM(po_price) AS sumpo FROM tb_po WHERE po_date LIKE '$dates' AND po_vat = 0 AND po_publish = 1"));
	  $yodnovat = $row_novat['sumpo'];
	  
	  $row_vat = mysql_fetch_array(mysql_query("SELECT SUM(po_price) AS sumpo FROM tb_po WHERE po_date LIKE '$dates' AND po_vat = 1 AND po_publish = 1"));
	  $yodvat = $row_vat['sumpo'];
	  
	  
	 
	  
	  
	  $sql_novat = "SELECT  po_id, po_name, po_orders, po_price, po_bill_pdf , po_bill_img, po_date, po_shop  
				  FROM tb_po  
				  WHERE po_date LIKE '$dates' AND po_vat = 0 AND po_publish = 1
			      ORDER BY po_id DESC LIMIT 0,200";
	  $result_novat = mysql_query($sql_novat);
	  $num_novat = mysql_num_rows($result_novat);
	  
	  $sql_vat = "SELECT  po_id, po_name, po_orders, po_price, po_bill_pdf , po_bill_img, po_date, po_shop  
				  FROM tb_po  
				  WHERE po_date LIKE '$dates' AND po_vat = 1 AND po_publish = 1
			      ORDER BY po_id DESC LIMIT 0,200";
	  $result_vat= mysql_query($sql_vat);
	  $num_vat = mysql_num_rows($result_vat);
	  
	  
	  $row_payin = mysql_fetch_array(mysql_query("SELECT SUM(pay_amount) AS sumin FROM tb_ord_pay WHERE pay_date LIKE '$dates'"));
	  $yodin = $row_payin['sumin'];
	  

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>บิลซื้อ</title>
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
			
			<div class="header_report" style="padding-top: 50px;"><p> สรุปภาษี ซื้อ  <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">ยอดซื้อมี VAT</td>											
									</tr>
									
									<tr>
										<td class="intopic">ยอดซื้อมี VAT</td>
										<td class="intopic"> <?php echo number_format($yodvat, 2, '.', ','); ?></td> 							
									</tr>
									
									<tr>
										<td class="intopic">VAT 7%</td>
										<td class="intopic"><?php echo number_format($yodvat*.07, 2, '.', ','); ?> </td> 							
									</tr>
								</table>
							</td>
							
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">รวม ไม่มี VAT</td>											
									</tr>
									<tr>
										<td class="intopic">ยอดซื้อ </td>
										<td class="intopic"><?php echo number_format($yodnovat, 2, '.', ','); ?></td> 
																	
									</tr>
									
									<tr>
										<td class="intopic"></td>
										<td class="intopic"> </td> 
																	
									</tr>
								</table>
							
							</td>
						</tr>
						
					</table>
					
					<div>&nbsp;</div>
					
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td style="width:100%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">ยอดรับเงิน</td>											
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
							
							
						</tr>
					</table>
					
					<div>&nbsp;</div>
					
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">รายการซื้อมี VAT</td>											
									</tr>
									<tr>
										<td class="intopic">รายการ</td>
										<td class="intopic">ยอดซื้อ</td> 
																	
									</tr>
									
									<?php 
										for($i=1; $i <= $num_vat; $i++){
											$row_vat = mysql_fetch_array($result_vat);
											
									?>
									<tr>
										<td class="intd">
											
											<a href="../../images/bill/<?php echo $row_vat['po_bill_img'];?>" target="_blank"><?php echo $row_vat['po_name']?></a> 
											
										
										</td>
										
										<td class="intd"><?php echo number_format($row_vat['po_price'], 0, '.', ',');?></td> 
																	
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
										<td colspan='2' class="titopic">รายการซื้อ ไม่มี VAT</td>											
									</tr>
									<tr>
										<td class="intopic">รายการ</td>
										<td class="intopic">ยอดซื้อ</td> 
																	
									</tr>
									
									<?php 
										for($i=1; $i <= $num_novat; $i++){
											$row_novat = mysql_fetch_array($result_novat);
											
									?>
									<tr>
										<td class="intd">
											
											<a href="../../images/bill/<?php echo $row_novat['po_bill_img'];?>" target="_blank"><?php echo $row_novat['po_name']?></a> 
											
										
										</td>
										
										<td class="intd"><?php echo number_format($row_novat['po_price'], 0, '.', ',');?></td> 
																	
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