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
 /* $d1 = '2017-12-18';
  $date = date_create($d1);
  date_modify($date, '-1 day');
  $d2 = date_format($date, 'Y-m-d');
  http://php.net/manual/en/datetime.modify.php
  
  echo 'd2 : '.$d2.'<br>';
  exit();*/
  
  $yesterday = date('Y-m-d',strtotime("-1 days"));
  $dates = date('Y-m-d');
  //$dates = '2017-12-23';
  
  include('../include/sql_report1.php'); 
  
  $row_yokyod = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center WHERE cash_date = '$yesterday' ORDER BY cash_id DESC LIMIT 1"));
  
  $result_po = mysql_query("SELECT e.e_name, p.po_buyer, p.po_subyer, p.po_name, p.po_price, p.po_shop FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer WHERE p.po_date = '$dates'");
  $num_po = mysql_num_rows($result_po);
  
  $result_getcash = mysql_query("SELECT e.e_name, c.cust_name, ordp.pay_amount FROM ((tb_ord_pay ordp JOIN tb_orders ord ON ord.o_id = ordp.o_id) JOIN tb_customer c ON c.cust_id = ord.o_cust) JOIN tb_emp e ON e.e_id = ordp.o_emp_receive WHERE ordp.pay_date = '$dates'");
  $num_getcash = mysql_num_rows($result_getcash);
  
  $result_sal = mysql_query("SELECT e.e_name, s.sal_amount, s.sal_date FROM tb_salary s JOIN tb_emp e ON e.e_id = s.sal_emp WHERE s.sal_date = '$dates'");
  $num_sal = mysql_num_rows($result_sal);
  
  
  
	
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
#header{ background-color:#EEEEE; width: 100%; text-align: center; height:60px; font-size: 2em;  }
.header{ background-color:#EEEEE; width: 100%; text-align: center; height:50px; font-size: 2em;  text-decoration: underline;}
.header1{ background-color:#EEEEE; width: 100%; text-align: center; height:40px; font-size: 1.7em;  }
.topic { font-size: 18px; font-weight: bold; text-decoration: underline; }
#pay, #income { border-bottom: 1px solid #EEEEEE; overflow: hidden; margin-bottom:35px;}

</style>
</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">
			<div id="header">สรุปประจำวันที่  <?php echo $dates; ?></div>
			<div id="income" style="width:100%; /*height:200px;*/">
				<div class="box"><span class="topic">ยกยอดมาของวัน <?php echo $yesterday;?></span><br>
					ชูเกียรติ :  <?php echo number_format($row_yokyod['cash1'], 0, '.', ','); ?>  บาท<br>   
					ไพรฑูรย์ : <?php echo number_format($row_yokyod['cash2'], 0, '.', ','); ?> บาท<br>
					ยกยอดรวม : <?php echo number_format($row_yokyod['cash_now'], 0, '.', ','); ?> บาท<br>
				</div>
				<div class="box boxleft"><span class="topic">คงค้างเครดิต</span><br>
					<?php for($i=1; $i<=$num_remain; $i++) { 
						$row_remain = mysql_fetch_array($result_remain); 
					?>
							<?php echo $row_remain['e_name']." : ".number_format($row_remain['poprice2'], 0, '.', ',')." บาท<br>";?>
					<?php } ?>
										
						
									
				</div>
			</div>
			<div id="pay" style="width:100%; /*height:350px;*/"> 
				<div class="box"><span class="topic">เงินเข้า</span><br>
					<?php for($i=1; $i<=$num_income; $i++) { 
						$row_income = mysql_fetch_array($result_income); 
					?>
					<?php echo $row_income['e_name']." : ".number_format($row_income['income'], 0, '.', ',')." บาท<br>";?>
					<?php } ?>
					<br><br>
					<span class="topic">ยอดเงินเข้าทั้งหมด</span><br>
					<?php echo $incomes." บาท";?>
				</div>
				
				<div class="box boxleft">
					<span class="topic">ค่าใช้จ่ายเงินสด</span><br>
					<?php for($i=1; $i<=$num_cash; $i++) { 
							$row_cash = mysql_fetch_array($result_cash); 
					?>
					
						<?php echo $row_cash['e_name']." : ".number_format($row_cash['poprice1'], 0, '.', ',')." บาท<br>";?>
					
					<?php }  if($num_cash==0) echo 0;?>
					
					
					<!--ค่าใช้จ่ายเงินสดส่วนกลางแยกตามคน-->
					<?php for($i=1; $i<=$num_cashemp; $i++) { 
						$row_cashemp = mysql_fetch_array($result_cashemp); 
					?>
						<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;-".$row_cashemp['e_name']." : ".number_format($row_cashemp['priceemp'], 0, '.', ',')." บาท<br>";?>
					<?php } ?>
					
					
					
					<br><br>
					<span class="topic">ค่าใช้จ่ายเครดิต</span><br>
					<?php for($i=1; $i<=$num_credit; $i++) { 
						$row_credit = mysql_fetch_array($result_credit); 
					?>
					
						<?php echo $row_credit['e_name']." : ".number_format($row_credit['poprice1'], 0, '.', ',')." บาท<br>";?>
					
					<?php } if($num_credit==0) echo 0;?>
					
					<br><br>
					<span class="topic">ค่าใช้จ่ายเงินสดและเครดิต</span><br>
					<?php echo $paydates." บาท";?><br><br>
					
					<span class="topic">จ่ายเงินพนักงาน</span><br>
					<?php for($i=1; $i<=$num_paysal; $i++) { 
							$row_paysal = mysql_fetch_array($result_paysal); 
					?>
						<?php echo $row_paysal['e_name']." : ".number_format($row_paysal['salaries'], 0, '.', ',')." บาท<br>";?>
					<?php } ?>
					
											
				</div>
			</div>
			
			
			
			<div id="summary" style="/*background-color:olive;*/ width:100%;">
				<div class="box" style="/*background-color:yellow;*/">
					<span class="topic">เงินคงเหลือ</span><br>
					<span class="">เงินกองกลางคงเหลือ</span><br>
						<?php echo $cur_cash. ' บาท';?><br><br>
						<span class="">ชูเกียรติ คงเหลือ</span><br>
						<?php echo $cash1. ' บาท';?><br><br>
						<span class="">ไพรฑูรย์ คงเหลือ </span><br>
						<?php echo $cash2. ' บาท';?>
				</div>
				<div class="box" style="/*background-color:green;*/">
					<span class="topic">โยกย้ายเงิน</span><br>
					<?php
						if($num_trancash==0) {
							echo 'ไม่มีโยกย้าย';
						}else{
							for($i=1; $i<=$num_trancash; $i++){
								$row_trancash = mysql_fetch_array($result_trancash);					
								if($row_trancash['cash_salary']==23){
									$cashid = $row_trancash['cash_id']-1;
									$rowdifcash = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center WHERE cash_id = $cashid"));
									$diff = number_format($rowdifcash['cash1']-$row_trancash['cash1'], 0, '.', ',');
									
									echo 'ชายโยกไปพี่ไพรฑูรย์ '.$diff.' บาท<br>';
								
								}else{
									
									$cashid = $row_trancash['cash_id']-1;
									$rowdifcash = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center WHERE cash_id = $cashid"));
									$diff = number_format($rowdifcash['cash2']-$row_trancash['cash2'], 0, '.', ',');
									echo 'พี่ไพรฑูรย์โยกไป ชาย '.$diff.' บาท<br>';
								}
							}
					} ?>
					
					
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	
	<div class="page">
        <div class="subpage">
			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center" class='header'>รายการสั่งซื้อ / ค่าใช้จ่าย</td>
						</tr>
						<tr>
							<td>#</td>
							<td>รายการ</td>
							<td>ราคา</td>
							<td>คนซื้อ</td>
							<td>บัญชี</td>
							<td>ร้านค้า</td>
						</tr>
						<?php for($i=1; $i<=$num_po; $i++) {  
							$row_po = mysql_fetch_array($result_po);
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row_po['po_name'];?></td>
								<td><?php echo number_format($row_po['po_price'], 0, '.', ',');?></td>
								<td><?php echo $row_po['e_name'];?></td>
								<td><?php if($row_po['po_subyer']==2) echo "ชูเกียรติ"; else echo "ไพรฑูรย์";?></td>
								<td><?php echo $row_po['po_shop'];?></td>
							</tr>
						<?php } ?>
						
						<tr style="background-color: yellow">
							<td colspan='2' align="center">ยอดรวม</td>
							<td><?php echo $paydates;?></td>
							<td>บาท</td>
						</tr>
						
					</table><br><br>
					
					
					
						
					
				
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	<div class="page">
        <div class="subpage">
			<table style="width:100%; border: 1px solid black;">
				<tr>
					<td colspan="4" align="center" class='header'>เงินเดือน</td>
				</tr>
				<tr>
					<td>#</td>
					<td>พนักงาน</td>
					<td>จำนวนเงิน</td>
					<td>วันที่</td>
				</tr>
					<?php for($i=1; $i<=$num_sal; $i++) {  
						$row_sal = mysql_fetch_array($result_sal);
					?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $row_sal['e_name'];?></td>
					<td><?php echo number_format($row_sal['sal_amount'], 0, '.', ',');?></td>
					<td><?php echo $row_sal['sal_date'];?></td>
				</tr>
						<?php } ?>
						
			</table><br><br>
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="4" align="center" class='header'>ลูกค้าโอน</td>
						</tr>
						<tr>
							<td>#</td>
							<td>ชื่อลูกค้า</td>
							<td>จำนวนโอน</td>
							<td>คนรับเงิน</td>
						</tr>
						<?php for($i=1; $i<=$num_getcash; $i++) {  
							$row_getcash = mysql_fetch_array($result_getcash);
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row_getcash['cust_name'];?></td>
								<td><?php echo number_format($row_getcash['pay_amount'], 0, '.', ',');?></td>
								<td><?php echo $row_getcash['e_name'];?></td>
							</tr>
						<?php } ?>
						
					</table>
		</div>	
    </div> <!--end page-->
	
	
	<div class="page">
        <div class="subpage">
			<div class="header">สรุปประจำวันที่  <?php echo $dates; ?></div>
			<div class="header1">สโตร์นครปฐม</div>
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