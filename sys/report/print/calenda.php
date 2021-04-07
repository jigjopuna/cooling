<?php session_start(); 
      require_once('../../include/connect.php'); 
	  $sql = "SELECT * 
		    FROM tb_cash_center c
			ORDER BY c.cash_id DESC 
			LIMIT 0,200";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>สรุปการเงิน</title>
<?php require_once('../../include/metatagsys.php');?>
<?php require_once('../../include/inc_role.php'); ?>
    <style>
		body {
		  background: rgb(204,204,204); 
		}
		page[size="A4"] {
		  background: white;
		  width: 29.7cm;
		  height: 21cm;
		  display: block;
		  margin: 0 auto;
		  margin-bottom: 0.5cm;
		  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
		}
		table { width: 100%; border: 1px solid #EEEEEE; font-size: 14px;  border-spacing: 0px;}
		td, th { border: 1px solid black;  }
		@media print {
		  body, page[size="A4"] {
			margin: 0;
			box-shadow: 0;
			-webkit-print-color-adjust: exact; 
		  }
		}
	</style>
</head>
<body>
	<page size="A4">
		<table> 
			<tr>
				<td style="height: 30px; font-size: 20px; font-weight:bold;" colspan='16' align="center"> ความเคลื่อนไหวเงินในบัญชี <?php echo DATE("d-m-Y")?></td>
			</tr>
			<tr>
										<th>ลำดับ</th>
                                        <th>ซื้อของ</th>                                     
                                        <th>เลขเงินเข้า</th>
                                        <th>เงินเข้า (บาท)</th>
                                        <th>เงินออก</th>
										<th>KBT S</th>
										<th>KBT C</th>
										
										<th>TMB S</th>
										<th>TMB C</th>
										
										<th>BBL S</th>
										
										<th>SCB S</th>
										<th>SCB C</th>
									
										<th>BAY S</th>
										<th>BAY C</th>
										
										<th>KBC S</th>
										<th>KBC C</th>
										
                                    </tr>
			<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row['cash_id']; ?></td>
											<td><?php echo $row['cash_po']; ?></td>
											<td><?php echo $row['cash_ord']; ?></td>
											
											<?php if($row['cash_in'] != 0) { ?>
												<td style="background-color:pink"><?php echo number_format($row['cash_in'], 1, '.', ','); ?></td>
											<?php }else{ ?>
												<td><?php echo number_format($row['cash_in'], 1, '.', ','); ?></td>
											<?php }?>
											
											<?php if($row['cash_out'] != 0) { ?>
												<td style="background-color:#e1fb45"><?php echo number_format($row['cash_out'], 1, '.', ','); ?></td>
											<?php }else{ ?>
												<td><?php echo number_format($row['cash_out'], 1, '.', ','); ?></td>
											<?php }?>
											
											
											<td><?php echo number_format($row['cash_now'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash_now1'], 1, '.', ','); ?></td>
											
											
											<td><?php echo number_format($row['cash1'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash2'], 1, '.', ','); ?></td>
											
											<td><?php echo number_format($row['cash_salary'], 1, '.', ','); ?></td>
											
											<td><?php echo number_format($row['cash_emp'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash_emp1'], 1, '.', ','); ?></td>
											
											<td><?php echo number_format($row['cash_temp'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash_temp1'], 1, '.', ','); ?></td>
											
											<td><?php echo number_format($row['cash_kcpns'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash_kcpnc'], 1, '.', ','); ?></td>
										</tr>
									<?php } ?>
			
		</table>
	</page>
	
</body>
</html>