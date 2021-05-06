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
  
    $sql_prd = "SELECT orpd.orpd_id, t.t_id, t.t_name, t.t_type, t.t_subtype, orpd.orpd_qty, orpd.orpd_cost, orpd.orpd_date, t.t_cost, tt.to_typename
	FROM (((tb_ord_prod orpd JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp)
		  JOIN tb_tools_type tt ON tt.to_typeid = t.t_type
	WHERE orpd.o_id = '$o_id' ORDER BY t.t_type, t.t_subtype, t.t_name";
	$result_prd = mysql_query($sql_prd);
	$num_prd = mysql_num_rows($result_prd);
	
	$sql_grouptype = "SELECT tt.to_typename, SUM(t.t_cost*orpd.orpd_qty) sumcost  
				FROM (tb_ord_prod orpd JOIN tb_tools t ON orpd.ot_id = t.t_id)
					  JOIN tb_tools_type tt ON tt.to_typeid = t.t_type
				WHERE orpd.o_id = '$o_id'
				GROUP BY t.t_type
				ORDER BY t.t_type ASC";
	$result_grouptype = mysql_query($sql_grouptype);
	$num_grouptype = mysql_num_rows($result_grouptype);
	
	
    $sql_po = "SELECT * FROM tb_po WHERE po_orders = '$o_id'";
	$result_po = mysql_query($sql_po);
	$num_po = mysql_num_rows($result_po);
	
	$row_sumcost = mysql_fetch_array(mysql_query("SELECT SUM(orpd_cost) sumcost FROM tb_ord_prod WHERE o_id = '$o_id'"));
	$sumprod = $row_sumcost['sumcost'];
	
	$rowpocost = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice, COUNT(po_id) cntpoid FROM tb_po WHERE po_orders = '$o_id'"));
	$pocost = $rowpocost['poprice'];
	
	$rowprice = mysql_fetch_array(mysql_query("SELECT o_price, o_type FROM tb_orders WHERE o_id = '$o_id'"));
	$oprice = $rowprice['o_price'];
	$otype = $rowprice['o_type'];
	
	
	
	$manage = 50000;
	
	$costs = $sumprod+$pocost;
	
	$kumrai = $oprice - $costs - $manage; 
	
	$rowtype = 0;
	$rowspace = 0;
	
	
	
?>
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style>
		tr{ height: 11px; }
		.header{ background-color:#EEEEE; width: 100%; text-align: center; height:50px; font-size: 2.2em;  }
		.header1{ background-color:#EEEEE; width: 100%; text-align: center; height:40px; font-size: 1.7em;  }
		.summary { border: 1px solid black; font-size:14px; font-weight:bold; }
		.suptopic{ font-size:18px; font-weight:bold; font-family: Kanit, sans-serif;}
		.column-text { font-size:16px; font-weight:bold; font-family: Kanit, sans-serif;}
		
	</style>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php');?>
</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">
			<div id="cover_header">
				<?php include ('../../include/cpn_addr.php'); ?>
			</div>
			
			<div class="header_report" style="padding-top: 50px;"><p>ออเดอร์ C<?php echo $otype.'-'.$o_id; ?></p></div>

			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black; font-size:14px;">
						<tr>
							<td colspan="6" align="center" class="suptopic">รายการเบิก <?php echo $num_prd+$num_po;?>  รายการ  (  <?php echo $dates; ?>)</td>
						</tr>
						
						<tr>
							<td colspan="6" align="center" class="suptopic" style="font-size:16px;">ลูกค้า <?php echo $custname; ?></td>
						</tr>
						
						<tr class="column-text">
							<td># (id)</td>
							<td align="center">รายการ</td>
							<td>ราคา</td>
							<td>จำนวน</td>
							<td>รวมราคา</td>
							<td align="center">วันที่</td>
						</tr>
						<?php for($i=1; $i<=$num_prd; $i++) {  
							$row_prd = mysql_fetch_array($result_prd);	
							
							
							if($rowtype != $row_prd['t_type']){ echo '<tr><td colspan="6" align="center"><hr></td></tr> <tr><td colspan="6" align="left" style="font-weight:bold; font-family: Kanit, sans-serif">'.$row_prd["to_typename"].'</td></tr>'; $rowtype = $row_prd['t_type'];}
							if( ($row_prd['t_type'] == 3) AND  ($row_prd['t_subtype'] == 2) AND ($tucontrol == 0)){ echo ' <tr><td colspan="6" align="left" style="font-weight:bold; font-family: Kanit, sans-serif">ตู้คอนโทรล</td></tr>'; $tucontrol = 1; }
							if($i==34 || $i==80 || $i==123){ echo '<td colspan="6" style="height:120px;">&nbsp;</td>';}
						?>
							<tr>
								<td style="font-size:12px;"><?php echo $i.' ('.$row_prd['t_id'].')'?></td>
								<td><?php echo $row_prd['t_name'];?></td>
								<td><?php echo number_format($row_prd['t_cost'], 0, '.', ',');?></td>
								<td><?php echo $row_prd['orpd_qty'];?></td>
								<td><?php echo number_format($row_prd['orpd_cost'], 0, '.', ',');?></td>
								<td><?php echo $row_prd['orpd_date'];?></td>
							</tr>
						<?php } ?>
						<tr><td colspan="6" align="center"><hr></td></tr>
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
							<td><?php echo number_format($costs, 0, '.', ',');?></td>
							<td>บาท </td>
						</tr>
						
						<tr>
							<td colspan='6'>&nbsp; </td>
						</tr>
						
						
						<tr>
							<td colspan='2'>&nbsp; </td>
							<td align="center" class="summary" style="color:blue; font-size:18px !important;"> ประเภทสินค้า </td>
							<td colspan='2' align="center" class="summary" style="color:blue; font-size:18px !important;"> ยอดรวม </td>
							<td>&nbsp; </td>
						</tr>
						
						<?php 
							for($i=1; $i<=$num_grouptype; $i++) {  
							$row_grouptype = mysql_fetch_array($result_grouptype);
						?>
							<tr>
								<td colspan='2'>&nbsp; </td>
								<td align="center" class="summary"> <?php echo $row_grouptype['to_typename'];?> </td>
								<td colspan='2' align="right" class="summary"> <?php echo number_format($row_grouptype['sumcost'], 2, '.', ',');?> </td>
								<td>&nbsp; </td>
							</tr>
						<?php } ?>
						
						<tr>
								<td colspan='2'>&nbsp; </td>
								<td align="center" class="summary">รวม </td>
								<td colspan='2' align="right" class="summary" style="color:green;"> <?php echo number_format($sumprod, 2, '.', ',');?> </td>
								<td>&nbsp; </td>
							</tr>
						
						
						<tr>
							<td colspan='6'>&nbsp; </td>
						</tr>
						<tr>
							<td colspan='6'>&nbsp; </td>
						</tr>

						
						<tr>
							<td colspan='2'>&nbsp; </td>
							<td align="right" class="summary"> ราคาขาย </td>
							<td colspan='2' align="right" class="summary"> <?php echo number_format($oprice, 2, '.', ',');?> </td>
							<td>&nbsp; </td>
						</tr>
							
						<tr>
							<td colspan='2'>&nbsp; </td>
							<td align="right" class="summary"> ต้นทุน  </td>
							<td colspan='2' align="right" class="summary"> <?php echo number_format($costs, 2, '.', ',');?> </td>
							<td>&nbsp; </td>
						</tr>
						
						<tr>
							<td colspan='2'>&nbsp; </td>
							<td align="right" class="summary"> ค่าบริหาร  </td>
							<td colspan='2' align="right" class="summary"> <?php echo number_format($manage, 2, '.', ',');?> </td>
							<td>&nbsp; </td>
						</tr>
							
						<tr>
							<td colspan='2'>&nbsp; </td>
							<td align="right" class="summary"> กำไร </td>
							<td colspan='2' align="right" class="summary"> <?php echo number_format($kumrai, 2, '.', ',');?> </td>
							<td>&nbsp; </td>
						</tr>
						
					</table><br><br>
					
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	

	
	
</div>
</body>
</html>