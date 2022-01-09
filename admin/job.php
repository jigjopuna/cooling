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
	<title>ใบดำเนินงาน</title>
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
	
	$ord_id = trim($_GET['ordid']);
	
	$vatdate = trim($_POST['vatdate']);
	/*echo 'e_id : '.$e_id.'<br>';
	echo 'ord_id : '.$ord_id.'<br>';*/

	
	$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) JOIN tumbon t ON c.cust_tumbon = t.id) JOIN amphur a ON c.cust_amphur = a.id) JOIN province p ON c.cust_province = p.id WHERE o.o_id = '$ord_id'"));
	$row_order = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders WHERE o_id = '$ord_id'"));
	$vatprice = $row_order['o_price'];
	
	/*echo 'vat_order : '.$row_order['o_vat'].'<br>';*/
	
	if($row_order['o_vat']==1){
		$row_ordno = mysql_fetch_array(mysql_query("SELECT vat_id FROM tb_tax WHERE vat_ord='$ord_id'"));
		$cust_ordno = $row_ordno['vat_id'];
		
		$price = $vatprice * 1.07;
	}else{
		$price = $vatprice;
	}

?>

<script>

	$(document).ready(function(){
		$('#findcost').click(function(){
			 $('#form1').attr('action', 'cost.php');
			 $('#form1').submit();
		});
		
		$("#search_custname").autocomplete({
				source: "../ajax/search_cust.php",
				minLength: 1
		});
		
	});
	

</script>

<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
				<?php 
					
					include ('../include/cpn_addr.php'); 
					
				?>
			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				<?php //echo $bill_head;?>
				ใบดำเนินงาน
			</div>
			<?php include('../include/billdetail.php'); ?>

			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table>
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ/รายละเอียด</td>
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
						<td>ห้องเย็นเก็บสินค้า อุณหภูมิ <?php echo $row_order['o_temp']?> องศา ขนาดวัดภายนอก <?php echo $row_order['o_size']?> เมตร</td>
						<td align='right'>1</td>
						<td align='center'>ห้อง</td>
						<td align='center'><?php echo number_format($vatprice, 0, '.', ',');?></td>
						<td align='center'><?php echo number_format($vatprice, 0, '.', ',');?></td>  
					</tr>
					
					<tr>
						<td>2</td>
						<td colspan='5'>คอมเพรสเซอร์ แรงดัน  <?php if($row_order['o_voltage']==380){ echo ' 380 โวลท์ (ไฟฟ้า 3 เฟส)';} else if($row_order['o_voltage']==220){ echo ' 220 โวลท์';} ?></td>
					</tr>
					
					<tr>
						<td>2</td>
						<td colspan='5'>ตำแหน่งประตู : ด้านหน้า</td>
					</tr>
					
					<tr>
						<td>3</td>
						<td colspan='5'>ตำแหน่งตู้คอนโทรล/ควบคุม : ด้านหน้า</td>
					</tr>
					
					<tr>
						<td>4</td>
						<td colspan='5'>
							<strong>คอล์ยร้อน : &nbsp;&nbsp;&nbsp; </strong> <?php 
							if($row_order['o_coil']==1){ 
								echo ' ด้านหน้า'; 
							}else if($row_order['o_coil']==2){ 
								echo ' ด้านข้างซ้าย'; 
							}else if($row_order['o_coil']==3){ 
								echo ' ด้านข้างขวา';
							}else if($row_order['o_coil']==4){ 
								echo ' ด้านหลัง';
							}else if($row_order['o_coil']==5){ 
								echo ' ด้านบน';
							} else { echo '555'; }
							?>
						</td>
					</tr>
					
					<tr>
						<td>5</td>
						<td colspan='5'>สีเหล็กโครงสร้าง : สีฟ้ามาตราฐาน</td>
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
						* หากยืนยันข้อมูลการดำเนินการข้างต้นแล้ว หากมีการเปลี่ยนแปลงจะมีค่าใช้เพิ่มเติม<br>
					</p>
				
				</div>
				

				
				<div id="signature">
					<div class="sign">ผู้รับมอบงาน ...........................</div>
					<div class="sign">ผู้ส่งงาน ...........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;ภูริชญ์ โชคอุตสาหะ&nbsp;&nbsp;)</div>
					
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	
	
	
	</form>
	
</div>
</body>
</html>