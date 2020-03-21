<?php 
	require_once('../include/connect.php');
	/*require_once('../include/googletag.php');*/
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
	
</head>
<body>
<?php 
	
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
	$qtyhp = 1;
	/*$ord_coilh = trim($_POST['ord_coilh']);
	$ord_door = trim($_POST['ord_door']);
	$ord_control = trim($_POST['ord_control']);*/
	
	
	//$ord_qty = trim($_POST['ord_qty']);
	$foam = trim($_POST['foam']);
	$foaminch = trim($_POST['foaminch']);
	$comp_name = trim($_POST['comp_name']);
	$coil_name = trim($_POST['coil_name']);
	$comp_model = trim($_POST['comp_model']);
	$maxqty = trim($_POST['maxqty']);
	$hours = trim($_POST['hours']);
	
	$hp = trim($_POST['hp']);
	$qtyperday = trim($_POST['qtyperday']);
	$prods = trim($_POST['prods']);
	
	$tempbefore = trim($_POST['tempbefore']);
	$discount = trim($_POST['discount']);
	
	$doortype = trim($_POST['doortype']);
	$d_width = trim($_POST['d_width']);
	$d_high = trim($_POST['d_high']);
	
	$r_type = trim($_POST['r_type']);
	//https://www.w3schools.com/php/php_arrays.asp  array
	//https://stackoverflow.com/questions/45168714/push-data-into-array-with-for-loop
	//https://stackoverflow.com/questions/10982883/pushing-mysql-data-into-an-array
	
	/*$age = array("1"=>"COPELAND", "2"=>"BITZER", "3"=>"TECUMSEH");
	foreach($age as $x => $x_value) {
		if($x==2){
		echo "Key=" . $x . ", Value=" . $x_value;
		echo "<br>";
		}
	}*/
	
	
	
	
	if($r_type==1){
		$type_r = '';
		$sql_com = "SELECT * FROM tb_com_brand"; $result_com = mysql_query($sql_com); $num_com = mysql_num_rows($result_com);
		$sql_coil = "SELECT * FROM tb_cooling_brand"; $result_coil = mysql_query($sql_coil); $num_coil = mysql_num_rows($result_coil);
		
		for($i=0; $i<=$num_com-1; $i++){
			$row_com = mysql_fetch_array($result_com);
			$compr[] = array("id"=>$row_com[comp_id], "name"=>$row_com[com_brand], "type"=>$row_com[com_type], "country"=>$row_com[com_country], "img"=>$row_com[com_img]);
			
		}
		/*print_r($compr);
		echo '<br>'; 
		echo $compr[0][id].$compr[0][name];
		echo '<br>'; */
		
		for($i=0; $i<=$num_com-1; $i++){
			if($comp_name == $compr[$i][id]){
				$compressor_name =  $compr[$i][name].' ขนาด '.$hp.'HP ประเภท '.$compr[$i][type].' แบรนด์ '.$compr[$i][country];
				$com_img = $compr[$i][img];
			}
		}
		
		/*-----------------AIR COOLING -------------------------------------*/
		
		for($i=0; $i<=$num_coil-1; $i++){
			$row_coil = mysql_fetch_array($result_coil);
			$coilpr[] = array("id"=>$row_coil[cool_id], "name"=>$row_coil[cool_brand], "img"=>$row_coil[cool_img]);
			
		}
		
		for($i=0; $i<=$num_coil-1; $i++){
			if($coil_name == $coilpr[$i][id]){
				$coyen_name =  $coilpr[$i][name];
				$coyen_img = $coilpr[$i][img];
			}
		}
	  
	}else{ 
		$type_r = 'มือสอง';
	}
	
	
	
	
	
	
	
	
	$cute = ($r_width*$r_high*2) + ($r_lenght*$r_high*2) + ($r_width*$r_lenght*2);
	if($doortype==1){ $doortypes = 'ประตูบานสวิง '; $pratoo = 26000; } else { $doortypes = 'ประตูบานเลื่อน'; $pratoo = 37000; }
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
	
	
	$amount =  $ship_cost + $additional_price + $ord_price;
	$incvat = 0;
	
	if($ord_vat=='on'){
		/*$vat = 0.07; 
		$vats = $amount*$vat;*/
		$incvat = $amount-$discount;
		
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
	
	if($voltage == "220"){
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
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
					
					<?php if($r_type!=1) { ?>
					<tr border='1' align="center"> 
						<td align="left"><span class="text_emunder">ทำสีภำยนอกให้มีสีสันสดใสเหมือนของใหม่</span ></td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					<?php } ?>
					
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
					
					<?php if($r_type==1) { ?>
					<tr border='1' align="center">
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  ฮีตเตอร์สำหรับป้องกันน้ำแข็งเกาะชนิดใช้กับระบบไฟ 220 V (ไม่ต้องใช้หม้อแปลง) สำหรับติดตั้งรอบบานประตู</td>
						<td style="width: 1%" class="r">&nbsp;</td>
					</tr>
					<?php } ?>
					
					
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
							<td align="left">  - ทางบริษัทยินดีรับประกันแผ่นฉนวนห้องเย็นเป็นเวลา <?php if($r_type!=1){echo ' 6 เดือน ';}else{ echo ' 1 ปี ';} ?></td>
						</tr>
						
						<tr>
							<td align="left">   - ทางบริษัทยินดีรับประกันเครื่องทำความเย็นเป็นเวลา   <?php if($r_type!=1){echo ' 6 เดือน ';}else{ echo ' 1 ปี ';} ?> </td>
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
			
					<?php if($r_type==1){
							include('../include/inc_newroom.php'); 
							
					}else{
							include('../include/inc_sechand.php'); 
						}
					?>

			</div><!--end product_price-->
			
			
			
			<div id="amount" style="clear: both; margin-top: 5px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left"><span style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน </span> &nbsp;&nbsp; <?php if($r_type==1){ echo '(ภาษีหักที่จ่าย ได้เฉพาะค่าติดตั้งห้องเย็น)';} else { echo 'หากต้องการบิล VAT กรุณาแจ้งเพิ่มเติม'; }?></td>
						</tr>
						<tr>
							<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   50%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
							<td align="left" style="width: 35%"><span class="cal_ngo1"><?php echo number_format($round1, 2, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระก่อนจัดส่งอุปกรณ์ </td>
							<td align="left"><span class="cal_ngo2"><?php echo number_format($round2, 2, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 3</span>   20% ชำระเมื่อใช้งานได้เรียบร้อย </td>
							<td align="left"><span class="cal_ngo3"><?php echo number_format($round3, 2, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left">รายละเอียดเลขที่บัญชีสำหรับโอนเงิน </td>
							<td align="left"></td>
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
							<td align="left">  ส่งสินค้าภายใน 30 วันหลังจากได้รับมัดจำงวดที่ 1</td>
						</tr>
						
						<tr>
							<td align="left" style="color:red; font-size:17px; font-weight:bold;">  		ชำระเต็มจำนวนงวดแรก ฟรีค่าขนส่งและติดตั้ง
							</td>
						</tr>

						<tr>
							<td align="left" style="color:red; font-size:17px; font-weight:bold;"> 
								ชำระเพียง 213,000 บาท เท่านั้น
							</td>
						</tr>
						
					</table>
				</div>
			</div><!--end amount-->
			
			
			<div id="footer" style="clear: both;">
				<div style="width: 65%; float:left; margin-top: 10px;">
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			
			<?php include('../include/quotation_head.php'); ?>
			
			<div id="" style="height:5px;; clear:both">
				

			</div><!--end product_price-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<img src="../content/images/cool/standard.jpg" style="width:60%; margin-left:150px;">

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
	
	<?php if($r_type==1){ ?>
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
				<div style="float: right;">หน้า 4</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col3">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/<?php echo $com_img;?>.jpg">
						</div>
					</div>
					<div class="col4"><span class="topic">ชุดคอนเด็นซิ่งยูนิต ประกอบด้วย</span><br>
						<p><span class="intopic">คอมเพรสเซอร์ :</span> 
							<?php echo $compressor_name; ?>
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
						
						<p><span class="intopic">รุ่น  :</span> <?php echo $coyen_name?></p>
						<p><span class="intopic">ยี่ห้อ :</span> <?php echo $coyen_name?></p>
						<p><span class="intopic">จำนวนพัดลม/ขนาดใบพัด :</span> 2 x 350 มิลลิเมตร</p>
						<p><span class="intopic">ระยะส่งลม (Air Throw) :</span> อุปกรณ์ตัดต่อการทำงานของ คอมเพรสเซอร์ คอลย์ร้อน และ คอยล์เย็น</p>
						<p><span class="intopic">ระยะครีบ (ฟิน) :</span> 7 มิลลิเมตร</p>
						
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/<?php echo $coyen_img;?>.jpg">
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
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
						<p><span class="intopic">ท่อทองแดง : </span> Type L สำหรับส่งน้ำยาในระบบ รวมถึงข้อต่อต่างๆ ระยะเดินท่อน้ำยาไม่เกิน 10 เมตร</p>
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
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
						<p><span class="intopic"></span>- อุปกรณ์นิรภัยสำหรับติดที่บานประตูภายในห้องเย็นเพื่อกระทุ้งเปิดจากด้านใน แม้ด้านนอดถูกล็อค</p>
						<p><span class="intopic"></span>- กรอบบานประตูใชแผ่น "คัลเลอร์บอร์น" ครอบรอบบาน, วงกบประตูแผ่น"คัลเลอร์บอร์น" ครอบรอบด้าน</p>
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<?php if($doortype==1){ // swing ?>
								<img src="../content/images/quotation/008.jpg">
							<?php } else { // slide?>
								<img src="../content/images/quotation/slide.jpg">
							<?php }  ?>
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
	
	<?php } else { ?>
		
		<!--มือสอง-->
		
		
		
	
	
	
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
				<div style="float: right;">หน้า 4</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col3">
						<div style="width: 300px; height:280px; background: orange;">
								<img src="../content/images/quotation/copeland.jpg">
							
						</div>
					</div>
					<div class="col4"><span class="topic">คอมเพรสเซอร์ของใหม่ หัวใจหลักของห้องเย็น</span><br>
						<p><span class="intopic">คอมเพรสเซอร์ :</span> 
								ยี่ห้อ Copeland รุ่น ZB KQE   แบรนด์อเมริกา 
					
						</p>
						<p><span class="intopic">คุณสมบัติ : </span> เสียงเงียบ และประหยัดไฟฟ้า</p>
						<p><span class="intopic">ประเภท  : </span> Scroll</p>
					</div>
				</div> <!--end row-->
				
				<div class="row">
					<div class="col1">
						<span class="topic">คอยล์ร้อน Emerson มือสองประกอบใหม่</span><br>
						<p><span class="intopic">ยี่ห้อ :</span> Emerson</p>
						<p><span class="intopic">จำนวนพัดลม :</span> มอเตอร์ 1 ใบพัด</p>
						<p><span class="intopic">ใช้กับคอมเพรสเซอร์ :</span> ใช้ร่วมกับคอมเพรสเซอร์ขนาดไม่เกิน 4HP</p>
						<p><span class="intopic">อุณหภูมิที่ทำได้ :</span> ระบายความร้อนได้ดี ทำความเย็นได้ถึง -15 ถึง -18 องศา</p>
						<p><span class="intopic">ระบบป้องกัน :</span> มีโอเวอร์โหลดตัดการทำงานของมอเตอร์หากไฟฟ้าขัดข้อง</p>
						
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/emerson-sec.jpg">
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
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
					<div class="col3">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/kuba-gea.jpg">
						</div>
						
					</div>
					<div class="col4">
						
						<span class="topic">คอยล์เย็นมือสอง ผ่านการคัดเลือก</span><br>
						<p><span class="intopic">ยี่ห้อ :</span> KUBA</p>
						<p><span class="intopic">ระบบความทำความเย็น : </span> ทำความเย็นด้วยอากาศ</p>
						<p><span class="intopic">อุณหภูมิที่ทำได้ :</span> ช่วงอุณหภูมิ -16 องศา ถึง +20 องศา</p>
						<p><span class="intopic">มีระบบ Defrost :</span> ฮีทเตอร์ละลายน้ำแข็ง</p>
						<p><span class="intopic">ระบบฉีดน้ำยา :</span> อุุปกรณ์หัวฉีด Expandsion Valve</p>
					</div>
				</div> <!--end row-->
				
				<div class="row">
					<div class="col3">
						<span class="topic">ฮีทเตอร์สำหรับละลายน้ำแข็ง (Defrost)</span><br>
						<p><span class="intopic">ฮีทเตอร์คอยเย็น :</span> ป้องกันน้ำแข็งเกาะบริเวณฟินที่คอยล์เย็น</p>
						<p><span class="intopic">วาล์วปรับแรงดัน :</span> ฮีตเตอร์วาล์วปรับแรงดันป้องกันน้ำแข็งเกาะ สำหรับปรับแรงดันในและนอกห้องเย็นให้เท่ากันป้องกันรอยรั่วบริเวณต่อของแผ่นฉนวน </p>
						
					</div>
					<div class="col4">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/005.jpg">
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
				
				<span>ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
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
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/003.jpg">
						</div>
						
					</div>
					<div class="col4">
						
						<span class="topic">อุปกรณ์ควบคุมระบบน้ำยาห้องเย็นชุดใหม่</span><br>
						<p><span class="intopic">น้ำยาทำความเย็น :</span> ชนิด R22</p>
						<p><span class="intopic">ท่อทองแดง : </span> Type L สำหรับส่งน้ำยาในระบบ รวมถึงข้อต่อต่างๆ ระยะเดินท่อน้ำยาไม่เกิน 10 เมตร</p>
						<p><span class="intopic">ฉนวนหุ้มท่อ :</span> AeroFlex ป้องกันการเกิดหยดน้ำ และการรั่วซึมของน้ำยา </p>
						<p><span class="intopic">ตัวยึดท่อทองแดง :</span> ก้ามปูยึดท่อ</p>
						<p><span class="intopic">การเชื่อมท่อทองแดง :</span> ป้องกันการรั่วของท่อน้ำยา ตรวจสอบการตรวจรั่วได้มาตราฐาน</p>
					</div>
				</div> <!--end row-->
				
				<div class="row">
					<div class="col1">
						<span class="topic">อุปกรณ์ไฟฟ้าใหม่ ประกอบด้วย</span><br>
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
				</div>
				
				
				
				
				</div><!--end container-->
			<div class="conclude" style="clear: both; line-height:18px;"></div><!--end conclude -->
			<br><br><br>
			<div class="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div>
	
	
		
		
	<?php } ?>
    
</div>
<input type="button" value="คำนวนราคางวด" id="btn-calngod"> 
<span style="float:right;"><?php echo $total_result_t;?></span>
</body>
</html>