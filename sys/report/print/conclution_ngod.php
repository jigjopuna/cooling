<?php session_start(); 
      require_once('../../include/connect.php'); 
	  
	  $sql_ord = "SELECT o.o_id, c.cust_name, o.o_price, op.pay_amount, op.pay_date
					FROM (tb_orders o JOIN tb_ord_pay op ON op.o_id = o.o_id)
							   JOIN tb_customer c ON c.cust_id = o.o_cust
					WHERE o.o_id IN (
							SELECT o_id
								   FROM tb_orders 
								   WHERE o_type LIKE '1%' AND o_status != 5
							)
					ORDER BY o.o_id DESC";
	  $result_ord = mysql_query($sql_ord);
	  $num_ord = mysql_num_rows($result_ord);
	  
	  
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
			
			<div class="header_report" style="padding-top: 50px;"><p>ยอดที่ลูกค้าโอน</p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black; ">
						<tr>
							<td colspan='6' align="center" style="font-size: 20px;">ยอดที่ลูกค้าโอน</td>
						</tr>
						
						<tr style="font-size: 18px;">
							<td style="width:5%;">ออเดอร์</td>
							<td style="width:45%;">ลูกค้า</td>
							<td style="width:11%;" align="center">ราคาขาย</td>
							<td style="width:11%;" align="center">งวดที่ 1</td>
							<td style="width:11%;" align="center">งวดที่ 2</td>
							<td style="width:11%;" align="center">คงเหลือ</td>
							
						</tr>
						
						<?php 
							for($i=1; $i<=$num_ord; $i++){
								$row_ord = mysql_fetch_array($result_ord);								
								$order_id = $row_ord['o_id'];
								
								//1. เช็คก่อนว่า ออเดอร์นี้ จ่ายมาแล้วกี่ครั้ง ถ้าจ่ายมากกว่า 1 ครั้ง ให้นำยอดที่จ่ายครั้งที่สอง ใส่ในแถวเดียวกัน
								$nub = mysql_fetch_array(mysql_query("SELECT COUNT(*) counts FROM tb_ord_pay WHERE o_id ='$order_id'"));
						?>
						<?php if($duplicate != $order_id){ ?>
							<tr style="font-size: 16px;">
								<td style="font-size: 14px;"><?php echo $order_id; ?></td>
								<td><?php echo $row_ord['cust_name']; ?></td>
								<td><?php echo number_format($row_ord['o_price'], 0, '.', ','); ?></td>
								
								<?php if($nub['counts']==1){ ?>
									<td align="right"><?php echo number_format($row_ord['pay_amount'], 0, '.', ','); ?></td>
									<td align="right"></td>
									<td align="right" style="font-weight:bold;"> <?php echo number_format($row_ord['o_price']-$row_ord['pay_amount'], 0, '.', ','); ?> </td>
								<?php }else if($nub['counts']==2){ ?>
									<?php 
										$sql_again = mysql_query("SELECT pay_amount FROM tb_ord_pay WHERE o_id = '$order_id' ORDER BY pay_id");
										$num_again = mysql_num_rows($sql_again);
										for($j=1; $j<=$num_again; $j++){
											$row_again = mysql_fetch_array($sql_again);
											$arr1[] = $row_again['pay_amount'];	
			
											
											$jay1 = $arr1[0];
											$jay2 = $arr1[1];
											$remain = $row_ord['o_price']-$jay1-$jay2;
										}
									 ?>
									<td align="right"><?php echo number_format($jay1, 0, '.', ','); ?></td>
									<td align="right"><?php echo number_format($jay2, 0, '.', ','); ?></td>
									<td align="right" style="font-weight:bold;"><?php echo number_format($remain, 0, '.', ','); ?></td>
								<?php } unset($arr1); //end nub ?>
								
								
								<?php $duplicate = $order_id; ?>
							</tr>
						<?php } //end if duplicate?>
						<?php } //end for ?>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>