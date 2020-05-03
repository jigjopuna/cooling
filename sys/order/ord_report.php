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
	<title>สรุปรายการห้องลูกค้า</title>
</head>
<body>
<?php 
  $yesterday = date('Y-m-d',strtotime("-1 days"));
  $dates = date('Y-m-d');
  $custname = trim($_GET['custname']);
  $o_id = trim($_GET['o_id']);
  
  $sql_prd = "SELECT orpd.orpd_id, t.t_id, t.t_name, t.t_type, orpd.orpd_qty, orpd.orpd_qty*t.t_cost total, orpd.orpd_date, t.t_cost
	FROM ((tb_ord_prod orpd JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp
	WHERE orpd.o_id = '$o_id' ORDER BY t.t_type, t.t_name";
	$result_prd = mysql_query($sql_prd);
	$num_prd = mysql_num_rows($result_prd);
	
  $sql_po = "SELECT * FROM tb_po WHERE po_orders = '$o_id'";
	$result_po = mysql_query($sql_po);
	$num_po = mysql_num_rows($result_po);
	
	$row_sumcost = mysql_fetch_array(mysql_query("SELECT SUM(orpd_cost) sumcost FROM tb_ord_prod WHERE o_id = '$o_id'"));
	$sumprod = $row_sumcost['sumcost'];
	
	$rowpocost = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice, COUNT(po_id) cntpoid FROM tb_po WHERE po_orders = '$o_id'"));
	$pocost = $rowpocost['poprice'];
	
	$rowtype = 0;
	$rowspace = 0;
	
	
	
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
			<div class="header">ออเดอร์  <?php echo $custname; ?></div>
			<!--<div class="header1"></div>-->
			


			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black; font-size:10px;">
						<tr>
							<td colspan="5" align="center">รายการซื้อ <?php echo $num_prd+$num_po;?>  รายการ</td>
						</tr>
						<tr>
							<td># (id)</td>
							<td>รายการ</td>
							<td>ราคา</td>
							<td>จำนวน</td>
							<td>รวมราคา</td>
							<td>วันที่</td>
						</tr>
						<?php for($i=1; $i<=$num_prd; $i++) {  
							$row_prd = mysql_fetch_array($result_prd);	
							
							if($rowtype != $row_prd['t_type']){ echo '<tr><td colspan="6" align="center">space</td></tr>'; $rowtype = $row_prd['t_type'];}
							if($i==58 || $i==120){ echo '<td colspan="6" style="height:60px;">&nbsp;</td>';}
						?>
							<tr>
								<td><?php echo $i.' ('.$row_prd['t_id'].')'?></td>
								<td><?php echo $row_prd['t_name'];?></td>
								<td><?php echo number_format($row_prd['t_cost'], 0, '.', ',');?></td>
								<td><?php echo $row_prd['orpd_qty'];?></td>
								<td><?php echo number_format($row_prd['total'], 0, '.', ',');?></td>
								<td><?php echo $row_prd['orpd_date'];?></td>
							</tr>
						<?php } ?>
						
						<?php for($j=1; $j<=$num_po; $j++) {  
							$row_po = mysql_fetch_array($result_po);
						?>
							<tr style="font-size:12px;">
								<td><?php echo $j;?></td>
								<td><?php echo $row_po['po_name'];?></td>
								<td><?php echo number_format($row_po['po_price'], 0, '.', ',');?></td>
								<td><?php echo $row_po['orpd_qty'];?></td>
								<td><?php echo $row_po['orpd_date'];?></td>
							</tr>
						<?php } ?>
						
						
						<tr>
							<td>&nbsp; </td>
							<td>&nbsp; </td>
							<td>รวม </td>
							<td><?php echo number_format($sumprod+$pocost, 0, '.', ',');?></td>
							<td>บาท </td>
						</tr>
						
					</table><br><br>
					
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
</div>
</body>
</html>