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
		.text_strong, .text-strong { font-weight: bold; text-decoration:underline;}
		.text_emunder { text-decoration:underline; font-weight: bold; }
		.container { clear:both; border: 1px solid black; min-height:850px;}
		.row { width: 100%; clear:both; padding-bottom: 60px; overflow: hidden;}
		.col1 { float:left; width:45%; margin:0.5% 0.5% 0.5% 10px; /*background:red;*/ }
		.col2 { float:left; width:51%; margin:0.5% 0.5% 0 10px; /*background:blue;*/ }
		.col3 { float:left; width:53%; margin:0.5% 0.5% 0.5% 10px; /*background:red;*/ }
		.col4 { float:left; width:43%; margin:0.5% 0.5% 0 10px; /*background:blue;*/ }
		.topic { font-family: 'Kanit', sans-serif; font-size:18px; font-weight:bold; text-decoration:underline;}
		.intopic { font-family: 'Kanit', sans-serif;  }
		.tew { line-height: 18px;}
		
		@media print { 
			 #btn-calngod { display: none !important; } 
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
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_part.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="height: 50px; font-size:18px; font-weight:bold; background: #DAD7D7; border: 1px solid black;">Cold Storage Room IoT System Detail </td>
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
						<td class="l" align="right">48,000.00</td>
						<td class="l" align="right">48,000.00</td>
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
						<td class="l">&nbsp;&nbsp;&nbsp; - 8 อินพุต อะนาล็อค แชแนล และ 1 อินพุต ดิจิตอล</td>
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
						<td class="l">&nbsp;&nbsp;&nbsp;- ไลน์จะส่งข้อความแจ้งเตือนทันทีเมื่ออุปกรณ์เครื่องทำความเย็นมีกระแสไฟสูง เช่น คอมเพรสเซอร์, มอเตอร์คอยล์ร้อน หรือ มอเตอร์คอยล์เย็น โอเวอร์โหลด </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;- ไลน์ส่งข้อความแจ้งเตือนทันทีเมื่อไฟฟ้าไม่เสถียร</td>
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
						<td class="l">&nbsp;&nbsp;&nbsp;- เว็บแอปพลิเคชั่น แสดงสถานะ อุณหภูมิและพฤติกรรมการทำงานของเครื่องทำความเย็นแต่ะละอย่างตลอดเวลามี</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; อุณหภูมิ ณ ปัจจบัน, คอมเพรสเซอร์, คอยล์ยร้อน, คอยล์เย็น, ดีฟรอส , แรงดันน้ำยา, คอมเพรสเซอร์โอเวอร์โหลด, มอเตอร์คอยล์เย็น โอเวอร์โหลด, มอเตอร์คอยล์ร้อน โอเวอร์โหลด และสถานะไฟฟ้า</td>
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
						<td class="l">&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline; font-size:18px; font-weight:bold;">SERVICE</span> (ฟรี 1 ปี แรก) </td>
						<td colspan="2" class="l" align="center">1 Year</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><s>25,000.00</s></td>
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
						<td class="l" align="right">3,000.00</td>
					</tr>
					
					

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - รับประกับอุปกรณ์ IDCAM 2 ปี</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; **** ลูกค้าจะต้องเตรียมอินเตอร์เน็ต WiFi ที่มีสัญญาณบริเวณห้องเย็นที่ติดตั้ง IDCAM</td>
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
						<td class="t l" align="right">51,000.00</td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ภาษีมูลค่าเพิ่ม 7%</td>
						<td class="rt l" align="right">3,570.00</td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ  </td>
						<td class="rt l" align="right" id="totolprice">54,570.00</td>
					</tr>
				
				
				</table>

			</div><!--end product_price-->
			

			
			
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	<div class="page">
        <div class="subpage">

             <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_part.php'); ?>
			
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
							<td align="left">บัญชีธนาคารไทยพานิชย์</td>
							<td align="left"></td>
							<tr>
								<td colspan="2" align="left"> <!--ชูเกียรติ เทียนอำไพ--> หจก.ท็อปคูลลิ่ง  เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;"><!--855-2-05499-8--> 830-242349-9</span></td>
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
							<td align="left">  ส่งสินค้าและติดตั้งภายใน 20 วันหลังจากชำระเงิน</td>
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
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
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
    </div> <!--end page 3-->
	
	
  
  <div class="page">
        <div class="subpage">

             <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
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
					
					<span class="text-large">ประโยชน์เด่นๆ</span> ของ IDCAM Plus ช่วย <span class="text-strong">ลดความเสี่ยง</span> ของที่เก็บหรือแช่แข็งไว้ในห้องเย็น เพราะเราจะไม่ให้ห้องเย็นลูกค้าเสีย โดยระบบนี้จะแจ้งเตือนทันทีหากอุณหภูมิให้ห้องเย็นไม่ได้อุณหภูมิตามที่เราต้องการหรือระบบห้องเย็นมีปัญหา เช่น กระแสไฟฟ้าสูง จนทำให้ระบบหยุดการทำงาน <br><br>

					ถ้าระบบผิดปกติอย่างใดอย่างหนึ่งไม่ว่าจะเป็นอุณหภูมิหรือเรื่องเครื่องทำความเย็น ระบบจะ <span class="text-strong">แจ้ง Line</span> ให้ทราบทันที จะเป็น Line ส่วนตัวหรือ Line กลุ่มก็ได้ จะได้ช่วยกันดู
					<br><br>

					 โดยการทำงานของระบบนี้ จะเก็บข้อมูล ขึ้นระบบ <span class="text-strong">คลาวด์ (Cloud)</span> ทุกๆ 1 นาที หรือมากน้อยกว่านี้ก็ได้ตามต้องการ และเราสามารถวิเคราห์การทำงานของเครื่องได้จาก Big Data ที่เราเก็บข้อมูลไว้ และบริการการเรียกรายงาน Report ได้  มีรายละเอียดดังต่อไปนี้<br><br>

					<strong><u>1. ทราบอุณหภูมิ</u></strong> ณ ปัจจุบันของห้องเย็น และดูย้อนหลังได้ <br><br>
					<strong><u>2. ทราบสถานะการทำงาน</u></strong> ของเครื่องคอมเพรสเซอร์ ว่าทำงานหรือไม่ทำงาน ณ ขณะที่ดู<br><br>
					<strong><u>3. ทราบสถานะการทำงาน</u></strong> ของคอยล์เย็น ซึ่งเป็นอุปกรณ์ที่อยู่ในห้องเย็นและทำงานร่วมกับชุดคอนเด็นซิ่ง (Compressor)<br><br>
					<strong><u>4. ทราบว่า Overload</u></strong> คอมเพรสเซอร์ตัดหรือไม่ ก็คือรู้ว่ากระแสไฟฟ้าที่ให้คอมเพรสเซอร์นั้นมากกว่าปกติหรือไม่<br><br>
					<strong><u>5. ทราบว่า Overload</u></strong> (กระแสไฟฟ้าเกิน)  ที่คอยล์เย็นหรือไม่<br><br>
					<strong><u>6. ทราบว่า Overload</u></strong> (กระแสไฟฟ้าเกิน) ที่คอยล์ร้อนหรือไม่ หากมีกระแสไฟฟ้าเกิน ก็จะแจ้งเตือนไปผู้ใช้งานห้องเย็นทันในหลายช่องทาง คือ ทางแอปพลิเคชั่นไลน์  ในหน้า DashBoard Web Application และบันทึกจำนวนการตัดของ Overload ลงฐานข้อมูลเพื่อนำไปวิเคราะห์ต่อไป<br><br>
					<strong><u>7. ทราบสถานะไฟฟ้า</u></strong> (Phase Protection) ว่าปกติหรือมีไฟฟ้าเกิน ไฟตก ไฟไม่บาลานซ์เฟส หรือไม่<br><br>

					เราจะทราบได้ว่าแต่ละอุปกรณ์หรือสถานะ <span class="text-strong">ทำงานกี่นาที</span> และ ไม่ทำงานกี่นาที นั้นหมายถึงเรารู้พฤติกรรมการทำงานของเครื่องทำความเย็นทั้งระบบ ว่าระบบทำงานได้ปกติ และ ได้ประสิทธิภาพได้เหมือนกับตอนที่ติดตั้งใหม่ๆ หรือไม่ (ปกติประสิทธิภาพเครื่องจะลดลงตามระยะเวลาที่ใช้งาน เช่น กินกระแสไฟมากขึ้น หรือทำอุณหภูมิได้ช้าลงในเวลาที่เท่าเดิม)
					<br><br>
					
					นอกจากเราจะรู้ <span class="text-strong">พฤติกรรม</span> การทำงานของเครื่องทำความเย็นแล้ว เรายังสามารถนำเวลาที่เครื่องทำงานมาคำนวณเป็นค่าไฟฟ้าในเบื้องต้นได้ ทำให้เราวางแผนหรือบริหารห้องเย็นได้ เช่น หากค่าไฟเยอะผิดปกติ เราจะหาสาเหตุที่ผิดปกติได้อย่างรวดเร็ว หรือการตั้งค่าบางอย่างที่ใช้ไฟฟ้าโดยไม่จำเป็นออกไป เช่น ฮีตเตอร์ละลายน้ำ จริงๆ ถ้าละลายหมดแล้วแต่ฮีทเตอร์ยังทำงานอยู่ ก็อาจลดเวลาการ Defrost จะช่วยประหยัดค่าไฟได้
					<br><br>
					
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