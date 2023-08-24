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
	<title>อะไหล่ใบเสร็จรับเงิน</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
	<link type="text/css" rel="stylesheet" href="../css/billsignature.css">
</head>
<body>
<?php 
	/*require_once('../include/googletag.php');*/
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../../sys/pages/login/login.php';</script>");}

	$mont = date("m");
	$year = date("Y");
	$dates =  $year.'-'.$mont.'%';
	
	$yyy = $year+543;
	$yy = substr($yyy, -2);
	$runno =  $yy.$mont;
	
	$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) JOIN tumbon t ON c.cust_tumbon = t.id) JOIN amphur a ON c.cust_amphur = a.id) JOIN province p ON c.cust_province = p.id WHERE o.o_id = '$ord_id'"));
	$row_order = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders WHERE o_id = '$ord_id'"));
	$vatprice = $row_order['o_price'];
	
	$sql = "SELECT c.cust_name, o.o_id, op.pay_amount, op.pay_date, o.o_type, o.o_price, o.o_qty
					FROM ((tb_ord_pay op JOIN tb_orders o ON op.o_id = o.o_id)
						  JOIN tb_customer c ON c.cust_id = o.o_cust)
						  JOIN tb_bank b ON b.bk_id = op.pay_bank
					WHERE op.pay_date LIKE '$dates' AND b.bk_cop = 'CPN'
					ORDER BY op.pay_date ";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$bill_head = 'ใบเสร็จรับเงิน/ใบกำกับภาษี';
?>

<script>

	$(document).ready(function(){
		$("#corp_addr_ini").clone().appendTo(".cover_header");
		
	});

</script>

