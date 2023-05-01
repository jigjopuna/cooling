<?php session_start(); 
      require_once('../../include/connect.php'); 
	  $sql = "SELECT c.cust_name, c.cust_lineid, c.cust_tel, t.t_id, o.o_id, o.o_date, t.t_name, t.t_cost, o.o_price
					FROM (tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id)
						  JOIN tb_tools t ON t.t_id = o.o_part_id
					WHERE o.o_type LIKE '4%' ORDER BY o.o_id DESC LIMIT 0, 300";
	$result= mysqli_query($con, $sql);
	$num = mysqli_num_rows($result);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>ออเดอร์อะไหล่</title>
<?php require_once('../../include/metatagsys.php');?>
<?php require_once('../../include/inc_role.php'); ?>

<link href="../../css/report.css" rel="stylesheet">
    
</head>
<body>
	<page size="A4">
		<table> 
			<tr>
				<td style="height: 30px; font-size: 20px; font-weight:bold;" colspan='16' align="center"> ออเดอร์อะไหล่  <?php echo DATE("d-m-Y")?></td>
			</tr>
			<tr>
										<th style="width:5%">ออเดอร์</th>
                                        <th style="width:25%">ชื่อลูกค้า</th> 
                                        <th style="width:8%">เบอร์</th>
                                        <th style="width:25%">ชื่ออะไหล่</th>
										<th style="width:7%">ต้นทุน</th>
										<th style="width:7%">ราคาขาย</th>
										<th style="width:7%">กำไร</th>
										<th style="width:5%">%</th>
										<th style="width:8%">วันที่</th>
										
										
                                    </tr>
			<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysqli_fetch_array($result);
										  $karai = $row['o_price']-$row['t_cost'];
										  $percen = ($karai*100)/$row['o_price'];
									  ?>
										<tr class="gradeA"> 
											<td align='center'><?php echo $row['o_id']; ?></td>
											<td><?php echo $row['cust_name']; ?></td>
											<td align='center'><?php echo $row['cust_tel']; ?></td>
											<td><?php echo $row['t_name']; ?></td>
											<td align='right'><?php echo number_format($row['t_cost'], 0, '.', ','); ?></td>
											<td align='right'><?php echo number_format($row['o_price'], 0, '.', ','); ?></td>
											<td align='right'><?php echo  number_format($karai, 0, '.', ','); ?></td>
											<td align='center'><?php echo number_format($percen, 2, '.', ','); ?></td>
											<td align='center'><?php echo $row['o_date'];; ?></td>
											
										</tr>
									<?php } ?>
			
		</table>
	</page>
	
</body>
</html>