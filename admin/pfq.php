<?php
   require_once('../include/connect.php');
   require_once('../include/thaibaht.php');
   //require_once('../savedb/cust_address.php');

    //1. receive data

    $temp_num = trim($_POST['temp_num']);
	$r_width = trim($_POST['r_width']);
	$r_length = trim($_POST['r_length']);
	$r_height = trim($_POST['r_height']);
	$varprofit  = trim($_POST['percentprofit']);
	$corp_addr  = trim($_POST['corp_addr']);
	
	$fomeadd =  trim($_POST['fomeadd']);
	$percentprofit = ($varprofit/100)+1;
	$vats = 7;
	
	//cust_id  
	
	$search_custname = trim($_POST['search_custname']);
	

	
	
	//ค่าแรง เครื่องรับค่ามา หน่วย และ ราคา
	$labormachineunit  = str_replace(",", "",trim($_POST['labormachineunit'])); 
	$labormachinepirce  = str_replace(",", "",trim($_POST['labormachinepirce']));
	
	//ค่าขนส่ง เครื่องรับค่ามา หน่วย และ ราคา
	$shipmachineunit  = str_replace(",", "",trim($_POST['shipmachineunit']));
	$shipmachineprice  = str_replace(",", "",trim($_POST['shipmachineprice']));
	
	
	/*-------------------------*/
	
	//ห้อง  
	//ค่าแรง ห้องรับค่ามา หน่วย และ ราคา
	$laborroomunit  = str_replace(",", "",trim($_POST['laborroomunit']));
	$laborroomprice  = str_replace(",", "",trim($_POST['laborroomprice']));
	
	//ค่าขนส่ง ห้องรับค่ามา หน่วย และ ราคา
	$shiproomunit  = str_replace(",", "",trim($_POST['shiproomunit']));
	$shiproomprice  = str_replace(",", "",trim($_POST['shiproomprice']));
	
	
	// ค่าแรงและค่าห้องรวม vat คูณหน่วยแล้ว
	/*lbmt = labor machine total */
	$lbmt = $labormachineunit*$labormachinepirce*$percentprofit;
	
	/*shmt = ship machine total */
	$shmt = $shipmachineunit*$shipmachineprice*$percentprofit;
	
	
	/*lbrt = labor room total */
	$lbrt = $laborroomunit*$laborroomprice*$percentprofit;
	
	/*shrt = ship room total */
	$shrt = $shiproomunit*$shiproomprice*$percentprofit;


	$m1  = trim($_POST['m1']);
	$m2  = trim($_POST['m2']);
	$m3  = trim($_POST['m3']);
	$m4  = trim($_POST['m4']);
	$m5  = trim($_POST['m5']);
	$m6  = trim($_POST['m6']);
	$m7  = trim($_POST['m7']);
	$m8  = trim($_POST['m8']);
	$m9  = trim($_POST['m9']);
	$m10  = trim($_POST['m10']);
	$m11 = trim($_POST['m11']);
	$m12  = trim($_POST['m12']);
	$m13 = trim($_POST['m13']);
	$m14  = trim($_POST['m14']);
	
	
	
	$m1q  = str_replace(",", "",trim($_POST['m1q']));
	$m2q  = str_replace(",", "",trim($_POST['m2q']));
	$m3q  = str_replace(",", "",trim($_POST['m3q']));
	$m4q  = str_replace(",", "",trim($_POST['m4q']));
	$m5q  = str_replace(",", "",trim($_POST['m5q']));
	$m6q  = str_replace(",", "",trim($_POST['m6q']));
	$m7q  = str_replace(",", "",trim($_POST['m7q']));
	$m8q  = str_replace(",", "",trim($_POST['m8q']));
	$m9q  = str_replace(",", "",trim($_POST['m9q']));
	$m10q  = str_replace(",", "",trim($_POST['m10q']));
	$m11q = str_replace(",", "",trim($_POST['m11q']));
	$m12q  = str_replace(",", "",trim($_POST['m12q']));
	
	$m1p  = str_replace(",", "",trim($_POST['m1p']));
	$m2p  = str_replace(",", "",trim($_POST['m2p']));
	$m3p  = str_replace(",", "",trim($_POST['m3p']));
	$m4p  = str_replace(",", "",trim($_POST['m4p']));
	$m5p  = str_replace(",", "",trim($_POST['m5p']));
	$m6p  = str_replace(",", "",trim($_POST['m6p']));
	$m7p  = str_replace(",", "",trim($_POST['m7p']));
	$m8p  = str_replace(",", "",trim($_POST['m8p']));
	$m9p  = str_replace(",", "",trim($_POST['m9p']));
	$m10p  = str_replace(",", "",trim($_POST['m10p']));
	$m11p = str_replace(",", "",trim($_POST['m11p']));
	$m12p  = str_replace(",", "",trim($_POST['m12p']));
	
	$r1  = $_POST['r1'];
	$r2  = $_POST['r2'];
	$r3  = $_POST['r3'];
	$r4  = $_POST['r4'];
	$r5  = $_POST['r5'];
	$r6  = $_POST['r6'];
	$r7  = $_POST['r7'];
	$r8  = $_POST['r8'];
	$r9  = $_POST['r9'];
	$r10  = $_POST['r10'];
	$r11  = $_POST['r11'];
	$r_pressure = $_POST['r_pressure'];

	
	$r1q  = str_replace(",", "",trim($_POST['r1q']));
	$r2q  = str_replace(",", "",trim($_POST['r2q']));
	$r3q  = str_replace(",", "",trim($_POST['r3q']));
	$r4q  = str_replace(",", "",trim($_POST['r4q']));
	$r5q  = str_replace(",", "",trim($_POST['r5q']));
	$r6q  = str_replace(",", "",trim($_POST['r6q']));
	$r7q  = str_replace(",", "",trim($_POST['r7q']));
	$r8q  = str_replace(",", "",trim($_POST['r8q']));
	$r9q  = str_replace(",", "",trim($_POST['r9q']));
	$r_pressureq = str_replace(",", "",trim($_POST['r_pressureq']));
	
	$r1p  = str_replace(",", "",trim($_POST['r1p']));
	$r2p  = str_replace(",", "",trim($_POST['r2p']));
	$r3p  = str_replace(",", "",trim($_POST['r3p']));
	$r4p  = str_replace(",", "",trim($_POST['r4p']));
	$r5p  = str_replace(",", "",trim($_POST['r5p']));
	$r6p  = str_replace(",", "",trim($_POST['r6p']));
	$r7p  = str_replace(",", "",trim($_POST['r7p']));
	$r8p  = str_replace(",", "",trim($_POST['r8p']));
	$r9p  = str_replace(",", "",trim($_POST['r9p']));
	$r_pressure_p  = str_replace(",", "",trim($_POST['r_pressure_p']));
	
	
	
	$mrmixu  = str_replace(",", "",trim($_POST['mrmixu']));
	
	$crmixu  = str_replace(",", "",trim($_POST['crmixu']));
	
	/*$laboru  = str_replace(",", "",trim($_POST['laboru']));
	$laborp  = str_replace(",", "",trim($_POST['laborp']));*/
	
	
	
	

	//บวกกำไรค่าแรง คิดเป็น % ก่อนที่จะไปคูณกับหน่วย
	//$laborprofit = $laborp*$percentprofit;
	
	//เอาค่าแรง ที่บวกกำไรแล้วมาคูณจำนวนหน่วย
	//$laborfinal = $laborprofit*$laboru;
	

	//$labort = $laboru*$laborp;
	
	//$shipu  = str_replace(",", "",trim($_POST['shipu']));
	//$shipp  = str_replace(",", "",trim($_POST['shipp']));  
 	//$shipt = $shipu*$shipp;
	
	//บวกกำไรค่าขนส่ง คิดเป็น % ก่อนที่จะไปคูณกับหน่วย
	//$shipprofit = $shipp*$percentprofit;  
	
	//เอาค่าขนส่งที่บวกกำไรแล้วมาคูณจำนวนหน่วย
	//$shipfinal = $shipprofit*$shipu;
	
	

	$timeperiod  = trim($_POST['timeperiod']);
	$temp_before  = trim($_POST['temp_before']);
	$qty  = trim($_POST['qty']);
	$totalcur  = trim($_POST['totalcur']);
	

	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	
	$thatdate = $date."/".$nMonth."/".$year;
	

	$m1t = $m1q*$m1p*$percentprofit;
	$m2t = $m2q*$m2p*$percentprofit;
	$m3t = $m3q*$m3p*$percentprofit;
	$m4t = $m4q*$m4p*$percentprofit;
	$m5t = $m5q*$m5p*$percentprofit;
	$m6t = $m6q*$m6p*$percentprofit;
	$m7t = $m7q*$m7p*$percentprofit;
	$m8t = $m8q*$m8p*$percentprofit;
	$m9t = $m9q*$m9p*$percentprofit;
	$m10t = $m10q*$m10p*$percentprofit;
	$m11t = $m11q*$m11p*$percentprofit;	
	$m12t = $m12q*$m12p*$percentprofit;
	$m_sum = $m1t + $m2t + $m3t + $m4t + $m5t + $m6t + $m7t+ $m8t + $m9t+ $m10t + $m11t + $m12t + $lbmt + $shmt;
	$m_vat = ($m_sum*$vats)/100;
	$m_total = $m_vat+$m_sum;

	

	/*
		กำไรคิดตามตารางเมตร ไม่ได้คิดจาก %
		(ต้นทุนผนัง (ตร.ม) + กำไร) x ตารางเมตรทั้งหมด
		($r1p + $fomeadd)*$r1q;
		
 	*/ 
	$r1t = ($r1p + $fomeadd)*$r1q;
	//$r1t = $r1q*$r1p*$percentprofit;
	$r2t = ($r2p + $fomeadd)*$r2q;
	//$r2t = $r2q*$r2p*$percentprofit;
	$r3t = $r3q*$r3p*$percentprofit;
	$r4t = $r4q*$r4p*$percentprofit;
	$r5t = $r5q*$r5p*$percentprofit;
	$r6t = $r6q*$r6p*$percentprofit;
	$r7t = $r7q*$r7p*$percentprofit;
	$r8t = $r8q*$r8p*$percentprofit;
	$r9t = $r9q*$r9p*$percentprofit;
	$rpressure_t = $r_pressureq*$r_pressure_p*$percentprofit;
	
	$r_sum = $r1t + $r2t + $r3t + $r4t + $r5t + $r6t + $rpressure_t + $r7t+ $r8t + $r9t + $lbrt + $shrt;
	$r_vat = ($r_sum*$vats)/100;
	$r_total = $r_vat+$r_sum;
	
	
	
	
	
	

	/*
		ค่าแรงจะมี  2 ส่วน คือ ค่าแรงในการประกอบเครื่อง และค่าแรงการสร้างห้อง
		ค่าขนส่งก็จะมี 2 เช่นเดียวกัน 
		
		วิธีการคิด 
	*/
	
	//$bftotal = $m_sum + $r_sum + $laborfinal + $shipfinal;
	//$vatbftotal = $m_vat + $r_vat + (($laborfinal*$vats)/100) + (($shipfinal*$vats)/100);
	
	//$bftotal = $m_sum + $r_sum + $shmt + $shrt + $lbmt + $lbrt;
	$bftotal = $m_sum + $r_sum;
	//$vatbftotal = $m_vat + $r_vat + ((($lbmt+$lbrt)*$vats)/100) + ((($shmt+$shrt)*$vats)/100);
	$vatbftotal = (($m_sum + $r_sum)*$vats)/100;

	$atotal = $bftotal + $vatbftotal;
	
	
	/*$mrmixt = 
	$crmixt = */
	
	if($search_custname!=''){ 
		$cust_name = mysql_fetch_array(mysql_query("SELECT sub_cust.cust_corp, sub_cust.cust_name, sub_cust.cust_address, sub_cust.cust_tel, sub_cust.cust_email, sub_cust.cust_zip, p.pro_name, a.amp_name, tum_name
													FROM ((province p JOIN (SELECT * FROM tb_customer c1 WHERE c1.cust_id = '$search_custname') as sub_cust ON sub_cust.cust_province = p.id) 
														  JOIN amphur a ON a.id  = sub_cust.cust_amphur) 
														  JOIN tumbon t ON t.id = sub_cust.cust_tumbon
													"));
	}
	
	$cname = $cust_name['cust_name'];
	$aname = $cust_name['cust_address'];
	$amp_name = $cust_name['amp_name'];
	$tname = $cust_name['tum_name'];
	$pname = $cust_name['pro_name'];
	$zname = $cust_name['cust_zip'];
	$telname = $cust_name['cust_tel'];
	$cemail = $cust_name['cust_email'];
	$ccorp = $cust_name['cust_corp'];

	
	
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />

	<?php require_once('../sys/include/metatagsys.php');?>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<title>ใบเสนอราคาห้องเย็น Topcooling</title>
</head>
<body>
<?php require_once('../include/googletag.php');?> 
<?php //require_once('../include/debug-quotation.php'); ?>

<script>
	$(document).ready(function(){
		$("#addr_origin").clone().appendTo(".cust");
		$("#corp_addr_ini").clone().appendTo(".cover_header");
		$("#contact_ini").clone().appendTo(".cover_contact");
	});
</script>

<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">

              <div id="corp_addr_ini">
				<?php 
					if($corp_addr == 1){
						require_once('../include/tcl_addr.php');
					}else{
						require_once('../include/ptwall_addr.php');
					}					
				?>
			</div><!--end cover_header-->
			
			
			<div style="margin-top:85px;">
				<div id="addr_origin" style="float:left; width:65%; line-height:18px;">
					<?php require_once('../include/custaddress.php'); ?>
				
				</div><!--end cust-->
				
				<?php 
					if($corp_addr == 1){
						require_once('../include/tcl_contact.php');
					}else{
						require_once('../include/ptwall_contact.php');
					}					
				?>
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Matchine</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ เครื่อง</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP <?php echo $temp_num?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
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
					
					<tr>
						<td>1. <?php echo $m1;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m1q;?></td>
						<td class="l" align="right"><?php echo number_format($m1p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m1t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>2. <?php echo $m2;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m2q;?></td>
						<td class="l" align="right"><?php echo number_format($m2p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m2t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>3. <?php echo $m3;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m3q;?></td>
						<td class="l" align="right"><?php echo number_format($m3p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m3t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>4. <?php echo $m4;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m4q;?></td>
						<td class="l" align="right"><?php echo number_format($m4p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m4t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>5. <?php echo $m5;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m5q;?></td>
						<td class="l" align="right"><?php echo number_format($m5p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m5t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>6. <?php echo $m6;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m6q;?></td>
						<td class="l" align="right"><?php echo number_format($m6p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m6t, 2, '.', ',');?></td>
					</tr>
					
					
					
					<tr>
						<td>7. <?php echo $m7;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m7q;?></td>
						<td class="l" align="right"><?php echo number_format($m7p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m7t, 2, '.', ',');?></td>
					</tr>
					
					
					<tr>
						<td>8. <?php echo $m8;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m8q;?></td>
						<td class="l" align="right"><?php echo number_format($m8p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m8t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>9. <?php echo $m9;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m9q;?></td>
						<td class="l" align="right"><?php echo number_format($m9p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m9t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>10. <?php echo $m10;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m10q;?></td>
						<td class="l" align="right"><?php echo number_format($m10p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m10t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>11. <?php echo $m11;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m11q;?></td>
						<td class="l" align="right"><?php echo number_format($m11p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m11t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>12. <?php echo $m12;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m12q;?></td>
						<td class="l" align="right"><?php echo number_format($m12p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m12t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>13. <?php echo $m13;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $labormachineunit;?></td>
						<td class="l" align="right"><?php echo number_format($labormachinepirce*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($lbmt, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>14. <?php echo $m14;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $shipmachineunit;?></td>
						<td class="l" align="right"><?php echo number_format($shipmachineprice*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($shmt, 2, '.', ',');?></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($m_sum, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php  echo number_format($m_vat, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($m_total); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format($m_total, 2, '.', ',');?></td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span><?php if($corp_addr == 1){ echo '(นายชูเกียรติ  เทียนอำไพ)'; }else{ echo '&nbsp;&nbsp;&nbsp;&nbsp;(ไพฑูรย์ เกตุแก้ว)';}	?></span> <br><br>
					
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
					<br>
				</div>
				
				
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				<span><strong><u>เงื่อนไขการคำนวณ</u> </strong></span><br>
				<span>ระยะเวลาลดอุณหภูมิสินค้า : <?php echo $timeperiod; ?> ชม. </span><br>
				<span>อุณหภูมิสินค้าก่อนเข้าห้อง :  <?php echo $temp_before;?> องศาเซลเซียส</span><br>
				<span>ปริมาณสินค้า :  <?php  echo number_format($qty, 2, '.', ','); ?>  กิโลกรัม</span><br> <br> 
				<span><strong><u>ค่าไฟเฉลี่อต่อเดือน :</u> </strong> <?php echo number_format($totalcur, 2, '.', ','); ?>  บาท (อัตราค่าไฟปกติ ไม่ใช่ TOU) </span><br> 
				

				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
				<!--<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>-->
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
		
		
		
		
		
		
		
		
		
    </div> <!--end page-->
    <div class="page">
        <div class="subpage">

            <div class="cover_header">
				
			</div><!--end cover_header-->
			
			
			<div class="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php //require_once('../include/custaddress1.php'); ?>
				
				</div><!--end cust-->
				
				<div class="cover_contact">
				</div>
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ ห้อง</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP <?php echo $temp_num?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
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
					
					<tr>
						<td>1. <?php echo $r1;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r1q;?></td>
						<td class="l" align="right"><?php echo number_format($r1p+$fomeadd, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r1t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>2. <?php echo $r2;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r2q;?></td>
						<td class="l" align="right"><?php echo number_format($r2p+$fomeadd, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r2t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>3. <?php echo $r3;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r3q;?></td>
						<td class="l" align="right"><?php echo number_format($r3p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r3t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>4. <?php echo $r4;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r4q;?></td>
						<td class="l" align="right"><?php echo number_format($r4p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r4t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>5. <?php echo $r5;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r5q;?></td>
						<td class="l" align="right"><?php echo number_format($r5p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r5t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>6. <?php echo $r6;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r6q;?></td>
						<td class="l" align="right"><?php echo number_format($r6p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r6t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>7. <?php echo $r_pressure;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r_pressureq;?></td>
						<td class="l" align="right"><?php echo number_format($r_pressure_p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($rpressure_t, 2, '.', ',');?></td>
					</tr>
					
					
					<tr>
						<td>8. <?php echo $r7;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r7q;?></td>
						<td class="l" align="right"><?php echo number_format($r7p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r7t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>9. <?php echo $r8;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r8q;?></td>
						<td class="l" align="right"><?php echo number_format($r8p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r8t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>10. <?php echo $r9;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r9q;?></td>
						<td class="l" align="right"><?php echo number_format($r9p*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r9t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>11. <?php echo $r10;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $laborroomunit;?></td>
						<td class="l" align="right"><?php echo number_format($laborroomprice*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($lbrt, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>12. <?php echo $r11;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $shiproomunit;?></td>
						<td class="l" align="right"><?php echo number_format($shiproomprice*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($shrt, 2, '.', ',');?></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php  echo number_format($r_sum, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php  echo number_format($r_vat, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($r_total); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php  echo number_format($r_total, 2, '.', ',');?></td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span><?php if($corp_addr == 1){ echo '(นายชูเกียรติ  เทียนอำไพ)'; }else{ echo '&nbsp;&nbsp;&nbsp;&nbsp;(ไพฑูรย์ เกตุแก้ว)';}	?></span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
				</div>
			</div><!--end footer-->
			
			
		
			<br><br><br>
			<div id="note" style="clear: both; margin: 150px 0 0 200px;">
				
				<!--<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>-->
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->
	
	</form>
	
	<div class="page">
        <div class="subpage">

            <div class="cover_header">
				
			</div><!--end cover_header-->
			
			
			<div class="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php //require_once('../include/custaddress2.php'); ?>
				
				</div><!--end cust-->
				
				<div class="cover_contact">
				</div>
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของค่าแรงติดตั้งงานที่นำเสนอ</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>


					<tr align="center">
						<td align="left">COLD ROOM </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
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
					
					<tr>
						<td>1. ชุดเครื่องทำความเย็น</td> 
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"><?php echo number_format($m_sum, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m_sum, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>2. แผ่นฉนวนและอุปกรณ์ติดตั้ง</td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"><?php echo number_format($r_sum, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r_sum, 2, '.', ',');?></td>
					</tr>
					
					<!--<tr>
						<td>3. ค่าแรงและค่าติดตั้ง เครื่อง </td>
						<td colspan="2" class="l" align="center"><?php echo $labormachineunit;?> หน่วย</td>
						<td class="l" align="right"><?php echo number_format($labormachinepirce*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($lbmt, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>4. ค่าแรงและค่าติดตั้ง ห้อง </td>
						<td colspan="2" class="l" align="center"><?php echo $laborroomunit;?> หน่วย</td>
						<td class="l" align="right"><?php echo number_format($laborroomprice*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($lbrt, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>5. ค่าขนส่ง เครื่อง</td>  
						<td colspan="2" class="l" align="center"><?php echo $shipmachineunit;?> เที่ยว </td> 
						<td class="l" align="right"><?php echo number_format($shipmachineprice*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($shmt, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>6. ค่าขนส่ง ห้อง</td>  
						<td colspan="2" class="l" align="center"><?php echo $shiproomunit;?> เที่ยว </td> 
						<td class="l" align="right"><?php echo number_format($shiproomprice*$percentprofit, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($shrt, 2, '.', ',');?></td>
					</tr>-->
					
					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($bftotal, 2, '.', ',');?></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format($vatbftotal, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($atotal); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format($atotal, 2, '.', ',');?></td>
					</tr>   
					
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">

					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>ราคาที่เสนอมาไม่รวมรายการดังนี้</u> </strong></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">- งานเพิ่มเติมจากแบบและ Quotation </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">- และรายการอื่นๆ ที่มิได้ระบุไว้ข้างต้น </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>เงื่อนไขการชำระเงิน </u></strong></td>
					</tr>
					<tr class="highs" style="">   
						<td class="l" colspan="5">งวดที่ 1   40%  ชำระเมื่อได้รับใบสั่งซื้อ (<?php echo number_format($atotal*0.4, 2, '.', ',');?> บาท) </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">งวดที่ 2   40% ชำระเมื่อส่งอุปกรณ์ (<?php echo number_format($atotal*0.4, 2, '.', ',');?> บาท)</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">งวดที่ 3   20% ชำระเมื่อส่งมอบงาน  (<?php echo number_format($atotal*0.2, 2, '.', ',');?> บาท)</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>การรับประกัน</strong></u> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">-  ทางบริษัทฯ มีความยินดีรับประกันเป็นระยะเวลา 1 ปี  </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">-  การรับประกันดังกล่าวมิได้รวมถึงผลเสียหายที่เกิดจากความบกพร่องของผู้ใช้งาน  </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>รายละเอียดเลขที่บัญชีสำหรับโอนเงิน</u></strong></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">
						<span><?php if($corp_addr == 1){ echo 'บัญชีธนาคารกสิกรไทย ชูเกียรติ เทียนอำไพ   ออมทรัพย์  เลขที่บัญชี 855-2-05499-8 '; }else{ echo 'ธนาคารไทยพานิชย์ เลขที่ 147-237574-4 ออมทรัพย์ บัญชี บริษัท พี ที วอลล์ จำกัด' ;}	?></span> <br><br>
						</td>
					</tr>
					
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span><?php if($corp_addr == 1){ echo '(นายชูเกียรติ  เทียนอำไพ)'; }else{ echo '&nbsp;&nbsp;&nbsp;&nbsp;(ไพฑูรย์ เกตุแก้ว)';}	?></span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
				</div>
			</div><!--end footer-->
			
			
		
			<br><br><br>
			<div id="note" style="clear: both; margin: 150px 0 0 200px;">
				
				<!--<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>-->
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->
	
</div>
<span style="float:right;"></span>
</body>
</html>