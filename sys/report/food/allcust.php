<?php session_start(); 
	  require_once('../../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../../content/images/favicon.png">
	<link rel="stylesheet" href="../../../css/quotation.css">
	<link rel="stylesheet" href="../../../css/report.css">
	<title>ลูกค้าทั้งหมด</title>
</head>
<body>
<?php 
  $yesterday = date('Y-m-d',strtotime("-1 days"));
  $dates = date('Y-m-d');
  
  $sql = "SELECT o.o_id, c.cust_name, p.pro_name, c.cust_tel, cp.cusp_name, o.o_cuprod, o.o_date, o.o_cuprodtyp
				FROM ((tb_orders o JOIN tb_cus_prod_type cp ON o.o_cuprodtyp = cp.cusp_id)
					 JOIN tb_customer c ON c.cust_id = o.o_cust)
					 JOIN province p ON p.id = o.o_cuprovin
				WHERE o.o_type LIKE '1%'
				ORDER BY cp.cusp_id, p.id";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
    $rowtype = 0;
	$rowspace = 0;
	
	
?>
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
<?php require_once('../../include/metatagsys.php');?>
<?php require_once('../../include/inc_role.php');?>
</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">
			<div id="cover_header">
				<?php include ('../../../include/cpn_addr.php'); ?>
			</div>
			
			<div class="header_report" style="padding-top: 50px;"><p>ลูกค้าห้องเย็นทั้งหมด</p></div>
			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">	
					<table style="width:100%; border: 1px solid black; font-size:14px;">
						<!--<tr>
							<td colspan="6" align="center" class="suptopic">รายการเบิก</td>
						</tr>-->
						
						
						<tr class="column-text">
							<td style="width:10%"># (id)</td>
							<td style="width:32%" align="center">ลูกค้า</td>
							<td style="width:15%">จังหวัด</td>
							<td style="width:15%">เบอร์ติดต่อ</td>
							<td style="width:15%"> สินค้า</td>
							<td style="width:10%" align="center">ปี</td>
						</tr>
						<?php for($i=1; $i<=$num; $i++) {  
							$row = mysql_fetch_array($result);	
							
							if($rowtype != $row['o_cuprodtyp']){ echo '<tr><td colspan="6" align="center"><hr></td></tr> <tr><td colspan="6" align="left" style="font-weight:bold; font-family: Kanit, sans-serif">'.$row["cusp_name"].'</td></tr>'; $rowtype = $row['o_cuprodtyp'];}
							//if($i==37 || $i==85 || $i==131 || $i==177 || $i==223 || $i==269){ echo '<td colspan="6" style="height:120px;">&nbsp;</td>';}
						?>
							<tr  style="font-size:14px;">
								<td><?php echo $i.' ('.$row['o_id'].')'?></td>
								<td style="font-size:12px;"><?php echo $row['cust_name'];?></td>
								<td><?php echo $row['pro_name'];?></td>
								<td><?php echo $row['cust_tel'];?></td>
								<td><?php echo $row['o_cuprod'];?></td>
								<td><?php echo date("Y", strtotime($row['o_date']));?></td>
								
							</tr>
						<?php } ?>
						
						
					</table><br><br>
					
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	

	
	
</div>
</body>
</html>