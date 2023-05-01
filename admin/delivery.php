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
	<title>ใบรับสินค้า มือสอง</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<link type="text/css" rel="stylesheet" href="../css/billsignature.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
</head>
<body>
<?php 
	/*require_once('../include/googletag.php');*/
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../../sys/pages/login/login.php';</script>");}
	$corp = 1;
	$ord_id = $_GET['o_id'];
	
	$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) JOIN tumbon t ON c.cust_tumbon = t.id) JOIN amphur a ON c.cust_amphur = a.id) JOIN province p ON c.cust_province = p.id WHERE o.o_id = '$ord_id'"));
	
		$row_order = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders WHERE o_id = '$ord_id'"));
	$vatprice = $row_order['o_price'];
	
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
					if($corp == 1){
						include ('../include/cpn_addr.php'); 
					}else if ($corp == 2) {
						include ('../include/chk_addr.php');
					}
				?>
			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				<?php //echo $bill_head;?>
				ใบส่งสินค้า
			</div>
			<?php include('../include/billdetail.php'); ?>

			<div id="detail" style="/*background-color: olive;*/ height:500px; float: none; margin-top: 15px;">
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
						<td>เครื่อง Condensing Unit BITZER 20HP มือสอง</td>
						<td align='right'> 1 </td>
						<td align='center'>ชุด </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td></td>
						<td> คอยล์เย็น มือสอง พร้อมใช้งาน</td>
						<td align='right'>  </td>
						<td align='center'> </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					
					<tr>
						<td></td>
						<td> ตู้คอนโทรลมือสอง พร้อมใช้งาน </td>
						<td align='right'>  </td>
						<td align='center'> </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					

				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 80px;*/">
				
				
				
				<div id="signature" style="margin-top:50px;">
					<div class="sign">ผู้ส่งสินค้า ...........................</div>
					<div class="sign">ผู้ตรวจสอบ ...........................</div>
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