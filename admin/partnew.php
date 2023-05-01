<?php 
	require_once('../include/connect.php');
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	$thatdate = $date."/".$nMonth."/".$year;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />
	<link rel="shortcut icon" href="content/images/favicon.png">
	<title><?php echo date("Y").'-'.$nMonth.'-'.$date; ?></title>
	<link rel="stylesheet" href="../css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style>
		.text_strong { font-weight: bold; }
		.text_emunder { text-decoration:underline; font-weight: bold; }
		.container { clear:both; border: 1px solid black; min-height:850px;}
		.row { width: 100%; clear:both; padding-bottom: 60px; overflow: hidden;}
		.col1 { float:left; width:45%; margin:0.5% 0.5% 0.5% 10px; /*background:red;*/ }
		.col2 { float:left; width:51%; margin:0.5% 0.5% 0 10px; /*background:blue;*/ }
		.col3 { float:left; width:53%; margin:0.5% 0.5% 0.5% 10px; /*background:red;*/ }
		.col4 { float:left; width:43%; margin:0.5% 0.5% 0 10px; /*background:blue;*/ }
		.topic { font-family: 'Kanit', sans-serif; font-size:18px; font-weight:bold; text-decoration:underline;}
		.intopic { font-family: 'Kanit', sans-serif; font-weight:bold; }
		
		@media print { 
			 #btn-calngod,  #btn-addroom { display: none !important; } 
		}

	</style>
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<script>
	$(document).ready(function(){
		$("#btn-calngod").click(calucalatengod);
	});
	function calucalatengod(){
		var installs = $('#installs').text();
		if(installs == 0) {
			var allprice = $('#totolprice').text().replace(/,/g, '');
			var firsts = (allprice*0.7).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			var seconds = (allprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			$('.cal_ngo1').text(firsts);
			$('.cal_ngo2').text(seconds);
		}else{
			var allprice = $('#totolprice').text().replace(/,/g, '');
			var firsts = (allprice*0.5).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			var seconds = (allprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			var third = (allprice*0.2).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			$('.cal_ngo1').text(firsts);
			$('.cal_ngo2').text(seconds);
			$('.cal_ngo3').text(third);
			
		}
	}
	

</script>
<?php 
	$tool = trim($_POST['search_tool']);
	$qty = trim($_POST['qty']);
	
	$sale_id = trim($_POST['sale_id']);
	$date = trim($_POST['date']); 
	$corp = trim($_POST['bank_acc']);
	$shipcost = trim($_POST['shipcost']);
	
	$cust_id = trim($_POST['search_custname']);

	
	$chkdetail = mysql_fetch_array(mysql_query("SELECT qcust_prov FROM tb_quo_cust WHERE qcust_id = '$cust_id'"));
	$rowchkdetail = $chkdetail['qcust_prov'];
	
	//ถ้าลูกค้าให้ข้อมูลมาแค่ชื่อกับเบอร์โทร ไม่ต้อง Join กับตารางจังหวัด เพราะข้อมูลจะไม่ขึ้น
	if($rowchkdetail < 90){
		$row = mysql_fetch_array(mysql_query("SELECT qcust_name, qcust_tel FROM tb_quo_cust WHERE qcust_id = '$cust_id'"));
	}else{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM ((tb_quo_cust q JOIN tumbon t ON t.id = q.qcust_tumbon) JOIN amphur a ON q.qcuat_amphur = a.id) JOIN province p ON q.qcust_prov = p.id WHERE qcust_id = '$cust_id'"));
		
	}
	$cust_name = $row['qcust_name'];
	$cust_province = $row['qcust_prov'];
	
	
	
	/*echo 'custname : '.$custname.'<br>';
	echo 'tool : '.$tool.'<br>';
	echo 'qty : '.$qty.'<br>';
	echo 'sale_id : '.$sale_id.'<br>';
	
	echo 'date : '.$date.'<br>';
	echo 'corp : '.$bank_acc.'<br>';*/
	
	$row_tool = mysql_fetch_array(mysql_query("SELECT * FROM tb_tools WHERE t_id = '$tool'"));
	
	$sales = mysql_fetch_array(mysql_query("SELECT e.e_id, e.e_name, e.e_lname, e.e_tel, e.e_email FROM tb_emp e WHERE e_id = '$sale_id'"));
	$sale_name = $sales['e_name'];
	$sale_lname = $sales['e_lname'];
	$sale_tel = $sales['e_tel'];
	$sale_email = $sales['e_email'];
	
	
	$cost = $row_tool['t_price_sell'];
	$prices = $cost*$qty;
	$sumprice = $prices+$shipcost;
	$vat = $sumprice*0.07;
	$amount = $sumprice+$vat;
	
	
	
	
	
?>

</head>
<body>
<div class="book">
	<div class="page">
        <div class="subpage">

            <div id="cover_header">
				<?php include ('../include/cpn_addr.php'); ?>
			</div><!--end cover_header-->
			
			
			<?php include ('../include/quotation_head_cpn.php');?>
			
			<div style="width:100%; float:none; overflow:hidden;"></div>
			<div id="product_price" style="margin-top:10px; clear:both; ">
			
					<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tbody>
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดรายการอุปกรณ์</td>
					</tr>
					
					
					
					
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l" style="width: 60%">Description </td>
						<td colspan="2" class="l" style="width: 10%">QTY</td>
						<td class="l" style="width: 15%">Unit Price</td>
						<td class="l" style="width: 15%">Amount</td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l"> </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
			
					
				
					
					<tr class="highs" style="">
						<td class="l">1. <?php echo $row_tool['t_name'].' '.$row_tool['t_model'] ?></td>
						<td colspan="2" class="l" align="center"> <?php echo $qty;?> </td>  
						<td class="l" align="right"><?php echo number_format($cost, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($prices, 2, '.', ',');?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">2. ค่าบริการขนส่ง</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right">220.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l"> </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td rowspan="3">
							<div style="width:100%" ;="">
								<div style="width:30%; float:left;">
									<img style="width:100px; height:100px;" src="../content/images/social/frame2.png">
								</div>
								<div style="width:70%; float:left; height:100px;">
									<p align="left;" style="margin-top:35px;"> ข้อมูลเพิ่มเติม SCAN ME </p>
								</div>
							</div>
						</td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php number_format($sumprice, 2, '.', ',');  ?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ภาษีมูลค่าเพิ่ม 7%</td>
						<td class="rt l" align="right"><?php number_format($vat, 2, '.', ',');  ?> </td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" id="totolprice">56,496.00 </td>
					</tr>
				
				</tbody></table>
			</div><!--end product_price-->
			
			
			
			<div id="amount" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left"><span style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน </span></td>
						</tr>
						
					
						
					<?php
						if($corp == 1) { 
							
					?>
						<tr>
							<td colspan="2" align="left">บัญชีธนาคาร กสิกรไทย </td>
							<tr>
								<td colspan="2" align="left">  บจ.ซีพีเอ็น888  เลขที่บัญชี  <span style="text-decoration: underline; font-weight: bold;"> 075-8-81892-6</span></td>
							</tr>
						</tr>
						
						
					<?php } else { ?>
						<tr>
							<td colspan="2" align="left">บัญชีธนาคารกรุงเทพ</td>
							<tr>
								<td colspan="2" align="left"> นายเดชาธร ผลินธร <span style="text-decoration: underline; font-weight: bold;"> 075-8-81892-6</span></td>
							</tr>
						</tr>
						
						
					<?php }  ?>
					
					</table>
					
				</div><br>
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> กำหนดยืนราคา</td>
						</tr>
						<tr>
							<td align="left">  ภายใน 20 วัน นับจากวันที่เสนอราคา</td>
						</tr>
						<tr>
							<td align="left">  ส่งสินค้า ภายใน 7-10 วันหลังจากชำระเงิน</td>
						</tr>
					</table>
				</div>
			</div><!--end amount-->
			
			
			<div id="footer" style="clear: both;">
				<?php include ('../include/footter_quo.php'); ?>
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
</div>
<input type="button" value="คำนวนราคางวด" id="btn-calngod">
<div style="display:none;" id="installs"><?php echo $tidtung;?></div>
</body>
</html>