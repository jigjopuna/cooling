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
	<link rel="stylesheet" href="../css/quotation.css">
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
	$custname = trim($_POST['search_custname']);
	$tool = trim($_POST['search_tool']);
	$qty = trim($_POST['qty']);
	
	$sale_id = trim($_POST['sale_id']);
	$date = trim($_POST['date']); 
	$bank_acc = trim($_POST['bank_acc']);
	$shipcost = trim($_POST['shipcost']);
	
	
	
	/*echo 'custname : '.$custname.'<br>';
	echo 'tool : '.$tool.'<br>';
	echo 'qty : '.$qty.'<br>';
	echo 'sale_id : '.$sale_id.'<br>';
	
	echo 'date : '.$date.'<br>';
	echo 'bank_acc : '.$bank_acc.'<br>';*/
	
	$row_tool = mysql_fetch_array(mysql_query("SELECT * FROM tb_tools WHERE t_id = '$tool'"));
	
	
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
				<?php require_once('../include/cpn_addr.php');	?>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head_cpn.php'); ?>
			
			<div style="width:100%; float:none; overflow:hidden;"></div>
			<div id="product_price" style="margin-top:10px; clear:both; ">
			
					<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tbody>
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดเช่าห้องเย็นพร้อมติดตั้ง</td>
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
						<td class="l">1. อัตราค่าเช่าห้องเย็นต่อเดือน (เช่าไม่น้อยกว่า 12 เดือน)   </td>
						<td colspan="2" class="l" align="center">  </td>  
						<td class="l" align="right"></td>
						<td class="l" align="right">15,000.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp; ห้องเย็นขนาด 2.4 x 3.6 x 2.4 เมตร กว้าง ยาว สูง </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp; รองรับอุณหภูมิ -16  องศา ชนิดโฟม PU หน้า 4 นิ้ว </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">2. ค่าประกันห้องเย็น  (ได้รับคืนเมื่อ จัดส่งคืนห้องเย็น)</td>
						<td colspan="2" class="l" align="center">  </td>  
						<td class="l" align="right"></td>
						<td class="l" align="right">60,000.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">3. ค่าขนส่งไป ฉะเชิงเทรา รถเครน</td>
						<td colspan="2" class="l" align="center">  </td>  
						<td class="l" align="right"></td>
						<td class="l" align="right">7,500.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">4. บริการติดตั้งห้องเย็น ฟรี</td>
						<td colspan="2" class="l" align="center">  </td>  
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
						<td colspan="3" class="rlt">ค่าเช่าเดือนละ</td>
						<td class="t l" align="right">15,000.00</td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl"></td>
						<td class="rt l" align="right"> </td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ชำระครั้งแรก</td>
						<td class="rt l" align="right" id="totolprice">82,500.00 </td>
					</tr>
				
				</tbody></table>
			</div><!--end product_price-->
			
			
			
			<div id="amount" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left"><span style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน </span></td>
						</tr>
						
						<tr>
							<td align="left"> <!-- บัญชีธนาคารกสิกรไทย  --> บัญชีธนาคารไทยพานิชย์ </td>
							<td align="left"></td>
							<tr>
								<td colspan="2" align="left"><!-- บจ.ซีพีเอ็น888-->  เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;"> <!--075-8-81892-6--> 830-249575-5</span></td>
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
							<td align="left">  ส่งสินค้า ภายใน 15 วันหลังจากชำระเงิน</td>
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