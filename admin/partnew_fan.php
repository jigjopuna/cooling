<?php 
	require_once('../include/connect.php');
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	$thatdate = $date."/".$nMonth."/".$year;
	$tool_id = trim($_GET['t_id']);
	
	$row = mysql_fetch_array(mysql_query("SELECT t_name, t_model, t_price_sell, t_volt, t_amp FROM tb_tools WHERE t_id = '$tool_id'"));
	$tname = $row['t_name'];
	$tmodel = $row['t_model'];
	$tprice = $row['t_price_sell'];
	
	$shipping = 200;
	$discount_rate = 0.1;
	
	//ราคาลด 10% ก่อนรวม VAT
	$tempo = $tprice-($tprice*$discount_rate);
	$vat = $tempo*0.07;
	$tatal = $tprice+$vat+$shipping;
	
	
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาพัดลม" />
	<link rel="shortcut icon" href="content/images/favicon.png">
	<title>อะไหล่ <?php echo $tname. " " .date("Y").'-'.$nMonth.'-'.$date; ?></title>
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
	require_once('../include/googletag.php');
	
?>
</head>
<body>
<div class="book">
	<div class="page">
        <div class="subpage">

            <div id="cover_header">
				<?php require_once('../include/cpn_addr.php');	?>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head_cpn.php'); ?>
			
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
						<td class="l">1. พัดลม Axail Fan Eurotech </td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right">4,200.00</td>
						<td class="l" align="right">4,200.00</td>
					</tr>

<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - รุ่น 4E350-S ไฟฟ้า 3 เฟส 380V</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>

<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ทิศทางลม แบบดูด Sunction</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">2. ค่าบริการขนส่ง</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right">200.00</td>
					</tr>
					
    
    <tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>


<tr class="highs" style="">
						<td class="l"><img src="https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech01.jpg" style="width:200px;"></td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
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
						<td class="t l" align="right">4,400.00</td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ภาษีมูลค่าเพิ่ม 7%</td>
						<td class="rt l" align="right">308.00</td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" id="totolprice">4,708.00</td>
					</tr>
				
				</tbody></table>
			</div>
			
			
			
			<div id="amount" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left"><span style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน </span></td>
						</tr>
						
						<tr>
							<td align="left"><!--บัญชีธนาคารกสิกรไทย(ออมทรัพย์)--> บัญชีธนาคารกรุงเทพ </td>
							<td align="left"></td>
							<tr>
								<td colspan="2" align="left"> <!--บจ.ซีพีเอ็น888--> นายเดชาธร ผลินธร  เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;"><!-- 075-8-81892-6 --> 025-704019-6 </span></td>
							</tr>
						</tr>
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
							<td align="left">  ส่งสินค้า ภายใน 2-3 วันหลังจากชำระเงิน</td>
						</tr>
					</table>
				</div>
			</div><!--end amount-->
			
			
			<div id="footer" style="clear: both;">
				<div style="width: 65%; float:left; margin-top: 20px;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left; margin-top: 20px;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายภูริชญ์ โชคอุตสาหะ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
					<br>
				</div>
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