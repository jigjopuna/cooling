<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />
	<link rel="shortcut icon" href="content/images/favicon.png">
	<title>ใบเสนอราคาห้องเย็น Topcooling</title>
	<link rel="stylesheet" href="../css/quotation.css">
	<style>
		.text_strong { font-weight: bold; }
		.text_emunder { text-decoration:underline; font-weight: bold; }
	</style>
</head>
<body>
<?php 
	require_once('../include/connect.php');
	require_once('../include/googletag.php');
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	$thatdate = $date."/".$nMonth."/".$year;
	
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
	$r_width = trim($_POST['r_width']);
	$r_lenght = trim($_POST['r_lenght']);
	$r_high = trim($_POST['r_high']);
	$ord_color = trim($_POST['ord_color']);
	$ord_vat = trim($_POST['ord_vat']);
	$gift = trim($_POST['gift']);
	$additional = trim($_POST['additional']);
	$additional_price = trim($_POST['additional_price']);
	$ord_price = trim($_POST['ord_price']);
	$ord_coilh = trim($_POST['ord_coilh']);
	$ord_door = trim($_POST['ord_door']);
	$ord_control = trim($_POST['ord_control']);
	$r_type = trim($_POST['r_type']);
	if($r_type==1){$type_r = '';}else{ $type_r = 'มือสอง';}
	
	//$ord_qty = trim($_POST['ord_qty']);
	
	$amount =  $ship_cost + $additional_price + $ord_price;
	
	 $incvat = 0;
	
	
	
	if($ord_vat=='on'){
		$vat = 0.07; //100,000*0.7
		$vats = $amount*$vat;
		$incvat = $amount+$vats;
		
		$round1 = $incvat*0.5;
		$round2 = $incvat*0.3;
		$round3 = $incvat*0.2;
		
	}else{
		$round1 = $amount*0.5;
		$round2 = $amount*0.3;
		$round3 = $amount*0.2;
		$incvat = $amount;
	}
	
	/*echo 'amount : '.$amount.'<br>'; 
	echo 'vat : '.$vat.'<br>'; 
	echo 'vats : '.$vats.'<br>'; 
	echo 'incvat : '.$incvat.'<br>'; */

	
	
	
	if($ord_coilh==2){ 
		$coilh = ' ข้างซ้าย'; 
	}else if($ord_coilh==3){ 
		$coilh = ' ข้างขวา'; 
	}else if($ord_coilh==4){ 
		$coilh = ' ข้างหลัง';
	}else if($ord_coilh==5){ 
		$coilh = ' ข้างบน';
	}
							
					
							
							
	if($ord_door==1){ 
		$door = ' ข้างหน้า'; 
	}else if($ord_door==2){ 
		$door = ' ข้างซ้าย'; 
	}else if($ord_door==3){ 
		$door = ' ข้างขวา';
	}
	
	if($ord_control==1){ 
		$control = ' ข้างหน้า'; 
	}else if($ord_control==2){ 
		$control = ' ข้างซ้าย'; 
	}else if($ord_control==3){ 
		$control = ' ข้างขวา';
	}
	
	
	//echo 'cust_name : '.$row['qcust_name'].'<br>'; qcust_name	qcust_addr	qcust_prov
	/*echo 'ord_temp : '.$ord_temp.'<br>';
	echo 'date_pay : '.$date_pay.'<br>';
	echo 'ship_cost : '.$ship_cost.'<br>';
	echo 'voltage : '.$voltage.'<br>';
	echo 'r_width : '.$r_width.'<br>';
	echo 'r_lenght : '.$r_lenght.'<br>';
	echo 'r_high : '.$r_high.'<br>';
	echo 'ord_vat : '.$ord_vat.'<br>';
	echo 'gift : '.$gift.'<br>';
	echo 'additional : '.$additional.'<br>';
	echo 'additional_price : '.$additional_price.'<br>';
	echo 'ord_price : '.$ord_price.'<br>';
	echo 'ord_coilh : '.$ord_coilh.'<br>';
	echo 'ord_door : '.$ord_door.'<br>';
	echo 'ord_control : '.$ord_control.'<br>';*/
	
	$sql_log = "INSERT INTO tb_quotation_log SET 
				qou_cust = '$cust_id', 
				qou_temp = '$ord_temp', 
				qou_width = '$r_width', 
				qou_length = '$r_lenght', 
				qou_high = '$r_high', 
				qou_shipcost = '$ship_cost', 
				qou_color = '$ord_door',  
				qou_gift = '$gift', 
				qou_voltage = '$voltage',				
				qou_coilh = '$ord_coilh', 
				qou_door = '$ord_door', 
				qou_control = '$ord_control', 
				qou_added = '$additional', 
				qou_added_price = '$additional_price', 
				qou_price = '$ord_price',  
				qou_date = now()";
	$result_log = mysql_query($sql_log);	
	
