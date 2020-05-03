<?php session_start(); 
	  require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<link rel="stylesheet" href="../../css/quotation.css">
	<title>ของที่ใช้ต่อห้อง</title>
</head>
<body>
<?php 
  $yesterday = date('Y-m-d',strtotime("-1 days"));
  $dates = date('Y-m-d');
  
  $sql = "SELECT s.sl_name, t.t_supplier, t.t_name, t.t_id, cs.cst_id, t.t_cost, cs.cst_five_meter, cs.cst_room_type
		  FROM (tb_count_stock cs JOIN tb_tools t ON t.t_id = cs.cst_prod)
		        JOIN tb_sellers s ON s.sl_id = t.t_supplier
		  ORDER BY t.t_supplier, t.t_id
		 ";
  $result = mysql_query($sql);
  $num = mysql_num_rows($result);
  
  $rowtype = 0;
?>
<style>
	tr{ height: 11px; }
	.header{ background-color:#EEEEE; width: 100%; text-align: center; height:50px; font-size: 2em;  }
	.header1{ background-color:#EEEEE; width: 100%; text-align: center; height:40px; font-size: 1.7em;  }
	
</style>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php');?>
</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">
			<div class="header">อุปกรณ์ที่ใช้ติดตั้ง</div>
			
			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black; font-size:10px;">
						<tr>
							<td colspan="5" align="center">ทั้งหมด รายการ</td>
						</tr>
						<tr>
							<td>###</td>
							<td>ร้านค้า</td>
							<td>รายการ</td>
							<td>รหัสสินค้า</td>
							<td>ต้นทุน</td>
							<td>ใช้ต่อห้อง</td>
							<td>ประเภทที่ใช้</td>
						</tr>
						<?php for($i=1; $i<=$num; $i++) {  
							$row = mysql_fetch_array($result);	
							
							if($rowtype != $row['t_supplier']){ echo '<tr><td colspan="6" align="center">space</td></tr>'; $rowtype = $row['t_supplier'];}
							if($i==55 || $i==125){ echo '<td colspan="6" style="height:60px;">&nbsp;</td>';}
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row['sl_name'];?></td>
								<td><?php echo $row['t_name'];?></td>
								<td><?php echo $row['t_id'];?></td>
								<td><?php echo number_format($row['t_cost'], 0, '.', ',');?></td>
								<td><?php echo $row['cst_five_meter'];?></td>
								<td><?php echo $row['cst_room_type'];?></td>
							</tr>
						<?php } ?>
						
						<tr>
							<td>&nbsp; </td>
							<td>&nbsp; </td>
							<td>รวม </td>
							<td></td>
							<td>บาท </td>
						</tr>
						
					</table><br><br>
					
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
</div>
</body>
</html>