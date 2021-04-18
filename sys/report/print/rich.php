<?php session_start(); 
      require_once('../../include/connect.php'); 
	  
	  $rowtype = 0;
	  $today = date("d-m-Y");
	  
	  $sql = "SELECT * 
			  FROM tb_sellers s JOIN tb_tools_type tt ON s.sl_type = tt.to_typeid
			  WHERE sl_publish = 1 AND sl_type != 9 AND sl_type != 0 
			  ORDER BY s.sl_type, s.sl_corp";
	  $result = mysql_query($sql);
	  $num = mysql_num_rows($result);
	  
	  $sql_yod =   "SELECT a.sl_corp, SUM(a.yod) AS yods
					FROM (
						  SELECT s.sl_name,s.sl_corp, SUM(p.po_price) sumprice, SUM(p.po_mudjum) mudjum, SUM(p.po_price)-SUM(p.po_mudjum) yod
						  FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id
						  WHERE s.sl_publish = 1 AND p.po_credit = 1 AND p.po_credit_complete = 0
						  GROUP BY p.po_shop) AS a
					GROUP BY a.sl_corp";
	  $result_yod = mysql_query($sql_yod);
	  $num_yod = mysql_num_rows($result_yod);
	  
	
	  $rowtotal = mysql_fetch_array(mysql_query("SELECT SUM(a.yod) AS totalyod
													FROM (
														  SELECT s.sl_name,s.sl_corp, SUM(p.po_price) sumprice, SUM(p.po_mudjum) mudjum, SUM(p.po_price)-SUM(p.po_mudjum) yod
														  FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id
														  WHERE s.sl_publish = 1 AND p.po_credit = 1 AND p.po_credit_complete = 0
														  GROUP BY p.po_shop) AS a"));
														  
 
	  
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>ชำระหนี้</title>
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
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black !important; ">
						<tr>
							<td colspan="4" align="right"><?php echo $today;?> </td>
						</tr>
						<tr style="border: 1px solid black;">
							<td colspan='4' align="center" style="font-size: 20px;">ยอดชำระหนี้</td>
						</tr>
						
						<tr style="font-size: 18px; border: 1px solid black;">
							<td style="width:40%;">ร้านค้า</td>
							<td style="width:20%;" align="right">ยอดคงเหลือ</td>
							<td style="width:20%;" align="right">เดือนนี้ชำระแล้ว</td>
							<td style="width:20%;" align="center">บริษัท</td>
							
						</tr>
						
						<?php 
							for($i=1; $i<=$num; $i++){
								$row = mysql_fetch_array($result);	
								if($i==29 || $i==80 || $i==123){ echo '<td colspan="4" style="height:200px;">&nbsp;</td>';}
								if($rowtype != $row['sl_type']){ echo '<tr><td colspan="4" align="center"><hr></td></tr> <tr><td colspan="6" align="left" style="font-weight:bold; font-family: Kanit, sans-serif; font-size:20px; color:blue;">'.$row["to_typename"].'</td></tr>'; $rowtype = $row['sl_type'];}
								if($i==29 || $i==80 || $i==123){ echo '<td colspan="4" align="right">'.$today .'</td>';}
								
						
						?>
							<tr style="font-size: 16px; border: 1px solid black;">
								<td> <?php echo $row['sl_name']; ?> </td>
								
								<?php 
									$sql_debt = "SELECT s.sl_id, s.sl_name,s.sl_type, SUM(p.po_price) sumprice, SUM(p.po_mudjum) mudjum, SUM(p.po_price)-SUM(p.po_mudjum) AS yod ,  COUNT(p.po_id) AS bill , s.sl_corp
											  FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id
											  WHERE s.sl_publish = 1 AND p.po_credit = 1 AND p.po_credit_complete = 0
											  GROUP BY p.po_shop
											ORDER BY s.sl_type, sumprice DESC";
								  $result_debt = mysql_query($sql_debt);
								  $num_debt = mysql_num_rows($result_debt);
								  
									for($j=1; $j<=$num_debt; $j++){
										$row_debt = mysql_fetch_array($result_debt);
								?>
									<?php if($row['sl_id']==$row_debt['sl_id']) { ?>
										<td align="right"> <?php echo number_format($row_debt['yod'], 2, '.', ','); ?> </td>
										<td align="right"> </td>
										<td align="center">
											<?php 
												if($row_debt['sl_corp']==1){
													$corp_name = 'CPN888';
												}else if($row_debt['sl_corp']==2){
													$corp_name = 'ท็อปคูลลิ่ง';
												}else if($row_debt['sl_corp']==3){
													$corp_name = 'TCL888';
												}else if($row_debt['sl_corp']==4){
													$corp_name = 'พระลักษณ์ไทย';
												}
												echo $corp_name; 
											
											?> 
										</td>
									<?php } ?>
										
										
										
								<?php }  ?>
								
							</tr>

						<?php } //end for  echo number_format($vatprice, 2, '.', ','); ?>
						<tr><td colspan='4'>&nbsp;</td></tr>
						<tr style="font-size:24px; font-weight:bold; color: orange; border: 1px solid black;">
							<td></td>
							<td align="center">บริษัท</td>
							<td align="right">ยอด</td>
							<td></td>	
						</tr>
						<tr>
							<td></td>
							<td align="center"><hr></td>
							<td align="right"><hr></td>
							<td></td>	
						</tr>
						<?php 
							for($i=1; $i<=$num_yod; $i++){ 
								$row_yod = mysql_fetch_array($result_yod);
						?>
							<tr style="font-size:17px; font-weight:bold; border: 1px solid black;">
								<td></td>
								<td align="center">
									<?php 
										if($row_yod['sl_corp']==1){
														$corp_name = 'CPN888';
													}else if($row_yod['sl_corp']==2){
														$corp_name = 'ท็อปคูลลิ่ง';
													}else if($row_yod['sl_corp']==3){
														$corp_name = 'TCL888';
													}else if($row_yod['sl_corp']==4){
														$corp_name = 'พระลักษณ์ไทย';
													}
													echo $corp_name; 
									?>
								</td>
								<td align="right"><?php echo number_format($row_yod['yods'], 2, '.', ','); ?></td>
								<td></td>	
							</tr>
						<?php } ?>
						<tr><td colspan='4'>&nbsp;</td></tr>
						<tr style="font-size:30px; font-weight:bold; color: green;">
							<td></td>
							<td align="center">รวม</td>
							<td align="right"><?php echo number_format($rowtotal['totalyod'], 2, '.', ',');?></td>
							<td></td>	
						</tr>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>