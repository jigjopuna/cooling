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
	
	$ord_id = trim($_POST['search_custname']);
	
	$corp = trim($_POST['copetype']);
	$ord_type = trim($_POST['ord_type']);
	
	$sql_chkvat = "SELECT vat_ord FROM tb_tax WHERE vat_ord_type = 1 AND vat_ord_no = '$ord_id'";
	$result_chkvat = mysql_query($sql_chkvat);
	$num_chkvat = mysql_num_rows($result_chkvat);
	$chkvat = mysql_fetch_array($result_chkvat);
	$row_vat = $chkvat['vat_ord'];
	
	
	
	
		/*echo $ord_id .' | '. $num_chkvat .' | '.$row_vat.'<br>';
		echo 'ord_type = '.$ord_type;
		exit();
		*/
	
	
	$vatdate = trim($_POST['vatdate']);
	$corp_addr  = trim($_POST['corp_addr']);
	$bil_typ = trim($_POST['bil_typ']); 
	if($bil_typ == 1){ 
		$hbill   = 'ใบแจ้งหนี้ / ใบวางบิล';
		$hbiltyp = 'เลขที่ใบแจ้งหนี้ /  No. : ';
	} else { 
		$hbill   = 'ใบเสร็จรับเงิน/ใบกำกับภาษี' ;
		$hbiltyp = 'เลขที่ใบกำกับ /  No. : ';
	}
	/*echo 'e_id : '.$e_id.'<br>';
	echo 'ord_id : '.$ord_id.'<br>';*/

	$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) JOIN tumbon t ON c.cust_tumbon = t.id) JOIN amphur a ON c.cust_amphur = a.id) JOIN province p ON c.cust_province = p.id WHERE o.o_id = '$ord_id'"));
	
	
	
	
	if($ord_type == 2){
		$row_order = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders o JOIN tb_tools t ON o.o_part_id = t.t_id WHERE o.o_id = '$ord_id'"));
		$detail = $row_order['t_name'];
	}else{
		$row_order = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders o JOIN tb_service s ON s.fix_ord = o.o_id WHERE o.o_id = '$ord_id'"));
		$detail = $row_order['fix_broken'];
	}
	
	$price = $row_order['o_price'];
	$qty = $row_order['o_qty'];
	
	$beforder_vat = $price/1.07;
	$vats = $beforder_vat * 0.07;
	$amount = $beforder_vat+$vats;
	

	$approv = mysql_fetch_array(mysql_query("SELECT * FROM tb_emp e WHERE e_id = '$e_id'"));
	$approv_name = $approv['e_name'];
	$approv_lname = $approv['e_lname'];
	$approv_sign = $approv['e_sign'];
	$appv_name = $approv_name. ' ' .$approv_lname;
	

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
				<?php echo $hbill;?>
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
						<td><?php echo $detail; ?></td>
						<td align='right'><?php echo $qty;?></td>
						<td align='center'>ตัว</td>
						<td align='center'><?php echo number_format($beforder_vat/$qty, 2, '.', ',');?></td>
						<td align='center'><?php echo number_format($beforder_vat, 2, '.', ',');?></td>  
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
						* ธ.กสิกรไทย  บจก.ซีพีเอ็น888 เลขที่บัญชี 075-8-81892-6 (ออมทรัพย์)  <!-- ธ.กสิกรไทย  เดชาธร ผลินธร เลขที่บัญชี 855-2-01920-3 (ออมทรัพย์) -->
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right"><?php echo number_format($beforder_vat, 2, '.', ',');?></td> 
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
							<td align="right"><?php echo number_format($vats, 2, '.', ','); ?></td>
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
	</form>
	
</div>
</body>
</html>