?>

</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็นสำเร็จรูป<?php echo $type_r;?></td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td align="left">โครงสร้างของแผ่นฉนวนสำเร็จรูปป้องกันความร้อน (ได้มาตราฐาน ISO 9001)</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left"> &nbsp;&nbsp;&nbsp; -  ผิวหน้าวัสดุ "คัลเลอร์บอนด์" มาตรฐาน <span class="text_strong"> PREPAINTED GALVANIZED STEEL SHEET ZINC COATING 275g/m2. เคลือบด้วยสี POLYESTER  FOOD GRADE, ANTIBACTERIAL 25/5 MICRONS  เหล็กหนา 0.45 มม. (รวมสี)</span></td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					

					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;- ฉนวนไส้กลางสำหรับเป็นแผ่นฉนวนป้องกันความร้อนใช้ " <span class="text_strong">Polyurethane  Foam</span >  " </td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชนิดพิเศษ ประเภทไม่ลามไฟ และปราศจากสาร ซีเอฟซี</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center"> 
						<td align="left"><span class="text_emunder">ทำสีภำยนอกให้มีสีสันสดใสเหมือนของใหม่</span ></td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text_emunder">วัสดุและอุปกรณ์สำหรับใช้ประกอบติดตั้ง</span ></td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  อลูมิเนียมหน้าตัดต่างๆ ชนิดชุบด้วยอโนไดส์ สำหรับเป็นตัวเข้าลิ้น และมอบปิดรอยต่อส่วนต่างๆ ของห้องเย็น</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- วัสดุกันรั่วกันความชื้น "บูทิวมาสติก" สำหรับใช้ฉีดเชื่อมรอยต่อของฉนวน</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  วัสดุกันรั่วกันความชื้น  "ซิลิโคน"  นำเข้าจากต่างประเทศ  สำหรับใช้ฉีดเชื่อมรอยต่อของ  แผ่นฉนวน</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-   รีเวทสำหรับยึดแผ่นฉนวนกับอลูมิเนียม</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  เพรสเชอร์รีลิฟพอร์ท "วาล์ว" สำหรับปรับแรงดันของอากาศภายในห้องเย็น ระบบละลายน้ำแข็งด้วย</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; แรงดันของอากาศเมื่อเปิดใช้วาล์ว 0.029 ปอนด์ / ตร. นิ้ว</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text_emunder">ระบบประตูบานสวิงเปิด</span></td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  บานประตูใช้แผ่นฉนวนสำเร็จรูป </td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  กรอบบานประตูใช้แผ่น "คัลเลอร์บอร์น" ครอบรอบบาน, วงกบประตูแผ่น"คัลเลอร์บอร์น" ครอบรอบด้าน </td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  ฮีตเตอร์สำหรับป้องกันน้ำแข็งเกาะชนิดใช้กับระบบไฟ 220 V (ไม่ต้องใช้หม้อแปลง) สำหรับติดตั้งรอบบานประตู</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  อุปกรณ์นิรภัยสำหรับติดที่บานประตูภายในห้องเย็นเพื่อกระทุ้งเปิดจากด้านใน แม้ด้านนอกถูกล็อค</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- มือจับประตูแบบงัดเปิดจากด้านนอก เพื่อให้สะดวกในการใช้งาน</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text_emunder">ม่านพลาสติก</span></td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  ม่านพลาสติกชนิดใส นำเข้าจากต่างประเทศ</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  อุปกรณ์แขวนยึดรางม่านทำจากสแตนเลสครบชุด</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					
					
				</table>

			</div><!--end product_price-->
			
			<div id="condition" style="clear: both; margin-top: 20px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;">เงื่อนไขการรับประกัน</td>
						</tr>
						<tr>
							<td align="left">  - ทางบริษัทยินดีรับประกันแผ่นฉนวนห้องเย็นเป็นเวลา  6  เดือน </td>
						</tr>
						
						<tr>
							<td align="left">   - ทางบริษัทยินดีรับประกันเครื่องทำความเย็นเป็นเวลา   6 เดือน </td>
						</tr>
						
						<tr>
							<td align="left"> (การรับประกันไม่รวมความเสียหายที่เกิดจากผู้ใช้งาน และภัยธรรมชาติ ) </td>
						</tr>

					</table>
				</div><br>
				<div style="width: 50%; float:left; margin-top: -17px;">
					
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;">ราคาที่เสนอไม่รวมรายการดังนี้ </td>
						</tr>
						<tr>
							<td align="left">  - งานเพิ่มเติมจากแบบและ Quotation  </td>
						</tr>
						
						<tr>
							<td align="left">   - งานเมนไฟฟ้ามายังห้องเย็น ของบริษัท และไฟที่ใช้ในการติดตั้ง  </td>
						</tr>
						
						<tr>
							<td align="left"> - งานคอนกรีตภายในและภานนอกของห้องเย็นทั้งหมด </td>
						</tr>
						
						<tr>
							<td align="left">   - และรายการอื่นๆ ที่มิได้ระบุไว้ข้างต้น </td>
						</tr>

					</table>
				</div>
			</div><!--end condition-->
			
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
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็นสำเร็จรูป<?php echo $type_r;?></td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอห้อง<?php echo $type_r;?></td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง  (เมตร)</td>
						<td style="width: 13%" class="br">ยาว   (เมตร)</td>
						<td style="width: 13%" class="b">สูง  (เมตร)</td> 
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP  <?php echo $ord_temp; ?>C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width; ?></td>
						<td class="r"></td>
						<td><?php echo $r_lenght; ?></td>
						<td class="l"><?php echo $r_high; ?> </td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">1. ราคาห้องเย็นตามขนาดและรายการข้างต้น</td>
						<td colspan="2" class="l" align="center">1</td>
						<td class="l" align="center"><?php echo number_format($ord_price, 0, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($ord_price, 2, '.', ','); ?></td> 
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ระบบไฟฟ้า <?php echo $voltage?> V.</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - คอมเพรสเซอร์ของใหม่</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l">2. ค่าจัดส่งสินค้า</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"><?php if($ship_cost == 0) echo 'ฟรี'; ?></td>
						<td class="l" align="right"><?php if($ship_cost != 0) echo number_format($ship_cost, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">3. ระบบ IOT สำหรับตรวจสอบอุณหภูมิห้องเย็น แบบออนไลน์  24 ชั่งโมง</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<?php if($gift != '') { ?>
						<tr class="highs" style="">
							<td class="l">4.  <?php echo $gift;?></td>
							<td colspan="2" class="l"></td>
							<td class="l" align="center"></td>
							<td class="l" align="right"></td>
						</tr>
					<?php } ?>
					
					<?php if($additional  != '') { ?>
						<tr class="highs" style="">
							<td class="l" > <?php if($gift == ''){ echo '4. ' ; }  echo $additional;?></td>
							<td colspan="2" align="center" class="l">1</td>
							<td class="l" align="center"><?php echo number_format($additional_price, 0, '.', ',');?></td>
							<td class="l" align="right"><?php echo number_format($additional_price, 2, '.', ',');?></td>
						</tr>
					<?php } ?>
					
					<tr class="highs" style="">
						<td class="l"><span style="text-decoration: underline;">ตำแหน่ง</span> ประตู : <?php echo $door; ?>, ตู้คอนโทรล : <?php echo $control; ?>, คอล์ยร้อน : <?php echo $coilh; ?></td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l"><span style="text-decoration: underline;">สีขอบเหล็กห้องเย็น</span> : <?php echo $ord_color; ?></td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					
					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($amount, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format($vats, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right"><?php echo number_format($incvat, 2, '.', ',');?> </td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			
			
			<div id="amount" style="clear: both; margin-top: 20px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน</td>
						</tr>
						<tr>
							<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   50%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
							<td align="left" style="width: 35%"><?php echo number_format($round1, 0, '.', ',');?> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระเมื่อจัดส่งอุปกรณ์ </td>
							<td align="left"><?php echo number_format($round2, 0, '.', ',');?> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 3</span>   20% ชำระเมื่อใช้งานได้เรียบร้อย </td>
							<td align="left"><?php echo number_format($round3, 0, '.', ',');?> บาท</td>
						</tr>
						
						<tr>
							<td align="left">รายละเอียดเลขที่บัญชีสำหรับโอนเงิน </td>
							<td align="left"></td>
						</tr>
						<tr>
							<td align="left">บัญชีธนาคารกสิกรไทย (ออมทรัพย์)</td>
							<td align="left"></td>
							<tr>
							<td colspan="2" align="left"> ชูเกียรติ เทียนอำไพ   เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;">855-2-05499-8</span></td>
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
							<td align="left">  ส่งสินค้าภายใน 30 วันหลังจากได้รับมัดจำงวดที่ 1</td>
						</tr>
					</table>
				</div>
			</div><!--end amount-->
			
			
			<div id="footer" style="clear: both;">
				<div style="width: 65%; float:left; margin-top: 50px;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left; margin-top: 50px;">
					
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
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<img src="../content/images/cool/standard.jpg" style="width:60%;">

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
				
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div> <!--end page-->
    
</div>
<span style="float:right;"><?php echo $total_result_t;?></span>
</body>
</html>