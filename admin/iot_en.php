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


?>
</head>
<body>
<div class="book">
	<div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
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
						<td class="l">2. Device IoT Box AND NTC Temperture Sensor.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - Monitor Display OLED 1.3 inch</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - 8 input Analog Chanel and 1 input Digital</td>
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
						<td class="l">1. Notification System with Line Application and Web Application Real Time.</td>
						<td colspan="2" class="l" align="center">1 SET</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;- Line Notification send message if Cold Room system Error.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;- Line send alert message when Eqiupment Current Overload eg.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; Compressor, Evaperator, Gas Pressure and Electric.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;- Line send alert message when Temperture not in range.</td>
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
						<td class="l">&nbsp;&nbsp;&nbsp;- Web Application always show all Cold Room Status</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; Compressor, Evaperator, Defrost, Gas Pressure, Current Condensing Status, Current Evaperator, Overload Compressor, Overload Evaperator, Gas Pressure and Electric Status</td>
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
						<td class="l">&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline; font-size:18px; font-weight:bold;">SERVICE</span> (Free fist year) </td>
						<td colspan="2" class="l" align="center">1 Year</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><s>15,000.00</s></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - System store data to Cloud every 5 minute or more.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - Report Temperature.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - Operator Monitor.</td>
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
						<td class="l">&nbsp;&nbsp;&nbsp;</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
						
						
					</tr>

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - Warranty IoT Device 2 Year.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; **** Customer WiFi & Internet should be avaliable cold room area.</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td rowspan="3">
							<div style="width:100%">
								<div style="width:30%; float:left;">
									<img style="width:100px; height:100px;" src="../content/images/social/frame.png" />
								</div>
								<div style="width:70%; float:left; height:100px;">
									<p align="left;" style="margin-top:35px;"> More Information SCAN ME </p>
								</div>
							</div>
						</td>
						<td colspan="3" class="rlt">Total</td>
						<td class="t l" align="right"><?php echo number_format($prettylast, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format($discount, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">Amount  <?php if($intvat=='on') echo '(Int VAT 7%)';?></td>
						<td class="rt l" align="right" id="totolprice"><?php echo number_format($total_price, 2, '.', ',');?> </td>
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
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:500x; clear:both">
				<img src="../shop/images/iot/plus/plus.jpg" style="width:60%; margin-top:100px; margin-left:150px;">

			</div><!--end product_price-->
			
			
			
			
			<div id="amount" style="clear: both; margin-top: 100px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tbody><tr>
							<td colspan="2" align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> Payment</td>
						</tr>
						
						<tr>
							<td align="left">Account nember to transfer.</td>
							<td align="left"></td>
						</tr>
						
						<tr>
							<td align="left">Kasikorn Bank Account.</td>
							<td align="left"></td>
						</tr>
						
						<tr>
							<td colspan="2" align="left"> Topcooling LTD,.CO Number <span style="text-decoration: underline; font-weight: bold;"><!--855-2-05499-8--> 047-8-18623-1</span></td>
						</tr>
						
					</tbody></table>
					
				</div><br>
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tbody><tr>
							<td align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> Set up for</td>
						</tr>
						<tr>
							<td align="left">Within 20 days of bidding date.</td>
						</tr>
						<tr>
							<td align="left">Delivery within 20 days after payment.</td>
						</tr>
					</tbody></table>
				</div>
			</div><!--end amount-->
			
			
			<div id="footer" style="clear: both;">
				<div style="width: 65%; float:left; margin-top: 50px;">
					<span>Ordered items listed above</span> <br><br><br>
					<span>Sign......................................</span> <br><br>
					<span>2019/03/27</span>
				</div>
				<div style="width: 35%; float:left; margin-top: 50px;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;Yours Sincerely</span> <br><br><br><br>
					<span>(Chookied Tenumpai)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;Sale Manager</span>
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
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 6</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				
				
				<div class="row">
					<div class="col1">
						<div style="width: 300px; height:280px; background: orange;">
							<?php
								if($foam==1){ 
							?>
								<img src="../content/images/quotation/pu.jpg">
								<?php } else { ?>
								<img src="../content/images/quotation/007.jpg">
								<?php }  ?>
						</div>
						
					</div>
					<div class="col2">
						<span class="topic">ฉนวนโฟมผนังห้องเย็น</span><br>
						<p><span class="intopic">ชนิดของฉนวน  : <?php echo $foams." ".$foaminch; ?> นิ้ว</p>
						<p><span class="intopic">ความหนาของฉนวนโฟม  :</span> <?php echo $foaminch; ?> นิ้ว</p> 
						<p><span class="intopic">ยี่ห้อ :</span> BHP</p>
						<p><span class="intopic">คุณสมบัติ :</span> ensity 38-40 kg/m3 เหล็ก  0.45 เมตร</p>
						<p><span class="intopic">วัสดุเหล็ก :</span> เหล็กคัลเลอร์บอร์นผิวเรียบ</p>
						<p><span class="intopic">วัสดุกันรั่วกันความชื้น :</span>  "บูทิวมาสติก" สำหรับใช้ฉีดเชื่อมรอยต่อของฉนวน</p>
						<p><span class="intopic">ติดตั้ง :</span>  รีเวทสำหรับยึดแผ่นฉนวนกับอลูมิเนียม</p>
						<p><span class="intopic">ติดตั้ง :</span>  อลูมิเนียมหน้าตัดต่างๆ ชนิดชุบด้วยอโนไดส์ สำหรับเป็นตัวเข้าลิ้น และมอบปิดรอยต่อส่วนต่างๆ ของห้องเย็น</p>

					</div>
				</div> <!--end row-->
				
				
				<div class="row">
					<div class="col1">
						<span class="topic">ประตูห้องเย็น</span><br>
						<p><span class="intopic">ชนิดประตู :</span> ประตูบานสวิง </p>
						<p><span class="intopic">ขนาด :</span> 1.0 x 2.0 เมตร (กว้างสูง)</p>
						<p><span class="intopic"></span>- อุปกรณ์นิรภัยสำหรับติดที่บานประตูภายในห้องเย็นเพื่อกระทุ้งเปิดจากด้านใน แม้ด้านนอดถูกล็อค</p>
						<p><span class="intopic"></span>- กรอบบานประตูใชแผ่น "คัลเลอร์บอร์น" ครอบรอบบาน, วงกบประตูแผ่น"คัลเลอร์บอร์น" ครอบรอบด้าน</p>
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/008.jpg">
						</div>
					</div>	
				</div> <!--end row-->
				
				
				
				
				
			</div><!--end container-->
			<div class="conclude" style="clear: both; line-height:18px;"></div><!--end conclude -->
			<br><br><br>
			<div class="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div>
  
  <div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;"></div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				
				<div class="row">
					<div class="col3">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/009.jpg">
						</div>
						
					</div>
					<div class="col4">
						<span class="topic">พื้นห้องเย็น</span><br>
						<p><span class="intopic">ชนิด :</span> พื้นสำเร็จรูป ปูทับด้วยอลูมิเนียมกันลื่น</p>
						<p><span class="intopic">วัสดุกันรั่ว : </span> ซิลิโคน และซีลแลนด์ สำหรับใช้ฉีดเชื่อมรอยต่อของแผ่นฉนวน</p>
						
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