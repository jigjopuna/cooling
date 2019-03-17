<?php session_start();
	  require_once('../include/connect.php');
      require_once('../include/thaibaht.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="ราคาห้อง และโฟม" />
	<meta name="description" content="ราคาห้อง และโฟม" />
	<?php require_once('../sys/include/metatagsys.php');?>
	<title>ใบเสร็จรับเงิน</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
	<style>
		#signature { width: 100%; /*background-color:red;*/ float:none; overflow:hidden; margin-top: 200px; height:35px;}
		.sign { float: left; width: 33%; }
		.sign1 { float: right; width: 33%; }
	</style>
</head>
<body>
<?php 
	require_once('../include/googletag.php');
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../../sys/pages/login/login.php';</script>");}
	
	$ord_id = trim($_POST['search_custname']);
	
	$sql_chkvat = "SELECT vat_ord FROM tb_tax WHERE vat_ord_type = 1 AND vat_ord_no = '$ord_id'";
	$result_chkvat = mysql_query($sql_chkvat);
	$num_chkvat = mysql_num_rows($result_chkvat);
	$chkvat = mysql_fetch_array($result_chkvat);
	$row_vat = $chkvat['vat_ord'];
	
	//echo $ord_id .' | '. $num_chkvat .' | '.$row_vat;
	
	$vatdate = trim($_POST['vatdate']);
	$corp_addr  = trim($_POST['corp_addr']);
	/*echo 'e_id : '.$e_id.'<br>';
	echo 'ord_id : '.$ord_id.'<br>';*/

	
	$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) JOIN tumbon t ON c.cust_tumbon = t.id) JOIN amphur a ON c.cust_amphur = a.id) JOIN province p ON c.cust_province = p.id WHERE o.o_id = '$ord_id'"));
	$row_order = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders WHERE o_id = '$ord_id'"));
	$vatprice = $row_order['o_price'];
	
	/*
		เงื่อนไข
		จะคิด VAT เฉพาะมือหนึ่ง ใช้เงื่อนไข o_newold = 1 คือเท่ากับของใหม่ 
	*/
	
	if($row_order['o_vat']==1){
		$row_ordno = mysql_fetch_array(mysql_query("SELECT vat_id FROM tb_tax WHERE vat_ord='$ord_id'"));
		$cust_ordno = $row_ordno['vat_id'];
		
		$price = $vatprice * 1.07;
		$bill_head = 'ใบเสร็จรับเงิน/ใบกำกับภาษี';
	}else{
		$price = $vatprice;
		$bill_head = 'ใบเสร็จรับเงิน';
	}
	
	//ลูกค้าจ่ายกี่ครั้งแล้ว และครั้งละเท่าไร
	$arrpay = array();
	$sql_pay = "SELECT opay.pay_amount FROM tb_orders o JOIN tb_ord_pay opay ON o.o_id = opay.o_id WHERE opay.o_id = '$ord_id' ORDER BY opay.pay_id";
	$result_pay = mysql_query($sql_pay);
	$num_pay = mysql_num_rows($result_pay);
	
	for($i=1; $i<=$num_pay; $i++){
		$row_pay = mysql_fetch_array($result_pay);
		$arrpay[$i] = $row_pay['pay_amount']; 
	}
	
	
	/*echo '1 :'.$arrpay[1].'<br>';
	echo '2 :'.$arrpay[2].'<br>';
	echo '3 :'.$arrpay[3].'<br><br>';
	
	echo 'ราคาเต็ม :'.$vatprice.'<br>';*/
	
	
	
	
	/*เช็คก่อนว่าครั้งแรกจ่ายเกิน 50% หรือเปล่าถ้าใช่ให้คิดงวดที่ 2 กับที่งวดที่ 3 หักจากงวดที่1 
	ถ้าไม่ใช่่ก็คิดตามเปอร์เซ็น
	*/
	if($arrpay[1] > $vatprice*0.5){
		$remain = $vatprice - $arrpay[1];
		$ngod2 = $remain*0.6;
		$ngod3 = $remain*0.4;
		//echo 'จ่ายเกิน 50%'.'<br>';
	}else if($arrpay[1] < $vatprice*0.5){
		$remain = $vatprice - $arrpay[1];
		$ngod2 = $remain*0.6;
		$ngod3 = $remain*0.4;
		//echo 'จ่ายน้อยกว่า 50% '.'<br>';
	}else{
		$ngod2 = $vatprice*0.3;
		$ngod3 = $vatprice*0.2;
		//echo 'จ่าย 50% พอดี'.'<br>';
	}
	/*echo 'งวด1 :'.$arrpay[1].'<br>';
	echo 'งวด2 :'.$ngod2.'<br>';
	echo 'งวด3 :'.$ngod3.'<br><br>';
	
	echo 'ที่เหลือหลังจากงวดแรก :'.$remain.'<br>';*/
	
?>

<script>

	$(document).ready(function(){
		$("#corp_addr_ini").clone().appendTo(".cover_header");
		
	});
	

</script>

