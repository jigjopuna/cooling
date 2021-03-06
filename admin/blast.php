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
	$labor = 50000;
	$jipata = 60000;
	
	
	
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
	$mach = trim($_POST['mach']);
	
	$corp = trim($_POST['corp']);
	
	//เลือกเครื่องราคา มีทั้งหมด 3 แบบ ถูก กลาง แพง
	$sql_airblast = mysql_fetch_array(mysql_query("SELECT * FROM tb_machine_set WHERE set_id = '$mach' AND set_type = 3"));
	
	$airblast_price   = $sql_airblast['set_price']; 
	$airblast_name    = $sql_airblast['set_name']; 
	$airblast_type    = $sql_airblast['set_type'];
	$airblast_coilyen = $sql_airblast['set_coilyen']; 
	$airblast_desc    = $sql_airblast['set_desc']; 
	
	$ord_vat = trim($_POST['ord_vat']);
	$gift = trim($_POST['gift']);
	$additional = trim($_POST['additional']);
	$additional_price = trim($_POST['additional_price']);
	
	$ord_coilh = trim($_POST['ord_coilh']);
	$ord_door = trim($_POST['ord_door']);
	$ord_control = trim($_POST['ord_control']);
	
	$intvat = trim($_POST['intvat']);
	$prods = trim($_POST['prods']);
	$qtyperday = trim($_POST['qtyperday']);
	$tempbefore = trim($_POST['tempbefore']);
	$hours = trim($_POST['hours']);
	$maxqty = trim($_POST['maxqty']);
	
	
	$cute = ($r_width*$r_high*2) + ($r_lenght*$r_high*2) + ($r_width*$r_lenght*2);
	if($foaminch==10){ 
		$cens = (25.2*2)/100; 
	} else if($foaminch==12) {
		$cens = (30.24*2)/100; 
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
	
	
	$costs = ($cute*$wall_price)+$pratoo+$airblast_price+$jipata+$labor;
	$rakakai = $costs*$profit;

	$prettylast = $rakakai+$ship_cost;
	$vats = $prettylast*0.07;
	
	$total_price = $prettylast+$vats;
	
	$ngod1 = $total_price*0.5;
	$ngod2 = $total_price*0.3;
	$ngod3 = $total_price*0.2;
	
	$sale_id = trim($_POST['sale_id']);
	
	$sales = mysql_fetch_array(mysql_query("SELECT e.e_id, e.e_name, e.e_lname, e.e_tel, e.e_email FROM tb_emp e WHERE e_id = '$sale_id'"));
	$sale_name = $sales['e_name'];
	$sale_lname = $sales['e_lname'];
	$sale_tel = $sales['e_tel'];
	$sale_email = $sales['e_email'];

	
	
	if($hp==3){
		$copeland=21;
	}else if($hp==4){
		$copeland=29;
	}else if($hp==5){
		$copeland=38;
	}else if($hp==6){
		$copeland=45;
	}else if($hp==7){
		$copeland=48;
	}else if($hp==8){
		$copeland=58;
	}
	 
	
	/*echo 'cute : '.$cute.'<br>';
	echo 'wall_price : '.$wall_price.'<br>';
	echo 'basic_price : '.$basic_price.'<br>';
	echo 'jipata : '.$jipata.'<br>';
	echo 'kumrai : '.$kumrai.'<br>';
	echo 'prettylast : '.$prettylast.'<br>';
	echo 'total_price : '.$total_price.'<br>';*/
	
	

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
	
	
	if($voltage == 220){
		$firefa = "Single Phase 220V";
	}else{
		$firefa = "3 Phase 380V";
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
	echo 'ord_control : '.$ord_control.'<br>';
	
	*/
	
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
				
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
				
				<?php
						if($corp == 2)
							include ('../include/quotation_head.php');
						else 
							include ('../include/quotation_head_cpn.php');
				?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็น</td>
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
							<td align="left">  - ทางบริษัทยินดีรับประกันแผ่นฉนวนห้องเย็นเป็นเวลา  1 ปี </td>
						</tr>
						
						<tr>
							<td align="left">   - ทางบริษัทยินดีรับประกันเครื่องทำความเย็นเป็นเวลา  1 ปี</td>
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
				
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
			
			<?php
					if($corp == 2)
						include ('../include/quotation_head.php');
					else 
						include ('../include/quotation_head_cpn.php');
			?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องแอร์บลาสฟรีส</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 68%" align="left">Air Blast Freeze ติดตั้งหน้างาน ปริมาณแผ่นฉนวน (<?php echo $cute; ?>) ตารางเมตร</td>
						<td style="width: 32%" class="b l" align="center" colspan="4"><strong>ขนาดห้องเย็น (กว้าง x ยาว x สูง) เมตร</strong></td>
						<!--<td colspan="2" style="width: 13%;" class="rlb">กว้าง  (เมตร)</td>
						<td style="width: 13%" class="br">ยาว   (เมตร)</td>
						<td style="width: 13%" class="b">สูง  (เมตร)</td>-->
					</tr>
					
					<tr align="center">
						<td align="left"><span style="font-size:17px; font-weight:bold; text-decoration: underline;"> อุณหภูมิในห้องเย็น</span> <span style="color:red; font-size:18px; font-weight:bold;"><?php echo $ord_temp; ?>C<Sup>o</Sup> </span>  แช่<?php echo $prods; ?> สินค้าเข้าต่อรอบ <?php echo $qtyperday; ?> kg</td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายนอก <?php echo $r_width;?> x <?php echo $r_lenght;?> x <?php echo $r_high;?></td>
					</tr>
					
					<tr align="center">
						<td align="left">- อุณหภูมิก่อนเข้า <?php echo $tempbefore; ?>C<Sup>o</Sup> อุณหภูมิห้องที่ต้องการ <?php echo $ord_temp; ?>C<Sup>o</Sup></td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายใน <span style="font-size:17px; font-weight:bold; color:red; text-decoration:underline;"><?php echo number_format($r_width-$cens, 2, '.', ',');?> x <?php echo number_format($r_lenght-$cens, 2, '.', ',') ;?> x <?php echo number_format($r_high-$cens, 2, '.', ',');?></span></td>
					</tr>
					
					<tr align="center">
						<td align="left">- ลดอุณหภูมิจาก  <?php echo $tempbefore; ?>C<Sup>o</Sup> ถึง  <?php echo $ord_temp; ?>C<Sup>o</Sup> ปริมาณ <?php echo $qtyperday; ?>kg ใช้เวลา <?php echo $hours; ?> ชม.</td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ฉนวน <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l" >Description </td>
						<td colspan="2" class="l" style="width: 80px;">QTY</td>
						<td class="l" style="width: 150px;">Unit Price</td>
						<td class="l" style="width: 150px;">Amount</td>
					</tr>
						
					<tr class="highs" style="">
						<td class="l">1. ชุด Condensing <?php echo $airblast_name;?></td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"><?php echo number_format($rakakai, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($rakakai, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - Reveiver, Oil Seperator, Accumulator, Hi-Lo & Oil Gauges,  Sight Glass</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - Hi-Lo & Oil Switch, Check Valve, Solinoid Valve, Drier, Service Valves</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
			
					<tr class="highs" style="">
						<td class="l"> 2. ชุดคอล์ยเย็น  <?php echo $airblast_coilyen;?></td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">3. ผนังห้องเย็น โฟม <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong> ensity 38-40 kg/m3 เหล็ก BHP 0.45 เมตร </td>
						<td colspan="2" class="l" align="center">1 ห้อง</td>
						<td class="l" align="right"><?php //echo number_format($coilyenprice, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php //echo number_format($coilyenprice, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - 2CB/<?php echo $foams;?> ผิวเรียบ พร้อมอุปกรณ์ติดตั้ง</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - <?php echo $doortypes; ?> ขนาด <strong><u><?php echo $d_width.' x '.$d_high?> เมตร</u></strong>  กว้าง สูง</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<?php if($floor1==1){ ?>
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - พื้นอลูมิเนียมลายกันลื่น</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<?php } ?>
					
					<tr class="highs" style="">
						<td class="l">4. Digital Control Box <strong><u><?php echo $firefa;?> </u></strong> </td>
						<td colspan="2" class="l" align="center">1 BOX</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - CAREL Control, Phase Protection, Magnetic, Overload  </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - พร้อมระบบความปลอดภัยทางไฟฟ้า</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">5. ระบบ <strong><u>IoT</u></strong> ตรวจสอบการทำงานของห้องเย็น แบบออนไลน์  24 ชั่งโมง</td>
						<td colspan="2" class="l" align="center">1 BOX</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - และแจ้งเตือนหากห้องเย็นมีปัญหาผ่าน <strong><u>สมาร์ทโฟน โทรศัพท์มือถือ</u></strong></td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ป้องกันสินค้าในห้องเย็นเสียหาย</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งสถานะการทำงานของ <strong><u>คอมเพรสเซอร์</u></strong> แบบ Real Time </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งสถานะการทำงานของ <strong><u>คอยล์เย็น</u></strong> แบบ Real Time </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งสถานะการทำงานของ <strong><u>ฮีทเตอร์</u></strong> แบบ Real Time</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งสถานะการตัดกระแสไฟฟ้าของ Over Load คอมเพรสเซอร์แบบ Real Time</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งสถานะการตัดกระแสไฟฟ้าของ Over Load คอยล์เย็นแบบ Real Time</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งสถานะแรงดัน ในระบบทำความเย็น แบบ Real Time</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l"> 6. ค่าติดตั้งห้องเย็นและเครื่องทำความเย็น</td>
						<td colspan="2" class="l" align="center">1 JOB</td>
						<td class="l" align="center"><?php if($ship_cost == 0) echo ''; ?></td>
						<td class="l" align="right"><?php if($ship_cost != 0) echo number_format($ship_cost, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l"> 7. ค่าขนส่งวัสดุอุปกรณ์ห้องเย็น และเครื่องทำความเย็น</td>
						<td colspan="2" class="l" align="center">1 JOB</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"> 20,000.00 </td>
					</tr>
					
					
					<?php if($gift != '') { ?>
						<tr class="highs" style="">
							<td class="l">7. <?php echo $gift;?></td>
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
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมด</td>
						<td class="t l" align="right"><?php echo number_format($prettylast, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ภาษีมูลค่าเพิ่ม</td>
						<td class="rt l" align="right"><?php echo number_format($vats, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ  <?php if($intvat=='on') echo '(Int VAT 7%)';?></td>
						<td class="rt l" align="right" id="totolprice"><?php echo number_format($total_price, 2, '.', ',');?> </td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			
			
			
			
			
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
				
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
			
			<?php
					if($corp == 2)
						include ('../include/quotation_head.php');
					else 
						include ('../include/quotation_head_cpn.php');
			?>
			
			<div id="product_price" style="margin-top:200x; clear:both">
				<img src="../content/images/cool/speed300.jpg" style="width:60%; margin-left:150px;">

			</div><!--end product_price-->
			
			
			<div id="amount" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน</td>
						</tr>
						<tr>
							<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   50%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
							<td align="left" style="width: 35%"><span class="cal_ngo1"><?php echo number_format($ngod1, 0, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระเมื่อจัดส่งอุปกรณ์ </td>
							<td align="left"><span class="cal_ngo2"><?php echo number_format($ngod2, 0, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 3</span>   20% ชำระเมื่อใช้งานได้เรียบร้อย </td>
							<td align="left"><span class="cal_ngo3"><?php echo number_format($ngod3, 0, '.', ',');?></span> บาท</td>
						</tr>
						
						<?php
						if($corp == 2) { 
							
					?>
						<tr>
							<td colspan="2" align="left">บัญชีธนาคารกสิกรไทย (กระแสรายวัน)</td>
							<tr>
								<td colspan="2" align="left"> หจก. ท็อปคูลลิ่ง  เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;"> 047-8-18623-1</span></td>
							</tr>
						</tr>
					<?php } else { ?>
						
						<tr>
							<td colspan="2" align="left">บัญชีธนาคารกรุงเทพ(สะสมทรัพย์)</td>
							<tr>
								<td colspan="2" align="left">  บจ.ซีพีเอ็น888  เลขที่บัญชี  <span style="text-decoration: underline; font-weight: bold;"> 520-0-45057-4</span></td>
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
							<td align="left">  ส่งสินค้าและติดตั้งภายใน 20 วันหลังจากได้รับมัดจำงวดที่ 1</td>
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
				
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
				
				<?php
						if($corp == 2)
							include ('../include/quotation_head.php');
						else 
							include ('../include/quotation_head_cpn.php');
				?>
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 4</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col3">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/002.jpg">
						</div>
					</div>
					<div class="col4"><span class="topic">ชุดคอนเด็นซิ่งยูนิต ประกอบด้วย</span><br>
						<p><span class="intopic">คอมเพรสเซอร์ :</span> Copeland <?php echo $hp;?>HP รุ่น ZB <?php echo $copeland;?> KQE 3 Phase ประเภท Scroll</p>
						<p><span class="intopic">ชุดคอยล์ร้อน :</span> XMK ระบายความร้อนด้วยอากาศ 2 พัดลม</p>
						<p><span class="intopic">ไฮ-โล เพรสเชอร์ :</span> อุปกรณ์วัดระดับแรงดันน้ำยา</p>
						<p><span class="intopic">รีซีฟเวอร์และวาล์วนิรภัย :</span></p>
						<p><span class="intopic">เช็ควาล์วและเซอร์วิสวาล์ว :</span> </p>
						<p><span class="intopic">ดรายเออร์ :</span> อุปกรณ์กรอกสิ่งสกปรกออกจากระบบทำความเย็น</p></div>
				</div> <!--end row-->
				
				<div class="row">
					<div class="col1">
						<span class="topic">คอยล์เย็นสำหรับเป่าลมเย็นในห้องเย็น</span><br>
						<p><span class="intopic">รุ่น  :</span> Q</p>
						<p><span class="intopic">ยี่ห้อ :</span> Q-Coil</p>
						<p><span class="intopic">จำนวนพัดลม/ขนาดใบพัด :</span> 2 x 350 มิลลิเมตร</p>
						<p><span class="intopic">ระยะส่งลม (Air Throw) :</span> อุปกรณ์ตัดต่อการทำงานของ คอมเพรสเซอร์ คอลย์ร้อน และ คอยล์เย็น</p>
						<p><span class="intopic">ระยะครีบ (ฟิน) :</span> 7 มิลลิเมตร</p>
						
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/004.jpg">
						</div>
					</div>
				</div> <!--end row-->
				
				
				
			</div><!--end container-->
			<div class="conclude" style="clear: both; line-height:18px;"></div><!--end conclude -->
			<br><br><br>
			<div class="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div> <!--end page 4 -->
	
	
	<div class="page">
        <div class="subpage">

            <div id="cover_header">
				
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
				
				<?php
						if($corp == 2)
							include ('../include/quotation_head.php');
						else 
							include ('../include/quotation_head_cpn.php');
				?>
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 5</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col1">
						<span class="topic">อุปกรณ์ไฟฟ้า ประกอบด้วย</span><br>
						<p><span class="intopic">เฟสโพรเทคชั่น :</span> WOP4 อุปกรณ์ป้องกันไฟฟ้าไม่ปกติ เช่น ไฟตก ไฟกระชาก ไฟขาดเฟส ไฟไม่บาลานซ์</p>
						<p><span class="intopic">เทอร์โมมิเตอร์ ดิจิตอล :</span> ยี่ห้อ CAREL มาตราฐานระบดับโลก</p>
						<p><span class="intopic">โอเวอร์โหลด :</span> อุปกรณ์ป้องกันกระแสไฟฟ้าเกินกำหนด</p>
						<p><span class="intopic">แม็กเนติก :</span> อุปกรณ์ตัดต่อการทำงานของ คอมเพรสเซอร์ คอลย์ร้อน และ คอยล์เย็น</p>
						<p><span class="intopic">ไฟแสดงสัญญาณ :</span> สถานะการทำงาน อุปกรณ์เครื่องต่างๆ ของห้องเย็น</p>
						<p><span class="intopic">สวิตซ์ :</span> เปิด-ปิดการทำงานของเครื่องทำความเย็น</p>
						<p><span class="intopic">ตู้ควบคุม :</span> ได้มาตารฐาน IP67 กันน้ำ กันฝุ่น</p>
						
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/0001.jpg">
						</div>
					</div>
				</div> <!--end row-->
				
				<div class="row">
					<div class="col3">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/003.jpg">
						</div>
						
					</div>
					<div class="col4">
						
						<span class="topic">อุปกรณ์ควบคุมระบบน้ำยาห้องเย็น</span><br>
						<p><span class="intopic">น้ำยาทำความเย็น :</span> ชนิด R404a</p>
						<p><span class="intopic">ท่อทองแดง : </span> Type L สำหรับส่งน้ำยาในระบบ รวมถึงข้อต่อต่างๆ</p>
						<p><span class="intopic">ฉนวนหุ้มท่อ :</span> AeroFlex ป้องกันการเกิดหยดน้ำ และการรั่วซึมของน้ำยา </p>
						<p><span class="intopic">ตัวยึดท่อทองแดง :</span> ก้ามปูยึดท่อ</p>
						<p><span class="intopic">การเชื่อมท่อทองแดง :</span> ป้องกันการรั่วของท่อน้ำยา ตรวจสอบการตรวจรั่วได้มาตราฐาน</p>
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
				
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
				
				<?php
						if($corp == 2)
							include ('../include/quotation_head.php');
						else 
							include ('../include/quotation_head_cpn.php');
				?>
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 6</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col3">
						<span class="topic">ฮีทเตอร์สำหรับละลายน้ำแข็ง (Defrost)</span><br>
						<p><span class="intopic">ฮีทเตอร์คอยเย็น :</span> ป้องกันน้ำแข็งเกาะบริเวณฟินที่คอยล์เย็น</p>
						<p><span class="intopic">ฮีทเตอร์ขอบประตู :</span> ป้องกันหยดน้ำคอนเด็นที่อาจเกิดขึ้นบริเวณประตู</p>
						<p><span class="intopic">วาล์วปรับแรงดัน :</span> ฮีตเตอร์วาล์วปรับแรงดันป้องกันน้ำแข็งเกาะ สำหรับปรับแรงดันในและนอกห้องเย็นให้เท่ากันป้องกันรอยรั่วบริเวณต่อของแผ่นฉนวน </p>
						<p><span class="intopic">Dimmer :</span> สำหรับปรับความร้อนของฮีทเตอร์ขอบประตู</p>
					</div>
					<div class="col4">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/005.jpg">
						</div>
						
					</div>
				 </div> <!--end row-->
				 
				<div class="row">
					<div class="col1">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/007.jpg">
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
				
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
				
				<?php
						if($corp == 2)
							include ('../include/quotation_head.php');
						else 
							include ('../include/quotation_head_cpn.php');
				?>
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 6</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				
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
<span style="float:right;"><?php echo $total_result_t;?></span>

<div id="cute" style="display: none;"><?php echo $cute;?></div>
<div id="wall_price" style="display: none;"><?php echo $wall_price; ?></div>
<div id="airblast_price" style="display: none;"><?php echo $airblast_price;?></div>
<div id="jipata" style="display: none;"><?php echo $jipata;?></div>
<div id="costs" style="display: none;"><?php echo $costs;?></div>
<div id="rakakai" style="display: none;"><?php echo $rakakai;?></div>
<div id="prettylast" style="display: none;"><?php echo $prettylast?></div>
<div id="total_price" style="display: none;"><?php echo $total_price?></div>
<div id="profit" style="display: none;"><?php echo $profit?></div>
<div id="pratoo" style="display: none;"><?php echo $pratoo?></div>

<div style="display: none;">
	<?php 
		echo 'ตารางเมตร : '. $cute.'<br>';
		echo 'ราคาโฟม : '. $wall_price.'<br>';
		echo 'ราคาโฟมทั้งหมด : '. $cute*$wall_price.'<br>';
		echo 'ราคาคอนเดนซิ่ง คอยล์เย็น ตู้ไฟ: '. $airblast_price.'<br>';
		echo 'ประตู : '. $pratoo.'<br>';
		echo 'จิปาถุะ : '. $jipata.'<br>';
		echo 'ค่าแรงติดตั้ง : '. $labor.'<br>';
		echo 'ราคาทุนไม่รวมกำไร : '. $costs.'<br>';
		echo 'ราคาทุน : '. $rakakai.'<br>';
		echo 'ราคา + แรง + ส่ง : '. $prettylast.'<br>';
		echo 'VAT : '. $vats.'<br>';
		echo 'ราคาขายสุดท้าย : '. $total_price.'<br>';
		echo 'กำไร % : '. $profit.'<br>';
	?>
</div>
</body>
</html>