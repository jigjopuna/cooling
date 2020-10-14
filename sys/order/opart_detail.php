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
	<title>อะไหล่</title>
</head>
<body>
<?php 
  $yesterday = date('Y-m-d',strtotime("-1 days"));
  $dates = date('Y-m-d');
  $t_name = trim($_GET['t_name']);
  $t_id = trim($_GET['t_id']);
  
  $sql_prd = "SELECT c.cust_name, o.o_id, o.o_price,  t.t_name, b.b_id, ib.bas_price, ib.bas_qty, ib.bas_price*ib.bas_qty amount, o.o_date
				FROM (((tb_inbasket ib JOIN tb_basket b ON b.b_id = ib.bas_id)
						   JOIN tb_tools t ON t.t_id = ib.bas_prod)
						   JOIN tb_orders o ON o.o_id = b.b_oid)
						   JOIN tb_customer c ON c.cust_id = o.o_cust
				WHERE o.o_type LIKE '4%' AND b.b_type = 'A' AND t.t_id = '$t_id' 
				ORDER BY o.o_date DESC
				";
	$result_prd = mysql_query($sql_prd);
	$num_prd = mysql_num_rows($result_prd);
	

	
	
	
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
			<div class="header">ออเดอร์  <?php echo $t_name; ?></div>
			<!--<div class="header1"></div>-->
			


			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black; font-size:10px;">
						<tr>
							<td colspan="5" align="center">รายการซื้อ <?php echo $num_prd;?>  รายการ</td>
						</tr>
						<tr>
							<td>##</td>
							<td>Order</td>
							<td>ลูกค้า</td>
							<td>จำนวน</td>
							<td>ราคา</td>
							<td>ราคารวม</td>
							<td>ราคาทั้งออเดอร์</td>
							<td>วันที่</td>
						</tr>
						<?php for($i=1; $i<=$num_prd; $i++) {  
							$row_prd = mysql_fetch_array($result_prd);	
							
	
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row_prd['o_id'];?></td>
								<td><?php echo $row_prd['cust_name'];?></td>
								<td><?php echo number_format($row_prd['bas_qty'], 0, '.', ',');?></td>
								<td><?php echo $row_prd['bas_price'];?></td>
								<td><?php echo number_format($row_prd['amount'], 0, '.', ',');?></td>
								<td><?php echo number_format($row_prd['o_price'], 0, '.', ',');?></td>
								<td><?php echo $row_prd['o_date'];?></td>
							</tr>
						<?php } ?>
						
					
						
						
						
					</table><br><br>
					
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
</div>
</body>
</html>