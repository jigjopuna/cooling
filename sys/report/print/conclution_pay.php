<?php session_start(); 
      require_once('../../include/connect.php'); 
	  
	  
	  $sql_ord = "SELECT c.cust_name, b.counts, b.ocust, b.oprice
				  FROM tb_customer c JOIN (
										SELECT o_id oids, COUNT(o_id) counts, ocust, o_price oprice
										FROM tb_ord_pay op JOIN
											(SELECT o_id oid, o_price, o_cust ocust
											FROM tb_orders
											WHERE o_type LIKE '1%' AND o_status != 5) AS a
										WHERE op.o_id = a.oid
										GROUP BY o_id
										ORDER BY o_id DESC
										)AS b
				  ON c.cust_id = b.ocust
				  ORDER BY b.oids DESC";
	  $result_ord = mysql_query($sql_ord);
	  $num_ord = mysql_num_rows($result_ord);
	  
	  $dates = date("Y-m-d");
 
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>สรุปยอดโอนงวด</title>
    <?php 
	
	 require_once('../../include/metatagsys.php'); 
	 
	 ?>
</head>
<body>
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
	
	<div class="book">
		<div class="page">
			<div class="subpage">
				<div id="cover_header">
					<?php include ('../../../include/cpn_addr.php'); ?>
				</div><!--end cover_header-->
				
				<div class="header_report" style="padding-top: 50px;"><p>สรุปการเงิน <?php echo $dates; ?></p></div>
				
				
				<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table>
						<tr>
							<td style="width:8%">ออเดอร์</td>
							<td style="width:30%">ลูกค้า</td>
							<td style="width:15%">ราคาขาย</td>
							<td style="width:15%">งวด 1 </td>
							<td style="width:15%">งวด 2</td>
							<td style="width:15%">คงเหลือ  </td>
						</tr>
						
						<?php 
							for($i=1; $i <= $num_ord; $i++){
								$row_ord = mysql_fetch_array($result_ord);
						?>
									
						<tr>
							<td><?php echo  $row_ord['ocust'];?></td>
							<td><?php echo  $row_ord['cust_name'];?></td>
							<td><?php echo $row_ord['oprice'];?></td>
							<td><?php echo $row_ord['counts'];?></td>
							<td>5</td>
							
						</tr>
						
						<?php } ?>
						
						
					</table>
					
					<br><br>
			</div>
				

			</div>  <!--end subpage-->
		</div> <!--end page-->
	</div>
</body>
</html>

