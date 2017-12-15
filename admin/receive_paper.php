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
	$e_id = $_SESSION[ss_emp_id];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../../sys/pages/login/login.php';</script>");}
	
	$cust_id = trim($_POST['search_custname']);
	$vatlist = trim($_POST['vatlist']);
	$vattype = trim($_POST['vattype']);
	$vatprice = trim($_POST['vatprice']);
	$vatdate = trim($_POST['vatdate']);
	
	if($vattype==1){ 
		$price = $vatprice * 1.07;
	} else { 
		$price = $vatprice;
	}
	
	$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM (tb_customer c JOIN province p ON c.cust_province = p.id) JOIN amphur a ON a.provinceID = c.cust_province WHERE cust_id = '$cust_id'"));
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

            <div id="cover_header" style="font-weight: bold; font-size: 1em;">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:120%; margin-left:40px; margin-top:-10px;">				
					<p>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง (สำนักงานใหญ่)<br> 
					28/1 หมู่6 อ.เมือง จ.นครปฐม 73000<br> 
					082-360-1523<br> 
					เลขประจำตัวผู้เสียภาษี  0733537000077</p>
				</div>
			</div><!--end cover_header-->
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				ใบเสร็จรับเงิน
			</div>
			
			<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;" >
					<p style="padding-left: 20px;">ชื่อลูกค้า : <?php echo $row_cust['cust_name']?><br> 
					ที่อยู่ : <?php echo $row_cust['cust_address']?><br> 
					โทรศัพท์ : <?php echo $row_cust['cust_tel']?><br> </p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">เลขที่เอกสาร<br> 
					วันที่<br>  
					
					ชนิดการขาย : <br>
					ชนิดภาษี : <br> 
					อัตราภาษี : <br> </p>
				</div>
			</div>
			
			
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table>
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;">จำนวน</td>
						<td style="width:12%;">หน่วยนับ</td>
						<td style="width:12%;">ราคา</td>
						<td style="width:12%;">ส่วนลด</td>
						<td style="width:12%;">รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="7"> <hr> </td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>ห้องเย็นเก็บสินค้า อุรหภูมิ +5 องศา ขนาดวัดภายนอก 2.70 ,x2.90 x2</td>
						<td>3</td>
						<td>ddd</td>
						<td><?php echo number_format($vatprice, 0, '.', ',');?></td>
						<td>600,000</td>
						<td><?php echo number_format($price, 0, '.', ',');?></td>
					</tr>
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p>หนึ่งล้านห้าแสนบาท ห้าสิบสตางค์</p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* กสิกรไทย ชูเกียรติ เทียนอำไพ ออมทรัพย์ สาขา เทสโก้โลตัส 855-2-05499-8<br>
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right">00000 </td>
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
							<td align="right"> 0000000</td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right"> 1111111</td>
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
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	</form>
	
</div>
</body>
</html>