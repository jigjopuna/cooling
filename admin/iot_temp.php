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
	<style></style>
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<script>
	$(document).ready(function(){
		$("#btn-calngod").click(calucalatengod);
	});
	function calucalatengod(){
		
		var allprice = $('#totolprice').text().replace(/,/g, '');
		var firsts = (allprice*0.5).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		var seconds = (allprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		var thirds = (allprice*0.2).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		
		
		$('.cal_ngo1').text(firsts);
		$('.cal_ngo2').text(seconds);
		$('.cal_ngo3').text(thirds);
	}
	

</script>

<?php 
	require_once('../include/googletag.php');
	$cust_id = trim($_POST['search_custname']); 
	$iotqty = trim($_POST['iotqty']);

	
	$chkdetail = mysql_fetch_array(mysql_query("SELECT cusp_prov FROM tb_cust_part WHERE cusp_id = '$cust_id'"));
	$rowchkdetail = $chkdetail['cusp_prov'];
	
	//ถ้าลูกค้าให้ข้อมูลมาแค่ชื่อกับเบอร์โทร ไม่ต้อง Join กับตารางจังหวัด เพราะข้อมูลจะไม่ขึ้น
	if($rowchkdetail < 90){
		$row = mysql_fetch_array(mysql_query("SELECT cusp_name, cusp_tel FROM tb_cust_part WHERE cusp_id = '$cust_id'"));
	}else{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM ((tb_cust_part q JOIN tumbon t ON t.id = q.cusp_tumbon) JOIN amphur a ON q.cusp_amphur = a.id) JOIN province p ON q.cusp_prov = p.id WHERE cusp_id = '$cust_id'"));
		
	}
	$cust_name = $row['cusp_name'];
	$cust_province = $row['cusp_prov'];


?>
</head>
<body>
<div class="book">
	<div class="page">
        <div class="subpage">

           <div id="cover_header">
				
				<?php 
					include ('../include/chk_addr.php'); 
				    //include ('../include/cpn_addr.php');
				?>
			</div><!--end cover_header-->
			
			<?php include ('../include/quotation_head_cpn.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="height: 50px; font-size:18px; font-weight:bold; background: #DAD7D7; border: 1px solid black;">IoT System 1 ชุด/3 ห้อง วัดอุณหภูมิ</td>
					</tr style="border: solid black 1px;">
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l" style="width:65%;">Description </td>
						<td colspan="2" style="width:9%;" class="l">QTY</td>
						<td class="l" style="width: 13%;">Unit Price</td>
						<td class="l" style="width:13%;">Amount</td>
					</tr>
						
				
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline; font-size:18px; font-weight:bold;">HARDWARE</span> </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">1. IDCAM IoT technology Model IDCAM-Plus.</td>
						<td colspan="2" class="l" align="center">1 SET</td>
						<td class="l" align="right">20,000.00</td>
						<td class="l" align="right">20,000.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - สามารถใช้งานได้ 3 ห้อง หรือ 3 จุด</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">2. Device IoT Box และ เซ็นเซอร์วัดอุณหภูมิ ชนิด NTC </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - หน้าจอแสดงผล OLED 1.3 นิ้ว</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline; font-size:18px; font-weight:bold;">SOFTWARE</span> </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">1. ระบบแจ้งเตือนบนแอปพลิเคชั่นไลน์ และเว็บแอปพลิเคชั่น </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;- ไลน์จะส่งข้อความเแจ้งเตือนหากห้องเย็นมีปัญหาหรือไม่ได้อุณหภูมิ</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					

					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;- เว็บแอปพลิเคชั่น แสดงสถานะ อุณหภูมิ</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline; font-size:18px; font-weight:bold;">SERVICE</span>  </td>
						<td colspan="2" class="l" align="center">1 Year</td>
						<td class="l" align="right"></td>
						<td class="l" align="right">8,000.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ค่าบริการต่อ 3 จุด หรือ  3 ห้อง </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ระบบจะเก็บข้อมูลไว้ที่คลาวด์ ทุกๆ 1 นาที หรือตามที่เราตั้งค่าไว้</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - สามารถดูรายงานอุณหภูมิรายวันและรายเดือนได้</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - มีเจ้าหน้าที่คอยมอนิเตอร์ดูแลห้องเย็นลูกค้าตลอดเวลา</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline; font-size:18px; font-weight:bold;">INSTALLATION</span> </td>
						<td colspan="2" class="l" align="center"> 1 SET</td>
						<td class="l" align="right"></td>
						<td class="l" align="right">12,000.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ค่าบริการติดตั้งต่อ 3 จุด หรือ  3 ห้อง </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ระยะเดินสายเซ็นเซอร์ไม่เกิน 30 เมตร </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ค่าบริการติดตั้ง เซ็นเซอร์วัดอุณหภูมิ และอุปกรณ์ Monitor</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ต้องมี WIFI บริเวณห้องเย็น</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - รับประกับอุปกรณ์ IDCAM 1 ปี</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					
					<tr>
						<td rowspan="3">
							<div style="width:100%">
								<div style="width:30%; float:left;">
									<img style="width:100px; height:100px;" src="../content/images/social/idcam-plus.png" />
								</div>
								<div style="width:70%; float:left; height:100px;">
									<p align="left;" style="margin-top:35px;"> ข้อมูลเพิ่มเติม SCAN ME </p>
								</div>
							</div>
						</td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right">40,000.00</td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ภาษีมูลค่าเพิ่ม 7%</td>
						<td class="rt l" align="right">2,800.00</td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ  </td>
						<td class="rt l" align="right" id="totolprice">42,800.00</td>
					</tr>
				
				
				</table>

			</div><!--end product_price-->
			

			
			
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	<div class="page">
        <div id="cover_header">
				
			<?php 
					include ('../include/chk_addr.php'); 
				  //include ('../include/cpn_addr.php'); 
			?>
			
			</div><!--end cover_header-->
			
			<?php include ('../include/quotation_head_cpn.php'); ?>
			
			<div id="product_price" style="margin-top:400x; clear:both">
				<img src="../shop/images/iot/plus/plus.jpg" style="width:60%; margin-top:50px; margin-left:150px;">

			</div><!--end product_price-->
			
			
			
			
			<div id="amount" class="amounts" style="clear: both; margin-top: 100px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
					
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2" align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน</td>
						</tr>


						
						<tr>
							<td colspan="2" align="left">บัญชีธนาคาร กสิกรไทย </td>
							<tr>
								<td colspan="2" align="left">  บจ. โชคอุตสาหะ พารวย  เลขที่บัญชี  <span style="text-decoration: underline; font-weight: bold;"> 091-8-53927-1</span></td>
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
							<td align="left">  ส่งสินค้าและติดตั้งภายใน 30 วันหลังจากชำระเงิน</td>
						</tr>
					</table>
				</div>
			</div><!--end amount-->
			
			<div id="footer" style="clear: both;">
				<?php include ('../include/footter_quo_chk.php'); ?>
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
				
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div> <!--end page 3-->
	
	
  
  <div class="page">
        <div class="subpage">

             <div id="cover_header">
				<?php 
					include ('../include/chk_addr.php'); 
				  //include ('../include/cpn_addr.php'); 
				?>
			</div><!--end cover_header-->
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 3</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				
				
				<div class="row" style="padding-top:0px;">
					<div class="tew" style="padding: 20px;" >
					<h2>ระบบห้องเย็นออนไลน์</h2>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					IDCAM Plus เป็นอุปกรณ์ (IoT) ที่ออกแบบให้ใช้งานกับห้องเย็นโดยเฉพาะ ช่วยให้ผู้ใช้งานสามารถ <span class="text-strong">ติดตาม</span> สถานะการทำงานของห้องเย็นได้ตลอดเวลาผ่านการเชื่อมต่ออินเตอร์เน็ตแบบ Real Time จะเก็บข้อมูลทุกๆ 1 นาที <br><br>
					
					<span class="text-large">ประโยชน์เด่นๆ</span> ของ IDCAM Plus ช่วย <span class="text-strong">ลดความเสี่ยง</span> ของที่เก็บหรือแช่แข็งไว้ในห้องเย็น เพราะเราจะไม่ให้ห้องเย็นลูกค้าเสีย โดยระบบนี้จะแจ้งเตือนทันทีหากอุณหภูมิให้ห้องเย็นไม่ได้อุณหภูมิตามที่เราต้องการ <br><br>

					ถ้าระบบผิดปกติอย่างใดอย่างหนึ่งไม่ว่าจะเป็นอุณหภูมิหรือเรื่องเครื่องทำความเย็น ระบบจะ <span class="text-strong">แจ้ง Line</span> ให้ทราบทันที จะเป็น Line ส่วนตัวหรือ Line กลุ่มก็ได้ จะได้ช่วยกันดู
					<br><br>

					 โดยการทำงานของระบบนี้ จะเก็บข้อมูล ขึ้นระบบ <span class="text-strong">คลาวด์ (Cloud)</span> ทุกๆ 1 นาที หรือมากน้อยกว่านี้ก็ได้ตามต้องการ และเราสามารถวิเคราห์การทำงานของเครื่องได้จาก Big Data ที่เราเก็บข้อมูลไว้ และบริการการเรียกรายงาน Report ได้  มีรายละเอียดดังต่อไปนี้<br><br>

					<strong><u>1. ทราบอุณหภูมิ</u></strong> ณ ปัจจุบันของห้องเย็น และดูย้อนหลังได้ <br><br>
					
					
					
					เพียงทำเท่านี้เราก็จะป้องกัน ลดความเสี่ยง สินค้าที่อาจจะเสียหายในห้องเย็นได้ ลดการซ่อมบำรุงเครื่องทำความเย็นได้อีกด้วย<br><br>
					</div>
				</div> <!--end row-->

				
			</div><!--end container-->
			<div class="conclude" style="clear: both; line-height:18px;"></div><!--end conclude -->
			<br><br><br>
			<div class="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div>
  
  
</div>
<input type="button" value="คำนวนราคางวด" id="btn-calngod">
</body>
</html>