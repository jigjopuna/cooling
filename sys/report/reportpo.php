<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>รายงาน</title>
</head>
<body>
<?php 
  $yesterday = date('Y-m-d',strtotime("-1 days"));
  $dates = date('Y-m-d');
	//$dates = '2017-12-18';
    $nkpt = 2;
	$ktb  = 3;

	//-----------------------นครปฐม---------------------------------
	//ซื้อ
	$rowbuynkpt = mysql_fetch_array(mysql_query("SELECT COUNT(po_id) countpo, SUM(po_price) sumpo FROM tb_po WHERE po_date = '$dates' AND po_subyer = $nkpt"));
	$cntbuynkpt = $rowbuynkpt['countpo'];
	$sumbuynkpt = number_format($rowbuynkpt['sumpo'], 0, '.', ',');
	
	
	//เพิ่มสต็อค
	$rowstknkpt = mysql_fetch_array(mysql_query("SELECT SUM(pu.pu_qty*t.t_cost_center) coststk, COUNT(pu.pu_id) countpu FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $nkpt"));
	$cntstknkpt = $rowstknkpt['countpu'];
	$coststknkpt = number_format($rowstknkpt['coststk'], 0, '.', ',');

	//เบิก
	$rowburknkpt = mysql_fetch_array(mysql_query("SELECT COUNT(orpd.orpd_id) countburk, SUM(orpd.orpd_cost) costburk FROM tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd_date = '$dates' AND orpd_wh = $nkpt"));
	$cntburknkpt = $rowburknkpt['countburk'];
	$costburknkpt = number_format($rowburknkpt['costburk'], 0, '.', ',');
	
	//nktp cash center
	$rowcashnkpt = mysql_fetch_array(mysql_query("SELECT cash1 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cashnkpt = number_format($rowcashnkpt['cash1'], 0, '.', ',');
	
	//ซื้อ
	$sql_ponkpt = "SELECT po_id, po_subyer, po_buyer, po_name, po_price, po_date FROM tb_po WHERE po_date = '$dates' AND po_subyer = $nkpt";
	$result_ponkpt = mysql_query($sql_ponkpt);
	$num_ponkpt = mysql_num_rows($result_ponkpt);
	
	
	//เพิ่มสต็อค
	$sql_stknkpt = "SELECT pu.pu_id, pu.pu_qty, pu.pu_date, t.t_name, t.t_cost_center, t.t_stock, t.t_stock1 FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $nkpt";
	$result_stknkpt = mysql_query($sql_stknkpt);
	$num_stknkpt = mysql_num_rows($result_stknkpt);
	
	
	//เบิก
	$sql_burknkpt = "SELECT t.t_name, t.t_cost_center, orpd.orpd_id, orpd.orpd_qty, orpd.orpd_date, e.e_name, c.cust_name FROM (((tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp) JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_customer c ON c.cust_id = o.o_cust WHERE orpd_date = '$dates' AND orpd.orpd_wh = $nkpt";
	$result_burknkpt = mysql_query($sql_burknkpt);
	$num_burknkpt = mysql_num_rows($result_burknkpt);
  
    /*echo "num_ponkpt : ".$num_ponkpt.'<br>';
	echo "num_stknkpt : ".$num_stknkpt.'<br>';
	echo "num_burknkpt : ".$num_burknkpt.'<br>';*/
	
	//exit();
	
	//----------------------------กระทุ่มแบน--------------------------------
	
	//ซื้อ
	$rowbuyktb = mysql_fetch_array(mysql_query("SELECT COUNT(po_id) countpo, SUM(po_price) sumpo FROM tb_po WHERE po_date = '$dates' AND po_subyer = $ktb"));
	$cntbuynktb = $rowbuyktb['countpo'];
	$sumbuyktb = number_format($rowbuyktb['sumpo'], 0, '.', ',');
	
	
	//เพิ่มสต็อค
	$rowstkktbt = mysql_fetch_array(mysql_query("SELECT SUM(pu.pu_qty*t.t_cost_center) coststk, COUNT(pu.pu_id) countpu FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $ktb"));
	$cntstkktb = $rowstkktb['countpu'];
	$coststkktb = number_format($rowstkktb['coststk'], 0, '.', ',');

	//เบิก
	$rowburkktb = mysql_fetch_array(mysql_query("SELECT COUNT(orpd.orpd_id) countburk, SUM(orpd.orpd_cost) costburk FROM tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd_date = '$dates' AND orpd_wh = $ktb"));
	$cntburkktb = $rowburkktb['countburk'];
	$costburkktb = number_format($rowburkktb['costburk'], 0, '.', ',');
	
	//nktp cash center
	$rowcashktb = mysql_fetch_array(mysql_query("SELECT cash1 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cashktb = number_format($rowcashktb['cash1'], 0, '.', ',');
	
	//ซื้อ
	$sql_poktb = "SELECT po_id, po_subyer, po_buyer, po_name, po_price, po_date FROM tb_po WHERE po_date = '$dates' AND po_subyer = $ktb";
	$result_poktb = mysql_query($sql_poktb);
	$num_poktb = mysql_num_rows($result_poktb);
	
	
	//เพิ่มสต็อค
	$sql_stkktb = "SELECT pu.pu_id, pu.pu_qty, pu.pu_date, t.t_name, t.t_cost_center, t.t_stock, t.t_stock1 FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $ktb";
	$result_stkktb = mysql_query($sql_stkktb);
	$num_stkktb = mysql_num_rows($result_stkktb);
	
	
	//เบิก
	$sql_burkktb = "SELECT t.t_name, t.t_cost_center, orpd.orpd_id, orpd.orpd_qty, orpd.orpd_date, e.e_name, c.cust_name FROM (((tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp) JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_customer c ON c.cust_id = o.o_cust WHERE orpd_date = '$dates' AND orpd.orpd_wh = $ktb";
	$result_burkktb = mysql_query($sql_burkktb);
	$num_burkktb = mysql_num_rows($result_burkktb);
?>
<style>
body {
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 21cm;
        min-height: 31cm;
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
       /* padding: 1cm;*/
        border: 1px white solid;
        height: 256mm;
       /*outline: 2cm #FFEAEA solid;*/
    }
	table { font-size: 10pt; }
	tr { height: 25px;}
	td.rlb{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; }
	td.rlt{ border-right:solid black 1px; border-left:solid black 1px;border-top:solid black 1px; }
	td.all{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; border-top:solid black 1px; }
	td.rl{ border-right:solid black 1px; border-left:solid black 1px; }
	td.rt{ border-right:solid black 1px; border-top:solid black 1px; }
	td.r{ border-right:solid black 1px;  }
	td.l{ border-left:solid black 1px; padding: 0 5px 0 0; }
	td.br{ border-right:solid black 1px;  border-bottom:solid black 1px;}
	td.b{border-bottom:solid black 1px;}
	td.t{border-top:solid black 1px;}
	tr td:first-child{ padding: 0 0 0 5px; }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            padding-top: 1.5cm;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
.box {width: 45%; float:left; margin-left: 20px; padding-bottom: 20px;}
.header{ background-color:#EEEEE; width: 100%; text-align: center; height:50px; font-size: 2em;  }
.header1{ background-color:#EEEEE; width: 100%; text-align: center; height:40px; font-size: 1.7em;  }
.topic { font-size: 18px; font-weight: bold; text-decoration: underline; }
#pay, #income { border-bottom: 1px solid #EEEEEE; overflow: hidden; margin-bottom:35px;}

</style>
</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">
			<div class="header">สรุปประจำวันที่  <?php echo $dates; ?></div>
			<div class="header1">สโตร์นครปฐม</div>
			


			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="5" align="center">รายการซื้อ <?php if($cntbuynkpt=='') echo 0; else echo $cntbuynkpt;?> รายการ</td>
						</tr>
						<tr>
							<td>#</td>
							<td>รายการ</td>
							<td>ราคา</td>
							<td>วันที่</td>
						</tr>
						<?php for($i=1; $i<=$num_ponkpt; $i++) {  
							$row_ponkpt = mysql_fetch_array($result_ponkpt);
						?>
							<tr>
								<td><?php echo $row_ponkpt['po_id'];?></td>
								<td><?php echo $row_ponkpt['po_name'];?></td>
								<td><?php echo number_format($row_ponkpt['po_price'], 0, '.', ',');?></td>
								<td><?php echo $row_ponkpt['po_date'];?></td>
							</tr>
						<?php } ?>
						<tr>
							<td>&nbsp; </td>
							<td>รวม </td>
							<td><?php echo $sumbuynkpt; ?>  </td>
							<td>บาท </td>
						</tr>
						
					</table><br><br>
					
					
					
					
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">ใส่สต็อคสโตร์นครปฐม <?php if($cntstknkpt=='') echo 0; else echo $cntstknkpt; ?> รายการ</td>
						</tr>
						<tr>
							<td>#</td>
							<td>รายการ</td>
							<td>จำนวน</td>
							<td>ราคากลาง</td>
							<td>สต็อคนครปฐม</td>
							<td>สต็อคกระทุ่มแบน</td>
						</tr>
						
						<?php for($i=1; $i<=$num_stknkpt; $i++) {  
							$row_stknkpt = mysql_fetch_array($result_stknkpt);
						?>
							<tr>
								<td><?php echo $row_stknkpt['pu_id'];?></td>
								<td><?php echo $row_stknkpt['t_name'];?></td>
								<td><?php echo $row_stknkpt['pu_qty'];?></td>
								<td><?php echo $row_stknkpt['t_cost_center'];?></td>
								<td><?php echo $row_stknkpt['t_stock'];?></td>
								<td><?php echo $row_stknkpt['t_stock1'];?></td>
							</tr>
						<?php } ?>
						<tr>
							<td>&nbsp; </td>
							<td>&nbsp; </td>
							<td>รวม </td>
							<td><?php echo $coststknkpt; ?> </td>
							<td>บาท </td>
						</tr>
	
						
					</table>
					

				
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	<div class="page">
        <div class="subpage">
			<table style="width:100%; border: 1px solid black;">
				<tr>
					<td colspan="6" align="center">เบิกของ สโตร์นครปฐม <?php if($cntburkktb=='') echo 0; else echo $cntburknkpt?> รายการ</td>
				</tr>
				<tr>
					<td>#</td>
					<td>รายการ</td>
					<td>จำนวน</td>
					<td>ราคากลาง</td>
					<td>คนเบิก</td>
					<td>งานลูกค้า</td>
				</tr>
				<?php for($i=1; $i<=$num_burknkpt; $i++) {  
					$row_burknkpt = mysql_fetch_array($result_burknkpt);
				?>
				
				<tr>
					<td><?php echo $row_burknkpt['orpd_id'];?></td>
					<td><?php echo $row_burknkpt['t_name'];?></td>
					<td><?php echo $row_burknkpt['orpd_qty'];?></td>
					<td><?php echo $row_burknkpt['t_cost_center'];?></td>
					<td><?php echo $row_burknkpt['e_name'];?></td>
					<td><?php echo $row_burknkpt['cust_name'];?></td>
				</tr>
				<?php } ?>
				
				<tr>
					<td>&nbsp; </td>
					<td>&nbsp; </td>
					<td>รวม </td>
					<td><?php echo $costburknkpt; ?> </td>
					<td>บาท </td>
					<td>&nbsp; </td>
				</tr>
						
			</table>
		</div>	
    </div> <!--end page-->
	
	
	
	
	
						<!--Kratumban-->
	
	
	<div class="page">
        <div class="subpage">
			<div class="header">สรุปประจำวันที่  <?php echo $dates; ?></div>
			<div class="header1">สโตร์กระทุ่มแบน</div>
			<table style="width:100%; border: 1px solid black;">
				<tr>
							<td colspan="5" align="center">รายการซื้อ <?php echo $cntbuyktb;?> รายการ</td>
						</tr>
						<tr>
							<td>#</td>
							<td>รายการ</td>
							<td>ราคา</td>
							<td>วันที่</td>
						</tr>
						<?php for($i=1; $i<=$num_poktb; $i++) {  
							$row_poktb = mysql_fetch_array($result_poktb);
						?>
							<tr>
								<td><?php echo $row_poktb['po_id'];?></td>
								<td><?php echo $row_poktb['po_name'];?></td>
								<td><?php echo number_format($row_poktb['po_price'], 0, '.', ',');?></td>
								<td><?php echo $row_poktb['po_date'];?></td>
							</tr>
						<?php } ?>
						<tr>
							<td>&nbsp; </td>
							<td>รวม </td>
							<td><?php echo $sumbuyrow_poktb; ?>  </td>
							<td>บาท </td>
						</tr>
						
			</table><br><br>
			
			<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">ใส่สต็อคสโตร์กระทุ่มแบน <?php if($cntstkktb=='') echo 0; else echo $cntstkktb; ?> รายการ</td>
						</tr>
						<tr>
							<td>#</td>
							<td>รายการ</td>
							<td>จำนวน</td>
							<td>ราคากลาง</td>
							<td>สต็อคนครปฐม</td>
							<td>สต็อคกระทุ่มแบน</td>
						</tr>
						
						<?php for($i=1; $i<=$num_stkktb; $i++) {  
							$row_stkktb = mysql_fetch_array($result_stkktb);
						?>
							<tr>
								<td><?php echo $row_stkktb['pu_id'];?></td>
								<td><?php echo $row_stkktb['t_name'];?></td>
								<td><?php echo $row_stkktb['pu_qty'];?></td>
								<td><?php echo $row_stkktb['t_cost_center'];?></td>
								<td><?php echo $row_stkktb['t_stock'];?></td>
								<td><?php echo $row_stkktb['t_stock1'];?></td>
							</tr>
						<?php } ?>
						<tr>
							<td>&nbsp; </td>
							<td>&nbsp; </td>
							<td>รวม </td>
							<td><?php echo $coststkktb; ?> </td>
							<td>บาท </td>
						</tr>
	
						
					</table>
		</div>	
    </div> <!--end page-->
	
	
	
	
	
					
	
	<div class="page">
        <div class="subpage">
			<table style="width:100%; border: 1px solid black;">
				<tr>
					<td colspan="6" align="center">เบิกของ สโตร์กระทุ่มแบน <?php if($cntburkktb=='') echo 0; else echo $cntburkktb?> รายการ</td>
				</tr>
				<tr>
					<td>#</td>
					<td>รายการ</td>
					<td>จำนวน</td>
					<td>ราคากลาง</td>
					<td>คนเบิก</td>
					<td>งานลูกค้า</td>
				</tr>
				<?php for($i=1; $i<=$num_burkktb; $i++) {  
					$row_burkktb = mysql_fetch_array($result_burkktb );
				?>
				
				<tr>
					<td><?php echo $row_burkktb['orpd_id'];?></td>
					<td><?php echo $row_burkktb['t_name'];?></td>
					<td><?php echo $row_burkktb['orpd_qty'];?></td>
					<td><?php echo $row_burkktb['t_cost_center'];?></td>
					<td><?php echo $row_burkktb['e_name'];?></td>
					<td><?php echo $row_burkktb['cust_name'];?></td>
				</tr>
				<?php } ?>
				
				<tr>
					<td>&nbsp; </td>
					<td>&nbsp; </td>
					<td>รวม </td>
					<td><?php echo $costburkktb; ?> </td>
					<td>บาท </td>
					<td>&nbsp; </td>
				</tr>
						
			</table>
		</div>	
    </div> <!--end page-->
	
	
	
	
	
</div>
</body>
</html>