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
		$("#btn-addroom").click(function(){ $('#addpage').css("display","block"); $('.amounts').css("display","none"); });
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
	/*require_once('../include/googletag.php');*/
	
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
	$hp = trim($_POST['hp']);
	$discount = trim($_POST['discount']);
	
	
	$comp_name = trim($_POST['comp_name']);
	
	//เลือกเครื่องราคา มีทั้งหมด 3 แบบ ถูก กลาง แพง
	$sql_basic = mysql_fetch_array(mysql_query("SELECT * FROM tb_machine_set WHERE set_hp = '$hp' AND set_type = 1"));
	$basic_price = $sql_basic['set_price']; $basic_name = $sql_basic['set_name']; $basic_type = $sql_basic['set_type'];
	
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
	
	$hours = trim($_POST['hours']);
	$maxqty = trim($_POST['maxqty']);
	
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
	
	
	$realcost = ($cute*$wall_price)+$pratoo+($basic_price*$qtyhp);
	$kumrai = (($cute*$wall_price)+$pratoo+($basic_price*$qtyhp))*$profit;
	$pasee = (($cute*$wall_price)+$pratoo+($basic_price*$qtyhp))*$profit*1.07;
	
	/*echo 'ราคาต้นทุน realcost : '.$realcost.'<br>';
	echo 'ราคาต้นทุน+กำไร : '.$kumrai.'<br>';*/
	
	$befor_ship = $pasee+$jipata+$labor;
	$prettylast = $befor_ship+$ship_cost;
	$total_price = $prettylast-$discount;
	$incvat = $total_price;
	
	/*echo 'กำไร+จิปาถะ+ค่าแรง  : '.$befor_ship.'<br>';
	echo 'ราคารวมส่ง : '.$prettylast.'<br>';
	echo 'ราคาลด : '.$total_price.'<br>';
	echo 'ภาษีมูลค่าเพิ่ม : '.($total_price*0.07).'<br>';
	echo 'ราคาสุทธิ : '.$incvat.'<br>';*/
	
	$ngod1 = $incvat*0.5;
	$ngod2 = $incvat*0.3;
	$ngod3 = $incvat*0.2;
	/*$befor_ship = ($cute*$wall_price)+$pratoo+$basic_price+$jipata+$labor;
	$prettylast = ($cute*$wall_price)+$pratoo+$basic_price+$jipata+$labor+$ship_cost;
	$total_price = ($cute*$wall_price)+$pratoo+$basic_price+$jipata+$labor+$ship_cost-$discount;
	*/
	
	
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
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็น</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">ห้องเย็นประกอบเร็ว ติดตั้งหน้างาน ปริมาณแผ่นฉนวน (<?php echo $cute; ?>) ตารางเมตร</td>
						<td style="width: 40%" class="b l" align="center" colspan="4"><strong>ขนาดห้องเย็น (กว้าง x ยาว x สูง) เมตร</strong></td>
						<!--<td colspan="2" style="width: 13%;" class="rlb">กว้าง  (เมตร)</td>
						<td style="width: 13%" class="br">ยาว   (เมตร)</td>
						<td style="width: 13%" class="b">สูง  (เมตร)</td>-->
					</tr>
					
					<tr align="center">
						<td align="left"><span style="font-size:17px; font-weight:bold; text-decoration: underline;"> อุณหภูมิในห้องเย็น</span> <span style="color:red; font-size:18px; font-weight:bold;"><?php echo $ord_temp; ?>C<Sup>o</Sup></span>  แช่ <?php echo $prods; ?>ได้สูงสุด <?php echo $maxqty;?> ตัน</td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายนอก <?php echo $r_width;?> x <?php echo $r_lenght;?> x <?php echo $r_high;?></td>
					</tr>
					
					<tr align="center">
						<td align="left">- ห้องเย็นแช่ <?php echo $prods; ?> สินค้าเข้าต่อวัน <?php echo $qtyperday; ?> kg </td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายใน <?php echo number_format($r_width-$cens, 2, '.', ',');?> x <?php echo number_format($r_lenght-$cens, 2, '.', ',') ;?> x <?php echo number_format($r_high-$cens, 2, '.', ',');?></td>
					</tr>
					
					<tr align="center">
						<td align="left">- อุณหภูมิก่อนเข้า <?php echo $tempbefore; ?>C<Sup>o</Sup> อุณหภูมิห้องที่ต้องการ <?php echo $ord_temp; ?>C<Sup>o</Sup></td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ฉนวน <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong></td>
					</tr>
					
					<tr align="center">
						<td align="left">- ลดอุณหภูมิจาก  <?php echo $tempbefore; ?>C<Sup>o</Sup> ถึง  <?php echo $ord_temp; ?>C<Sup>o</Sup> ปริมาณ <?php echo $qtyperday; ?>kg ใช้เวลา <?php echo $hours; ?> ชม.</td>
						<td class="l"></td>
						<td class=""></td>
						<td></td>
						<td class=""></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
						
					<tr class="highs" style="">
						<td class="l">1. ชุด Condensing 
							
							<?php if($comp_name == 1) { ?>
								<strong><u> Copeland <span style="color:red; font-size:18px;"> <?php echo $hp;?>HP </span></u></strong>  รุ่น ZB <?php echo $copeland; ?> KQE
							<?php } else if($comp_name == 2 ) { ?>
								
								<strong><u>Bitzer <span style="color:red; font-size:18px;"> <?php echo $hp;?>HP </span></u></strong> 
									
							<?php } else { ?>
								
								<strong><u>Danfoss <span style="color:red; font-size:18px;"> <?php echo $hp;?>HP </span></u></strong> 
								
							<?php } ?>
							
							  
							
						</td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"><?php echo number_format($befor_ship, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($befor_ship, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l"> 2.  ชุดคอล์ยเย็น <strong><u>Q-Coil</u></strong>  <?php //echo $coilyen;?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">3. ผนังห้องเย็น โฟม <span style="font-weight:bold; text-decoration:underline; font-size:18px; color:red;"> <?php echo $foams." ".$foaminch; ?> นิ้ว</span> <span style="font-size: 12px;">ensity 38-40 kg/m3 เหล็ก BHP 0.45 เมตร</span> </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"><?php //echo number_format($coilyenprice, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php //echo number_format($coilyenprice, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - 2CB/<?php echo $foams;?> ผิวเรียบ พร้อมอุปกรณ์ติดตั้ง</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
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
						<td class="l">4. ระบบไฟฟ้า ควบคุมห้องเย็น <strong><u><?php echo $firefa;?> </u></strong> <span style="font-size:14px;">พร้อมระบบความปลอดภัย</span></td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">5. <?php echo $doortypes; ?> ขนาด <strong><u><?php echo $d_width.' x '.$d_high?> เมตร</u></strong>  กว้าง สูง</td>
						<td colspan="2" class="l" align="center">1 บาน</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">6. ระบบ IoT สำหรับตรวจสอบอุณหภูมิห้องเย็น แบบออนไลน์  24 ชั่งโมง</td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"><s>48,000.00</s></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งเตือนถ้าห้องเย็นมีปัญหาผ่านมือถือ ฟรีค่าบริการปีแรก 10,000 บาท</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  (ต้องมี Internet WiFi บริเวณห้องเย็น)</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l"> 7. ค่าติดตั้งและจัดส่งสินค้า</td>
						<td colspan="2" class="l" align="center">1 งาน</td>
						<td class="l" align="center"><?php if($ship_cost == 0) echo ''; ?></td>
						<td class="l" align="right"><?php if($ship_cost != 0) echo number_format($ship_cost, 2, '.', ','); ?></td>
					</tr>
					
					
					
					<?php if($gift != '') { ?>
						<tr class="highs" style="">
							<td class="l">5.  <?php echo $gift;?></td>
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
							<div style="width:100%">
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
						
						<td colspan="3" class="rl">ส่วนลด</td>
						<td class="rt l" align="right"><?php echo number_format($discount, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ  <?php if($intvat=='on') echo '(Inc VAT 7%)';?></td>
						<td class="rt l" align="right" id="totolprice"><?php echo number_format($incvat, 2, '.', ',');?> </td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			
			
			<div id="amount" class="amounts" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left"><span style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน </span> &nbsp;&nbsp; (ภาษีหักที่จ่าย ได้เฉพาะค่าติดตั้งห้องเย็น)</td>
						</tr>
						<tr>
							<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   50%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
							<td align="left" style="width: 35%"><span class="cal_ngo1"><?php echo number_format($ngod1, 0, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระก่อนจัดส่งอุปกรณ์ </td>
							<td align="left"><span class="cal_ngo2"><?php echo number_format($ngod2, 0, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 3</span>   20% ชำระเมื่อใช้งานได้เรียบร้อย </td>
							<td align="left"><span class="cal_ngo3"><?php echo number_format($ngod3, 0, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left">บัญชีธนาคารกสิกรไทย (กระแสรายวัน)</td>
							<td align="left"></td>
							<tr>
								<td colspan="2" align="left"> <!--ชูเกียรติ เทียนอำไพ--> หจก. ท็อปคูลลิ่ง  เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;"><!--855-2-05499-8--> 047-8-18623-1</span></td>
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
							<td align="left">  ส่งสินค้าและติดตั้งภายใน 30 วันหลังจากได้รับมัดจำงวดที่ 1</td>
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
				<div style="width: 35%; float:left; margin-top: 0px;">
					
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
	
	
	<div class="page" id="addpage" style="display:none;">
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
					<tbody><tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">สรุปรายการห้องเย็น 2 ห้อง</td>
					</tr>
					

					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
						
					
			
					
					<tr class="highs" style="">
						<!--<td class="l">1. ชุด Condensing <strong><u></u></strong> </td>-->
						<td class="l">1.  ห้องเย็นฟรีส -20C<sup>o</sup> <strong><u>ขนาด 2.4x2.4x2.4 เมตร</u></strong></td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right">259,745.00 </td>
					</tr>

					
					<tr class="highs" style="">
						<td class="l">2. ห้องเย็นฟรีส -20C<sup>o</sup> <strong><u>ขนาด 2.4x3.0x2.4 เมตร</u></strong></td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right">265,033.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">3. เพิ่มประตูบานสวืง ขนาด <strong><u> 0.9 x 2.0 เมตร</u></strong></td>
						<td colspan="2" class="l" align="center">1 บาน</td>
						<td class="l" align="right"></td>
						<td class="l" align="right">25,000.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
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
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ  <?php if($intvat=='on') echo '(Int VAT 7%)';?></td>
						<td class="rt l" align="right" id="totolprice"><?php echo number_format($incvat, 2, '.', ',');?> </td>
					</tr>
					
				
				
				</tbody></table>

			</div><!--end product_price-->
			
			
			
			<div id="amount_" style="clear: both; margin-top: 20px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tbody><tr>
							<td colspan="2" align="left"><span style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน </span> &nbsp;&nbsp; (ภาษีหักที่จ่าย ได้เฉพาะค่าติดตั้งห้องเย็น)</td>
						</tr>
						<tr>
							<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   50%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
							<td align="left" style="width: 35%"><span class="cal_ngo1">274,889.00</span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระเมื่อจัดส่งอุปกรณ์ </td>
							<td align="left"><span class="cal_ngo2">164,933.40</span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 3</span>   20% ชำระเมื่อใช้งานได้เรียบร้อย </td>
							<td align="left"><span class="cal_ngo3">109,955.60</span> บาท</td>
						</tr>
						
						<tr>
							<td align="left">รายละเอียดเลขที่บัญชีสำหรับโอนเงิน </td>
							<td align="left"></td>
						</tr>
						<tr>
							<td align="left">บัญชีธนาคารกสิกรไทย (กระแสรายวัน)</td>
							<td align="left"></td>
							</tr><tr>
								<td colspan="2" align="left"> <!--ชูเกียรติ เทียนอำไพ--> หจก. ท็อปคูลลิ่ง  เลขที่บัญชี <span style="text-decoration: underline; font-weight: bold;"><!--855-2-05499-8--> 047-8-18623-1</span></td>
							</tr>
						
					</tbody></table>
					
				</div><br>
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tbody><tr>
							<td align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> กำหนดยืนราคา</td>
						</tr>
						<tr>
							<td align="left">  ภายใน 20 วัน นับจากวันที่เสนอราคา</td>
						</tr>
						<tr>
							<td align="left">  ส่งสินค้าและติดตั้งภายใน 30 วันหลังจากได้รับมัดจำงวดที่ 1</td>
						</tr>
					</tbody></table>
				</div>
			</div><!--end amount-->
			
			
			<div id="footer" style="clear: both;">
				<div style="width: 65%; float:left; margin-top: 50px;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ 13/01/2562</span>
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
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
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
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
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
							<?php if($comp_name==1) { ?>
								<img src="../content/images/quotation/002.jpg">
							<? } else if($comp_name==2) { ?>
								<img src="../content/images/quotation/bitzer.jpg">
							<? } else { ?>
								<img src="../content/images/quotation/002.jpg">
							<? } ?>
						</div>
					</div>
					<div class="col4"><span class="topic">ชุดคอนเด็นซิ่งยูนิต ประกอบด้วย</span><br>
						<p><span class="intopic">คอมเพรสเซอร์ :</span> 
							<?php if($comp_name == 1 ) { ?>
								Copeland <?php echo $hp;?>HP รุ่น ZB <?php echo $copeland;?> KQE ประเภท Scroll แบรนด์อเมริกา <?php echo $firefa; ?>
							<? }else if($comp_name == 2 ){ ?>
								BITZER <?php echo $hp;?>HP ประเภท ลูกสูบ  แบรนด์เยอรมัน <?php echo $firefa; ?>
							<? }else { ?>
								DANFOSS <?php echo $hp;?>HP ประเภท Scroll แบรนด์อเมริกา <?php echo $firefa; ?>
							<? } ?>
						</p>
						<p><span class="intopic">ชุดคอยล์ร้อน :</span> ระบายความร้อนด้วยอากาศ 2 พัดลม</p>
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
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 084-013-7350 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
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
				<div style="float: right;">หน้า 7</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				
				<div class="row">
					<div class="col1">
						<span class="topic">ประตูห้องเย็น</span><br>
						<p><span class="intopic">ชนิดประตู : </span><?php echo $doortypes;?></p>
						<p><span class="intopic">ขนาด :</span> <?php echo $d_width.' x '.$d_high?> เมตร</p>
						<?php if($doortype==1){ // swing ?>
							<p><span class="intopic"></span>- อุปกรณ์นิรภัยสำหรับติดที่บานประตูภายในห้องเย็นเพื่อกระทุ้งเปิดจากด้านใน แม้ด้านนอดถูกล็อค</p>
						<?php } ?>
						
						<p><span class="intopic"></span>- กรอบบานประตูใชแผ่น "คัลเลอร์บอร์น" ครอบรอบบาน, วงกบประตูแผ่น"คัลเลอร์บอร์น" ครอบรอบด้าน</p>
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<div style="width: 300px; height:280px; background: orange;">
							<?php if($doortype==1){ // swing ?>
								<img src="../content/images/quotation/008.jpg">
							<?php } else { // slide?>
								<img src="../content/images/quotation/slide.jpg">
							<?php }  ?>
						</div>
						</div>
					</div>	
				</div> <!--end row-->
				
				
				<?php if($floor1==1) { ?>
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
				<?php } ?>
				
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
				
				
				<div class="row" style="padding-top:0px;">
					<div class="tew" style="padding: 20px;">
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
<input type="button" value="สรุปห้อง" id="btn-addroom">
<span style="float:right;"><?php echo $total_result_t;?></span>

<div id="cute" style="display: none;"><?php echo $cute;?></div>
<div id="wall_price" style="display: none;"><?php echo $wall_price; ?></div>
<div id="basic_price" style="display: none;"><?php echo $basic_price;?></div>
<div id="jipata" style="display: none;"><?php echo $jipata;?></div>
<div id="kumrai-sumprofit-nojipata-nolabor" style="display: none;"><?php echo $kumrai;?></div>
<div id="realcost-no-profit-nojipata-nolabor" style="display: none;"><?php echo $realcost;?></div>
<div id="befor_ship-sumlabor-sumjipatac-sumprofit-sumship" style="display: none;"><?php echo $prettylast?></div>
<div id="total_price" style="display: none;"><?php echo $total_price?></div>

</body>
</html>