<?php session_start(); 
      require_once('../../include/connect.php'); 
	  
	  $sql_ord = "SELECT c.cust_name, p.pro_name, o.o_id
				  FROM (tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust) JOIN province p ON p.id = o.o_cuprovin
				  WHERE o.o_type LIKE '1%' AND o.o_status != 5
				  ORDER BY o.o_date DESC";
	  $result_ord = mysql_query($sql_ord);
	  $num_ord = mysql_num_rows($result_ord);
	  
	  $sql_incom = "SELECT c.cust_name, oid, o_cust, payamount, o_price, sub, t.dates
			FROM tb_customer c JOIN (
				SELECT o.o_id oid, o.o_cust, b.o_id, b.payamount,o.o_date dates, o.o_price,  o.o_price - b.payamount as sub
				FROM tb_orders o JOIN (
				   SELECT o_id, SUM(pay_amount) as payamount
				   FROM tb_ord_pay 
				   GROUP BY o_id) AS b
			    WHERE o.o_id = b.o_id AND o.o_status != 5 AND o.o_type LIKE '1%') AS t
			WHERE c.cust_id = t.o_cust ORDER BY oid DESC";
	$result_incom= mysql_query($sql_incom);
	$num_incom = mysql_num_rows($result_incom);
	
	$money = mysql_fetch_array(mysql_query("
		SELECT SUM(s.sub) total FROM (
			SELECT c.cust_name, oid, o_cust, payamount, o_price, sub 
			FROM tb_customer c JOIN (
				SELECT o.o_id oid, o.o_cust, b.o_id, b.payamount, o.o_price,  o.o_price - b.payamount as sub
				FROM tb_orders o JOIN (
					 SELECT o_id, SUM(pay_amount) as payamount
					 FROM tb_ord_pay 
					 GROUP BY o_id) AS b
					WHERE o.o_id = b.o_id AND o.o_status != 5) AS t
				WHERE c.cust_id = t.o_cust
			) as s
		"));
	
	$yod = $money['total'];
	
	$seven7 = mysql_fetch_array(mysql_query("SELECT SUM(duplicate.remains) tongjay7 FROM ( SELECT po_name, po_price, po_mudjum, po_price-po_mudjum remains FROM tb_po WHERE po_credit_due_date >= curdate() AND po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 7 day) AND po_credit = 1 AND po_credit_complete = 0 ) AS duplicate"));
	$jay7 = $seven7['tongjay7'];
	
	$seven14 = mysql_fetch_array(mysql_query("SELECT SUM(duplicate.remains) tongjay14 FROM ( SELECT po_name, po_price, po_mudjum, po_price-po_mudjum remains FROM tb_po WHERE po_credit_due_date >= curdate() AND po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 14 day) AND po_credit = 1 AND po_credit_complete = 0 ) AS duplicate"));
	$jay14 = $seven14['tongjay14'];
	
	$seven30 = mysql_fetch_array(mysql_query("SELECT SUM(duplicate.remains) tongjay30 FROM ( SELECT po_name, po_price, po_mudjum, po_price-po_mudjum remains FROM tb_po WHERE po_credit_due_date >= curdate() AND po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 30 day) AND po_credit = 1 AND po_credit_complete = 0 ) AS duplicate"));
	$jay30 = $seven30['tongjay30'];
	
	$seven60 = mysql_fetch_array(mysql_query("SELECT SUM(duplicate.remains) tongjay60 FROM ( SELECT po_name, po_price, po_mudjum, po_price-po_mudjum remains FROM tb_po WHERE po_credit_due_date >= curdate() AND po_credit_due_date <= DATE_ADD(curdate(),INTERVAL 60 day) AND po_credit = 1 AND po_credit_complete = 0 ) AS duplicate"));
	$jay60 = $seven60['tongjay60'];
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>สรุปการเงิน</title>
    <?php 
	
	 require_once('../../include/metatagsys.php');
	 //require_once('../../include/inc_role.php'); 
	// require_once('../../include/inc_ro_report.php'); 
	 
	 ?>
</head>
<body>
<?php 
		$dates = date("Y-m-d");
		
		
		
?>
    <link rel="stylesheet" href="../../../css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style> border-collapse: collapse;
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
			
			<div class="header_report" style="padding-top: 50px;"><p>สรุปการเงิน <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">ห้องเย็นที่ต้องทำ</td>											
									</tr>
									<tr>
										<td class="intopic">ลูกค้า</td>
										<td class="intopic">จังหวัด</td> 
																	
									</tr>
									
									<?php 
										for($i=1; $i <= $num_ord; $i++){
											$row_ord = mysql_fetch_array($result_ord);
											$custname = $row_ord['cust_name'];
											$orderid = $row_ord['o_id'];
									?>
									<tr>
										<td class="intd"><a target="_blank" href="../../order/order_detail.php?o_id=<?php echo $orderid?>&cust_name=<?php echo $custname?>"><?php echo $custname." (". $orderid.")"?></a></td>
										<td class="intd"><?php echo $row_ord['pro_name']?></td> 
																	
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
										<td colspan='2' class="titopic">เงินที่ต้องเรียกเก็บ</td>											
									</tr>
									<tr>
										<td class="intopic">ลูกค้า</td>
										<td class="intopic">ยอดเงิน</td> 
																	
									</tr>
									
									<?php 
										for($i=1; $i <= $num_incom; $i++){
											$row_incom = mysql_fetch_array($result_incom);
											$custnames = $row_incom['cust_name'];
											$orderids = $row_incom['oid'];
									?>
									<tr>
										<td class="intd"><a target="_blank" href="../../order/order_detail.php?o_id=<?php echo $orderids?>&cust_name=<?php echo $custnames?>"><?php echo $custnames." (". $orderids.")"?></a></td>
										<td class="intd"><?php echo number_format($row_incom['sub'], 0, '.', ',');?></td> 
																	
									</tr>
									
									<?php } ?>
									
									<tr>
										<td class="intd">ยอดรวม</td>
										<td class="intd"><?php echo number_format($yod, 0, '.', ',');?></td> 										
									</tr>
									
									<tr>
										<td colspan='2' class="">&nbsp;</td>											
									</tr>
								</table>
							
							</td>
						</tr>
						
						
						
						
						
						
						
						<tr>
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic">ใช้เงินซื้อของ 2 ห้อง</td>											
									</tr>
									<tr>
										<td class="intopic">ร้านค้า</td>
										<td class="intopic">จำนวนเงิน</td> 
																	
									</tr>
									
									<tr>
										<td class="intopic">ยอด</td>
										<td class="intopic">180,000.00</td> 
																	
									</tr>
									
									
									
									
									
								</table>
							
							</td>
							<td style="width:50%;" class="outtd">
								<table class="subtable">
									<tr>
										<td colspan='2' class="titopic"><a target="_blank" href="credit_remind.php">เครดิตที่ต้องชำระ</a></td>											
									</tr>
									<tr>
										<td class="intd">อีก 7 วัน</td>
										<td class="intd"><?php echo number_format($jay7, 0, '.', ',');?></td> 
																	
									</tr>
									
									<tr>
										<td class="intd">อีก 14 วัน</td>
										<td class="intd"><?php echo number_format($jay14, 0, '.', ',');?></td> 
																	
									</tr>
									
									<tr>
										<td class="intd">อีก 30 วัน</td>
										<td class="intd"><?php echo number_format($jay30, 0, '.', ',');?></td> 
																	
									</tr>
									
									<tr>
										<td class="intd">อีก 60 วัน</td>
										<td class="intd"><?php echo number_format($jay60, 0, '.', ',');?></td> 
																	
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