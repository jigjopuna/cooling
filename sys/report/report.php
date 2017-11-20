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
  
  include('../include/sql_report1.php'); 
  
  $row_yokyod = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center WHERE cash_date = '$yesterday' ORDER BY cash_id DESC LIMIT 1"));
  
  $result_po = mysql_query("SELECT e.e_name, p.po_buyer, p.po_subyer, p.po_name, p.po_price FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer WHERE p.po_date = '$dates'");
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
				<div class="box" style="/*background-color:green;*/">.</div>
			</div>
			
			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="5" align="center">รายการสั่งซื้อ</td>
						</tr>
						<tr>
							<td>#</td>
							<td>รายการ</td>
							<td>ราคา</td>
							<td>คนซื้อ</td>
							<td>บัญชี</td>
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
							</tr>
						<?php } ?>
						
					</table><br><br>
					
					
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="4" align="center">ลูกค้าโอน</td>
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

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	<div class="page">
        <div class="subpage">
			<table style="width:100%; border: 1px solid black;">
				<tr>
					<td colspan="4" align="center">เงินเดือน</td>
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
						
			</table>
		</div>	
    </div> <!--end page-->
</div>
</body>
</html>