<div class="book">
<form method="post" action="pfq.php"id="form1">

	<?php for($i=1; $i<$num; $i++) { //page  
		$row = mysql_fetch_array($result);

		$ord_id = $row['o_id'];
		$ord_type = $row['o_type'];
		$o_price = $row['o_price'];
		$pay_amount = $row['pay_amount'];
		
		$o_qty = $row['o_qty'];
		$o_date = $row['pay_date'];
		
		if($i<10){ $subfix = '0'.$i; } else{ $subfix = $i; }
		
		$befovat = $pay_amount/1.07;
		$vat = $befovat*0.07;
		$amount = $befovat+$vat;

		$otype = mb_substr($ord_type, 0, 1);	
		$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) JOIN tumbon t ON c.cust_tumbon = t.id) JOIN amphur a ON c.cust_amphur = a.id) JOIN province p ON c.cust_province = p.id WHERE o.o_id = '$ord_id'"));	
		$row_detail = mysql_fetch_array(mysql_query("SELECT * FROM tb_order o JOIN tb_tools t ON o.o_part_id = t.t_id WHERE o.o_id = '$ord_id' "));
		

		/*  แต่ละอันจะขึ้นข้อความเไม่เหมือนกัน
			1. ออเดอร์ห้องเย็น
			2. ออเดอร์อะไหล่
			3. ออเดอร์เช่าห้องเย็น
			4. ออเดอร์ เซอร์วิส
			5. ออเดอร์รับฝากสินค้า
			
			การเลือกลูกค้า ต้อง Query ที่ละออเดอร์ว่าแต่ละออเดอร์เป็นออเดอร์ประเภทไหน
			
			ถ้ามีหัก ณ ที่จ่าย ให้กรอกตามใบแจ้งหนี้
			- ถ้าเป็นห้องเย็นให้เอาขนาดห้องเย็นมาแสดง อุณหภูมิ ใน tb_orders มาแสดงกับ งวดที่จ่ายเงิน ใน tb_ord_pay (ยึดตามวันที่ ord_pay เป็นหลัก เท่ากับ ยึดวันที่จ่ายเงิน)
			- ถ้าเป็นอะไหล่ ให้ JOIN tb_tools ดึงชื่ออะไหล่ขึ้นมา
			- ถ้าเป็นห้องให้เช่า Service และรับฝากสินค้า ให้ดึงราคา tb_ord_pay มาเลย (ให้กรอกยอดตามใบแจ้งหนี้)
		*/
		
		if($otype == 1){ //ห้องเย็น
			
		}else if($otype == 3){ //Service
			$row1 = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders o JOIN tb_service s ON o.o_id = s.fix_ord WHERE o.o_id = '$ord_id'"));
			$detail = $row1['fix_detail'];
			$o_qty = 1;
			$unit = 'งาน';
			
		}else if($otype == 4){ //อะไหล่
		
			$row1 = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders o JOIN tb_tools t ON o.o_part_id = t.t_id WHERE o.o_id = '$ord_id' "));
			$detail = $row1['t_name'].' '.$row1['t_model'];
			$unit = 'ตัว';
			
		}else if($otype == 5){ //รับฝากสินค้า
			
		}else if($otype == 7){ //ให้เช่าห้องเย็น
			$row1 = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders WHERE o_id = '$ord_id'"));
			$detail = 'ค่าบริการเช่าห้องเย็น ';
			$unit = 'ห้อง';		
			$o_qty = 1;
			
		}
	?>
		<div class="page">
			<div class="subpage">
				<div id="corp_addr_ini">
					<?php 
						include ('../include/cpn_addr.php'); 
					?>
				</div><!--end cover_header-->

				<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
					<?php //echo $bill_head;?>
					ใบเสร็จรับเงิน/ใบกำกับภาษี
				</div>
							<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;" >
					<p style="padding-left: 20px;">รหัสลูกค้า / Code : C<?php echo $ord_id;?><br>
					นามลูกค้า / Name : <?php echo $row_cust['cust_name']; ?><br> 
					ที่อยู่ / Address: 
					<?php 
						echo $row_cust['cust_address'].' '; 
						if($row_cust['cust_province']==102){
							echo 'แขวง'. $row_cust['tum_name'].' '.$row_cust['amp_name'].' '.$row_cust['pro_name'];
						}else{
							echo 'ตำบล'. $row_cust['tum_name'].' อำเภอ'.$row_cust['amp_name'].' จังหวัด'.$row_cust['pro_name'];
						}
						echo ' '.$row_cust['cust_zip'];					
					?>
					<br> 
					โทรศัพท์ / Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $row_cust['cust_tel']?><br>
					เลขที่ประจำตัวผู้เสียภาษี / Tax ID : <?php echo $row_cust['cust_tax']?></p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $o_date;?><br>  					
					
					เลขที่ใบกำกับภาษี /  No. : C<?php echo $runno.$subfix;?><br>
					ชนิดการขาย :  เงินสด  </p>
				</div>
			</div>

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
							<td><?php echo $detail; ?></td>
							<td align='right'><?php echo $o_qty;?></td>
							<td align='center'><?php echo $unit;?></td>
							<td align='center'><?php echo number_format($befovat/$o_qty, 2, '.', ',');?></td>
							<td align='center'><?php echo number_format($befovat, 2, '.', ',');?></td>  
						</tr>
					</table>
				</div>
				
				<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
					หมายเหตุ  
				</div>
				
				<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
					<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
				
						<p><?=ThaiBahtConversion($amount); ?></p><br>
						<p style="line-height:150%;">
							* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
							* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
							* ธ.กสิกรไทย  บจก.ซีพีเอ็น888 เลขที่บัญชี 075-8-81892-6 (ออมทรัพย์)  <!-- ธ.กสิกรไทย  เดชาธร ผลินธร เลขที่บัญชี 855-2-01920-3 (ออมทรัพย์) -->
						</p>
					
					</div>
					
					<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
						<table style="width: 98%;">
							<tr>
								<td style="width:60%;">มูลค่าสินค้า </td>
								<td align="right"><?php echo number_format($befovat, 2, '.', ',');?></td> 
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
								<td>ภาษีมูลค่าเพิ่ม 7% </td>
								<td align="right"><?php echo number_format($vat, 2, '.', ','); ?></td>
							</tr>
							<tr>
								<td>รวมทั้งสิ้น </td>
								<td align="right"><?php echo number_format($amount, 2, '.', ',');?></td>
							</tr>
						</table>
					
					
					
					</div>
					
					<?php include('../include/signature.php'); ?>
				</div>
				

			</div>  <!--end subpage-->
		</div> <!--end page-->
		
	<?php } ?>
	</form>
	
</div>
</body>
</html>