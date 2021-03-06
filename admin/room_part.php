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
		
		var allprice = $('#totolprice').text().replace(/,/g, '');
		var firsts = (allprice*0.7).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		var seconds = (allprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		
		
		$('.cal_ngo1').text(firsts);
		$('.cal_ngo2').text(seconds);
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
	
	
	$ord_temp = trim($_POST['ord_temp']);
	$date_pay = trim($_POST['date_pay']);
	$ship_cost = trim($_POST['ship_cost']);
	$voltage = trim($_POST['voltage']);
	$size = trim($_POST['sizes']);
	
	$percent = trim($_POST['percent']);
	$profit = ($percent/100)+1;
	
	
	$r_width = trim($_POST['r_width']);
	$r_lenght = trim($_POST['r_lenght']);
	$r_high = trim($_POST['r_high']);
	
	$foam = trim($_POST['foam']);
	$foaminch = trim($_POST['foaminch']);
	
	$doortype = trim($_POST['doortype']);
	$d_width = trim($_POST['d_width']);
	$d_high = trim($_POST['d_high']);
	$floor1 = trim($_POST['floor1']);
	
	$discount = trim($_POST['discount']);
	
	
	$ord_vat = trim($_POST['ord_vat']);
	$intvat = trim($_POST['intvat']);
	
	
	$labors = trim($_POST['labors']);
	$bedtaled = trim($_POST['bedtaled']);
	$qtyhp = trim($_POST['qtyhp']);
	
	
	$labor = $labors;
	$jipata = $bedtaled;

	$cute = ($r_width*$r_high*2) + ($r_lenght*$r_high*2) + ($r_width*$r_lenght*2);
	if($foaminch==2){ 
		$cens = (5.08*2)/100; 
	} else if($foaminch==3) {
		$cens = (7.62*2)/100; 
	} else if($foaminch==4){
		$cens = (10.16*2)/100; 
	}else if($foaminch==5){
		$cens = (12.70*2)/100; 
	}else if($foaminch==6){
		$cens = (15.24*2)/100; 
	}else if($foaminch==8){
		$cens = (20.32*2)/100; 
	}
	
	if($foam==1){ $foams = 'PU'; } else { $foams = 'PS'; }
	if($doortype==1){ $doortypes = 'ประตูบานสวิง '; $pratoo = 26000; } else { $doortypes = 'ประตูบานเลื่อน'; $pratoo = 37000; }
	
	$sql_wall = mysql_fetch_array(mysql_query("SELECT * FROM tb_productroom WHERE pr_cate= 1 AND pr_size = '$foaminch' AND pr_type = '$foams'"));
	$wall_price = $sql_wall['pr_sell_price']; 
	
	
	$realcost = ($cute*$wall_price)+$pratoo;
	$kumrai = (($cute*$wall_price)+$pratoo)*$profit;
	
	$befor_ship = $kumrai+$jipata+$labor;
	$prettylast = $befor_ship+$ship_cost;
	$total_price = $prettylast-$discount;
	
	$ngod1 = $total_price*0.5;
	$ngod2 = $total_price*0.3;
	$ngod3 = $total_price*0.2;
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
				<span>Web:  https://topcooling.net/</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็น</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">ห้องเย็น ปริมาณแผ่นฉนวน (<?php echo $cute; ?>) ตารางเมตร</td>
						<td style="width: 40%" class="b l" align="center" colspan="4"><strong>ขนาดห้องเย็น (กว้าง x ยาว x สูง) เมตร</strong></td>
					</tr>
					
					<tr align="center">
						<td align="left">ฉนวน <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong></td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายนอก <?php echo $r_width;?> x <?php echo $r_lenght;?> x <?php echo $r_high;?></td>
					</tr>
					
					<tr align="center">
						<td align="left"></td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายใน <?php echo number_format($r_width-$cens, 2, '.', ',');?> x <?php echo number_format($r_lenght-$cens, 2, '.', ',') ;?> x <?php echo number_format($r_high-$cens, 2, '.', ',');?></td>
					</tr>
					
					
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
						
				
					
					
					<tr class="highs" style="">
						<td class="l">1. ผนังห้องเย็น โฟม <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong> ensity 38-40 kg/m3 เหล็ก BHP 0.45 เมตร </td>
						<td colspan="2" class="l" align="center">1 ห้อง</td>
						<td class="l" align="right"><?php echo number_format($befor_ship, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($befor_ship, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แผ่นผนัง PS <?php echo $foams." ".$foaminch; ?>" ความหนาแน่น 1.25 ปอนด์   แผ่น</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr><tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แผ่นเพดาน <?php echo $foams." ".$foaminch; ?>" ความหนาแน่น 1.25 ปอนด์   แผ่น</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แผ่นพื้นโฟมเปล่า <?php echo $foams." ".$foaminch; ?>" ความหนาแน่น 2 ปอนด์   แผ่น</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">2. <?php echo $doortypes." ".$foams." ".$foaminch; ?> ขนาด <strong><u><?php echo $d_width.' x '.$d_high?> เมตร</u></strong>  กว้าง สูง</td>
						<td colspan="2" class="l" align="center">1 บาน</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
				
					
					
					<tr class="highs" style="">
						<td class="l"> 3.  ค่าจัดส่งสินค้า</td>
						<td colspan="2" class="l" align="center">1 งาน</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"><?php echo number_format($ship_cost, 2, '.', ','); ?></td>
					</tr>
				
					
					<tr>
						<td rowspan="3">
							<div style="width:100%";>
								<div style="width:30%; float:left;">
									<img style="width:100px; height:100px;" src="../content/images/social/frame.png" />
								</div>
								<div style="width:70%; float:left; height:100px;">
									<p align="left;" style="margin-top:35px;"> ข้อมูลเพิ่มเติม SCAN ME </p>
								</div>
							</div>
						</td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($prettylast, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ส่วนลด</td>
						<td class="rt l" align="right"><?php echo number_format($discount, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ  (Inc VA& 7%) <?php if($intvat=='on') echo '(Int VAT 7%)';?></td>
						<td class="rt l" align="right" id="totolprice"><?php echo number_format($total_price, 2, '.', ',');?> </td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			
			
			<div id="amount" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน</td>
						</tr>
						<tr>
							<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   70%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
							<td align="left" style="width: 35%"><span class="cal_ngo1"><?php echo number_format($ngod1, 2, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระก่อนจัดส่งอุปกรณ์ </td>
							<td align="left"><span class="cal_ngo2"><?php echo number_format($ngod2, 2, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left">บัญชีธนาคารไทยพานิชย์ (ออมทรัพย์)</td>
							<td align="left"></td>
							<tr>
								<td colspan="2" align="left"> <!--ชูเกียรติ เทียนอำไพ--> หจก. ท็อปคูลลิ่ง  เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;"><!--855-2-05499-8--> 830-242349-9</span></td>
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
							<td align="left">  ส่งสินค้าภายใน 15 วันหลังจากได้รับมัดจำงวดที่ 1</td>
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
    </div> <!--end page-->
	
	<div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  https://topcooling.net/</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:200x; clear:both">
				<img src="../content/images/cool/speed300.jpg" style="width:60%; margin-left:150px;">

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				
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
				<span>Web:  https://topcooling.net/</span>
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

					</div>
				</div> <!--end row-->
				
				
				<div class="row">
					
						<div class="col1">
							<span class="topic">ประตูห้องเย็น</span><br>
							<p><span class="intopic">ชนิดประตู : </span><?php echo $doortypes; ?> </p>
							<p><span class="intopic">ขนาด :</span> <?php echo $d_width.' x '.$d_high?> เมตร (กว้างสูง)</p>
							<p><span class="intopic">ชนิดฉนวนประตู  :  </span> <?php echo $foams." ".$foaminch; ?> นิ้ว</p>
							<?php if($doortype == 1) { ?>
								<p><span class="intopic"></span>- อุปกรณ์นิรภัยสำหรับติดที่บานประตูภายในห้องเย็นเพื่อกระทุ้งเปิดจากด้านใน แม้ด้านนอดถูกล็อค</p>
								<p><span class="intopic"></span>- กรอบบานประตูใชแผ่น "คัลเลอร์บอร์น" ครอบรอบบาน, วงกบประตูแผ่น"คัลเลอร์บอร์น" ครอบรอบด้าน</p>
							<?php } ?>
						</div>
						<div class="col2">
							<div style="width: 300px; height:280px; background: orange;">
								<?php if($doortype == 1) { ?>
									<img src="../content/images/quotation/008.jpg">
								<?php } else { ?>
									<img src="../content/images/quotation/slide.jpg">
								<?php } ?>
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
  
</div>
<input type="button" value="คำนวนราคางวด" id="btn-calngod">
</body>
</html>