<?php session_start(); 
      require_once('../../include/connect.php'); 
	  $sql = "SELECT *  
			  FROM ((tb_sell_contact s JOIN tb_emp e ON s.sc_emp = e.e_id)
						JOIN province p ON p.id =  s.sc_province)
						JOIN tb_ord_status o ON o.ost_id = s.sc_action

			  WHERE o.ost_type = 0
			  ORDER BY s.sc_id DESC";
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
	<title>SELL REPORT</title>
<?php require_once('../../include/metatagsys.php');?>
<?php require_once('../../include/inc_role.php'); ?>

<link href="../../css/report.css" rel="stylesheet">
    
</head>
<body>
	<page size="A4">
		<table> 
			<tr>
				<td style="height: 30px; font-size: 20px; font-weight:bold;" colspan='16' align="center"> SELL REPORT <?php echo DATE("d-m-Y")?></td>
			</tr>
			<tr>
										<th style="width:3%">ลำดับ</th>
                                        <th style="width:10%">ชื่อลูกค้า</th> 
                                        <th style="width:8%">เบอร์</th>
                                        <th style="width:8%">จังหวัด</th>
										
                                        <th style="width:35%">รายละเอียด</th>
										
										
										<th style="width:10%">สิ่งที่ทำไป</th>
										<th style="width:10%">โอกาส</th>
										<th style="width:5%">เซลล์</th>
										<th style="width:7%">วันที่</th>
										
										
                                    </tr>
			<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysqli_fetch_array($result);
										  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row['sc_id']; ?></td>
											<td><?php echo $row['sc_name']; ?></td>
											<td><?php echo $row['sc_tel']; ?></td>
											<td><?php echo $row['pro_name']; ?></td>
											<td><?php echo $row['sc_detail']; ?></td>
											<td><?php echo $row['ost_status']; ?></td>
											
											<td><?php echo $row['sc_occu']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><?php echo $row['sc_date']; ?></td>
											
										</tr>
									<?php } ?>
			
		</table>
	</page>
	
</body>
</html>