<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
				<?php 
					if($corp_addr == 1){
						require_once('../include/tcl_addr.php');
					}else{
						require_once('../include/ptwall_addr.php');
					}					
				?>
			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				<?php //echo $bill_head;?>
				ใบเสร็จรับเงิน/ใบกำกับภาษี
			</div>
			<?php include('../include/billdetail.php'); ?>

			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width: 100%;">
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align='center'>จำนวน</td>
						<td style="width:12%;" align='center'>หน่วยนับ</td>
						<td style="width:12%;" align='center'>ราคา</td>
						<td style="width:12%;" align='center'>รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>ห้องเย็นเก็บสินค้า อุณหภูมิ <?php echo $row_order['o_temp']?> องศา ขนาดวัดภายนอก <?php echo $row_order['o_width'].' x '.$row_order['o_size'].' x '.$row_order['o_high'];?> เมตร</td>
						<td align='right'>1</td>
						<td align='center'>ห้อง</td>
						<td align='center'><?php echo number_format($vatprice, 0, '.', ',');?></td>
						<td align='center'><?php echo number_format($vatprice, 0, '.', ',');?></td>  
					</tr>
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p><?=ThaiBahtConversion($price-$discount); ?></p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						*  กสิกรไทย  ท็อปคูลลิ่ง  เลขที่บัญชี 047-8-18623-1 (กระแสรายวัน)<?php 
							/*if($corp_addr == 1){
								echo 'กสิกรไทย ชูเกียรติ เทียนอำไพ ออมทรัพย์ สาขา เทสโก้โลตัส 855-2-05499-8'; 
							}else{
								echo 'กสิกรไทย นายไพฑูรย์ เกตุแก้ว สาขาถนนเอกชัย ออมทรัพย์ 055-2-67946-8 ';
							}*/
						?><br>
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right"><?php echo number_format($vatprice, 2, '.', ',');?></td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td>ภาษีมูลค่าเพิ่ม </td>
							<td align="right"><?php if($vattype==1)  echo number_format($vatprice*0.07, 2, '.', ','); else echo 0;?></td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right"><?php echo number_format($price, 2, '.', ',');?></td>
						</tr>
					</table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;<?php if($corp_addr == 1){ echo 'นายชูเกียรติ  เทียนอำไพ'; }else{ echo 'ไพฑูรย์ เกตุแก้ว';}	?>&nbsp;&nbsp;)</div>		
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	<div class="page">
        <div class="subpage">

            <div class="cover_header">
				
			</div><!--end cover_header-->
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				ใบแจ้งหนี้/ใบวางบิล
			</div>
			
			<?php include('../include/billdetail.php'); ?>
			
			
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table>
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align='center'>จำนวน</td>
						<td style="width:12%;" align='center'>หน่วยนับ</td>
						<td style="width:12%;" align='center'>ราคา</td>
						<td style="width:12%;" align='center'>รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>ห้องเย็นเก็บสินค้า อุณหภูมิ <?php echo $row_order['o_temp']?> องศา ขนาดวัดภายนอก <?php echo $row_order['o_width'].' x '.$row_order['o_size'].' x '.$row_order['o_high'];?> เมตร (งวดที่ 2)</td>
						<td align='right'>1</td>
						<td align='center'>ห้อง</td>
						<td align='center'><?php echo number_format($ngod2, 0, '.', ',');?></td>
						<td align='center'><?php echo number_format($ngod2, 0, '.', ',');?></td>  
					</tr>
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  <?php echo ' จากยอดเต็ม : '.number_format($vatprice, 0, '.', ',').' บาท'?>
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p><?=ThaiBahtConversion($ngod2); ?></p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* กสิกรไทย  ท็อปคูลลิ่ง  เลขที่บัญชี 047-8-18623-1 (กระแสรายวัน)<br>
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right"><?php echo number_format($ngod2, 2, '.', ',');?></td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td>ภาษีมูลค่าเพิ่ม </td>
							<td align="right"><?php if($vattype==1)  echo number_format($vatprice*0.07, 2, '.', ','); else echo 0;?></td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right"><?php echo number_format($ngod2, 2, '.', ',');?></td>
						</tr>
					</table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;<?php if($corp_addr == 1){ echo 'นายชูเกียรติ  เทียนอำไพ'; }else{ echo 'ไพฑูรย์ เกตุแก้ว';}	?>&nbsp;&nbsp;)</div>
					
					
					
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	<div class="page">
        <div class="subpage">
			<div class="cover_header">
				
			</div><!--end cover_header-->
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				ใบแจ้งหนี้/ใบวางบิล
			</div>
			
			<?php include('../include/billdetail.php'); ?>
			
			
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table>
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align='center'>จำนวน</td>
						<td style="width:12%;" align='center'>หน่วยนับ</td>
						<td style="width:12%;" align='center'>ราคา</td>
						<td style="width:12%;" align='center'>รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>ห้องเย็นเก็บสินค้า อุณหภูมิ <?php echo $row_order['o_temp']?> องศา ขนาดวัดภายนอก <?php echo $row_order['o_width'].' x '.$row_order['o_size'].' x '.$row_order['o_high'];?> เมตร (งวดที่ 3)</td>
						<td align='right'>1</td>
						<td align='center'>ห้อง</td>
						<td align='center'><?php echo number_format($ngod3, 0, '.', ',');?></td>
						<td align='center'><?php echo number_format($ngod3, 0, '.', ',');?></td>  
					</tr>
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  <?php echo ' จากยอดเต็ม : '.number_format($vatprice, 0, '.', ',').' บาท'?>
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p><?=ThaiBahtConversion($ngod3); ?></p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* กสิกรไทย  ท็อปคูลลิ่ง  เลขที่บัญชี 047-8-18623-1 (กระแสรายวัน)
						<br>
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right"><?php echo number_format($ngod3, 2, '.', ',');?></td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td>ภาษีมูลค่าเพิ่ม </td>
							<td align="right"><?php if($vattype==1)  echo number_format($vatprice*0.07, 2, '.', ','); else echo 0;?></td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right"><?php echo number_format($ngod3, 2, '.', ',');?></td>
						</tr>
					</table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;<?php if($corp_addr == 1){ echo 'นายชูเกียรติ  เทียนอำไพ'; }else{ echo 'ไพฑูรย์ เกตุแก้ว';}	?>&nbsp;&nbsp;)</div>
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	</form>
	
</div>
</body>
</html>