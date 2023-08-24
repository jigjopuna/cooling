<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="ราคาห้อง และโฟม" />
	<meta name="description" content="ราคาห้อง และโฟม" />
	<?php require_once('../sys/include/metatagsys.php');?>
	<title>ราคาห้อง และโฟม</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
	
</head>
<body>
<?php 
   require_once('../include/connect.php');
   require_once('../include/thaibaht.php');

    //1. receive data
	$r_width  = trim($_POST['r_width']);
	$r_length  = trim($_POST['r_length']);
	$r_height  = trim($_POST['r_height']);
	$temparature  = $_POST['temparature'];
	$stdardwall = 1.2;
	$aluminium_lenght = 6;
	
	$cost_chakbold = 380;
	$cost_chakl = 490;
	$cost_chakcurve = 450;
	$cost_chakbang = 450;
	$cost_chakf = 1100;
	$cost_minuimbua = 230;
	
	$cost_printcode = 400;
	$cost_plastic = 4500;
	$cost_seland = 80;
	$cost_silicon = 120;
	$cost_revet = 512;
	$cost_pressure = 1000;
	$cost_light = 700+500+300; //โคมคู่ + ค่าติดตั้ง+สายไฟ ราง พร้อมสวิตซ์
	
	
	
	
	if($temparature==1){
		$temps = 25;
	}else if ($temparature==2){
		$temps = 18;
	}else if ($temparature==3){
		$temps = 10;
	}else if ($temparature==4){
		$temps = -5;
	}else if ($temparature==5){
		$temps = -12;
	}else if ($temparature==6){
		$temps = -15;
	}else if ($temparature==7){
		$temps = -25;
	}else if ($temparature==8){
		$temps = -30;
	}else{
		$temps = -40;
	}


	
	
	
	$cute = $r_width*$r_length*$r_height;
	
	$row_inch = mysql_fetch_array(mysql_query("SELECT pr_size, pr_sell_price, pr_type FROM tb_productroom WHERE pr_cate = 1 AND pr_temp = '$temps'"));
	
	$isoprice = $row_inch['pr_sell_price'];
	$pr_size = $row_inch['pr_size'];
	$pr_type = $row_inch['pr_type'];
	

	
	
	
	
	//ISOWALL หาจำนวนแผ่นว่าใช้กี่แผ่น
	$isoside = ceil((($r_length+$r_width)*2)/1.2)+1;
	$isoceil = ceil($r_length/1.2);
	$isosidecost = $r_height*1.2*$isoside*$isoprice;
	$isoceilcost = $r_width*1.2*$isoceil*$isoprice;
	
	
	/*ตารางเมตรของห้อง
	/*เราต้องคิดจาก ตารางเมตร ของแผ่น ไม่ได้คิดตามตารางเมตรของห้อง*/
	/*$area_room = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)))*1.1;  ไม่นับพื้น
	$area_room = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)));
	$area_room_all = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width))*2);
	$celingsqm = $r_length*$r_width;
	$floor = $r_length*$r_width;*/
	
	
	//พื้นที่ผนัง = จำนวนแผ่น * 1.2 * ความสูงห้อง
	$area_room = $isoside*$stdardwall*$r_height;
	
	//พื้นที่เพดาน = จำนวนแผ่น * 1.2 * ความกว้าง ห้อง
	$celingsqm = $isoceil*$stdardwall*$r_width;
	$floor = $isoceil*$stdardwall*$r_width;

	$area_room_all = $area_room + $celingsqm + $floor;


	$chakf = (ceil((($r_width*2)+($r_length*2))/6))+2;
	$chakbold = $chakf; 
	$chakcong = $chakf + ceil(($r_height/6)*4);
	$chakbang = ceil(($r_height/6)*4);
	$miniumbau = ceil(((($r_width*2)+($r_length*2))/6)*2);
	$all_menium = $chakbold + $chakbang + $chakcong + $chakf + $miniumbau;
	
	
	

	
	$printcode = ceil(($r_width*$r_length*2)/18);
	$plasticflr = ceil(($r_width*$r_length)/90);
	$seland_ = ceil($area_room*0.5);
	$silicon_ = ceil(($area_room + $celingsqm)/6);
	$revet = ceil((($all_menium*6*2*0.35)/0.25)/600);
	$prsur = ceil(($r_width*$r_length*$r_height)/100);
	
	
	
	//ส่วนของเพดาน
	$max_length = 4;
	$qutity = ceil($r_width/$max_length); 
	$length_iso = $r_width/$qutity; //ความยาวต่อหนึ่งแผ่น
	
	$qutity_length = ceil($r_length/1.2);   //จำนวนแผ่นตามความยาวห้อง
	$pan =  ($qutity_length*$qutity)*3; //จำนวนแป้นสตัส
	$h = ceil(($qutity-1)*($r_length/6));
	$gift = $pan*2;
	$saling = ceil(($pan*5)/200);
	
	$pan_cost = 60;
	$kloreng_cost = 70;
	$gift_cost = 30;
	$h_cost = 1200;
	$saling_cost = 2200;
	
	$pan_price = $pan_cost*$pan;
	$kloreng_price = $kloreng_cost*$pan;
	$gift_price = $gift_cost*$gift;
	$h_price = $h*$h_cost;
	$saling_price = $saling_cost*$saling;
	
	
	$sum_pan_fah = $qutity*$qutity_length;
	
	
	
	$all_price_ceiling = $pan_price + $kloreng_price + $gift_price + $h_price + $saling_price;

	if($area_room_all <= 100){
		$laborcost = 20000;
		$jipata = 2000; //ทินเนอร์ เศษผ้า ถุงขยะ
		$pufoam = 1000; 
		$door = 50000;
		$door_size = '1.20 x 2.00';
		
	}else if($area_room_all <= 200){
		$laborcost = 35000;
		$jipata = 3000; //ทินเนอร์ เศษผ้า ถุงขยะ
		$pufoam = 2000; 
		$door = 60000;
		$door_size = '1.60 x 2.50';
	}else{
		$laborcost = $area_room_all*160;
		$jipata = 5000; //ทินเนอร์ เศษผ้า ถุงขยะ
		$pufoam = 6000;
		$door = 120000;
		$door_size = '3.00 x 3.00';
	}
	
	$light_qty = ceil($sum_pan_fah/3);
	$light = $light_qty*$cost_light;
	
	//exit();
	//ราคาแผ่นผนัง = จำนวนแผ่น * ราคาแผ่น * 1.2 * ความสูงของห้อง
	$price_isoside = $isoside*$isoprice*$stdardwall*$r_height;
	
	//ราคาแผ่นเพดาน = จำนวนแผ่น * ราคาแผ่น * 1.2 * ความกว้างของห้อง
	$price_isoceil = $isoceil*$isoprice*$stdardwall*$r_width;
	$price_flrfome = $isoceil*$isoprice*$stdardwall*$r_width; 
	
	$all_price_flrfome =  $price_isoside + $price_isoceil +  $price_flrfome + $door;

	$price_chkbold = $chakbold*$cost_chakbold;
	$price_chkl = $chaklthing*$cost_chakl;
	$price_chkcurve = $cost_chakcurve*$chakcong;
	$price_chkf = $chakf*$cost_chakf;
	$price_chkbang = $chakbang *$cost_chakbang;
	$price_bua = $miniumbau*$cost_minuimbua;
	$all_price_chak =  $price_chkbold + $price_chkl + $price_chkcurve + $price_chkf + $price_chkbang + $price_bua;

	$price_printcode = $printcode*$cost_printcode;
	$price_plastic = $plasticflr*$cost_plastic;
	$price_seland = $seland_*$cost_seland;
	$price_silicon = $silicon_*$cost_silicon;
	$price_revet = $revet*$cost_revet;
	$price_resur = $prsur*$cost_pressure;
	
	
	
	$all_price_acces = $price_printcode + $price_plastic + $price_seland + $price_silicon + $price_revet + $price_resur + $jipata + $pufoam; 
	
	$total_price = $all_price_flrfome + $all_price_chak + $all_price_acces + $all_price_ceiling + $laborcost + $light;
	
	
	/*echo 'temparature : '. $temparature.'<br>';
		echo 'r_width : '. $r_width.'<br>';
		echo 'r_length : '. $r_length.'<br>';
		echo 'r_height : '.$r_height .'<br><br>';
		echo 'area_room : '. $area_room.'<br>';
		echo 'isoprice : '. $isoprice.'<br>';

		echo 'isoside : '. $isoside.'<br>';
		echo 'isoceil : '.$isoceil .'<br><br>';
		
		echo 'isosidecost : '. $isosidecost.'<br>';
		echo 'isoceilcost : '. $isoceilcost.'<br><br>';

		echo 'flr_cost : '.$flr_cost.'<br>';
	echo 'fome_flr_cost : '.$fome_flr_cost.'<br><br>';
		
	echo 'inchs : '.$inchs.'<br>';
	echo 'inch2 : '.$inch2.'<br>';
	echo 'fqty : '.$fqty.'<br>';
	echo 'qtypaper : '.$qtypaper.'<br><br>';

	echo 'chakbold : '.$chakbold.'<br>';
	echo 'chaklthing : '.$chaklthing.'<br>';
	echo 'chak2in : '.$chak2in.'<br>';
	echo 'chakf : '.$chakf.'<br>';
	echo 'miniumbau : '.$miniumbau.'<br><br>';
	echo 'all_menium : '.$all_menium.'<br><br>';

	echo 'printcode : '.$printcode.'<br>';
	echo 'plasticflr : '.$plasticflr.'<br>';
	echo 'seland_ : '.$seland_.'<br>';
	echo 'silicon_ : '.$silicon_.'<br>';
	echo 'revet : '.$revet.'<br>';
	echo 'prsur : '.$prsur.'<br><br>';
		echo 'laborcost : '.$laborcost.'<br>';
	echo 'all_price_flrfome : '. $all_price_flrfome.'<br>';
	echo 'all_price_chak : '. $all_price_chak.'<br>';
	echo 'all_price_acces : '. $all_price_acces.'<br>';*/
	
	

?>
<?php require_once('../include/googletag.php');?>


<script>

	$(document).ready(function(){
		$('#findcost').click(function(){
			 $('#form1').attr('action', 'cost.php');
			 $('#form1').submit();
		});
		
		$("#search_custname").autocomplete({
				source: "../ajax/search_cust.php",
				minLength: 1
		});
		
	});
	

</script>

<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				
				<?php include ('../include/cpn_addr.php'); ?>
			</div><!--end cover_header-->
			
			<?php //include ('../include/quotation_head_cpn.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> วัสดุอุปกรณ์ติดตั้งห้องเย็น</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ  พื้นที่ทั้งหมด <?php echo number_format($area_room_all , 2, '.', ','); ?> ตร.ม.</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					
					<tr align="center">
						<td align="left"> ผนังเพดาน <?php echo $celingsqm + $area_room; ?> ตร.ม.   พื้น <?php echo $floor; ?> ตร.ม. </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">รายละเอียดการซื้อของ </td>
						<td colspan="2" class="l">จำนวน</td>
						<td class="l">ราคาต่อหน่วย</td>
						<td class="l">ราคารวม</td>
					</tr>
					
					<tr class="highs" style="font-weight:bold; font-size:1.2em;">
						<td class="l">ISOWALL ชนิด <?php echo $pr_type; ?> หนา <?php echo $pr_size;?> นิ้ว (<?php echo number_format($all_price_flrfome, 2, '.', ','); ?>)</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1. ผนังข้าง กว้าง 1.2 เมตร  ยาว <?php echo $r_height;?> เมตร (<?php echo $area_room; ?>) ตร.ม.</td>
						<td colspan="2" class="l" align="center"><?php echo $isoside;?> แผ่น</td>
						<td class="l" align="right"><?php echo $isoprice;?></td>
						<td class="l" align="right"><?php echo number_format($price_isoside, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>2. เพดานบน กว้าง 1.2 เมตร  ยาว <?php echo number_format($length_iso, 2, '.', ',');?> เมตร (<?php echo $celingsqm; ?>) ตร.ม. </td>
						<td colspan="2" class="l" align="center"><?php echo $sum_pan_fah; //$isoceil;?> แผ่น</td>
						<td class="l" align="right"><?php echo $isoprice;?></td>
						<td class="l" align="right"><?php echo number_format($price_isoceil, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>3. โฟมพื้น กว้าง 1.2 เมตร    ยาว <?php echo number_format($length_iso, 2, '.', ',');?> เมตร (<?php echo $floor; ?>) ตร.ม. </td>
						<td colspan="2" class="l" align="center"><?php echo $sum_pan_fah;?> แผ่น</td>
						<td class="l" align="right"><?php echo $isoprice;?></td>
						<td class="l" align="right"><?php echo number_format($price_flrfome, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>4. ประตูสไลด์ห้องเย็น ขนาด <?php echo $door_size; ?> เมตร     </td>
						<td colspan="2" class="l" align="center">1 บาน </td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><?php echo number_format($door, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" style="font-weight: bold; background-color: #EEEEEE;">อลูมิเนียม ยาว <?php echo $aluminium_lenght;?> เมตร (<?php echo number_format($all_price_chak, 2, '.', ','); ?>)</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>5. ฉากหนา (ฉากแอล)  </td>
						<td colspan="2" class="l" align="center"><?php echo $chakbold;?> เส้น</td>
						<td class="l" align="right"><?php echo $cost_chakbold;?>    </td>
						<td class="l" align="right"><?php echo number_format($price_chkbold , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>6. ฉากบาง (นิ้วครึ่ง)  </td>
						<td colspan="2" class="l" align="center"><?php echo $chakbang ;?>    เส้น</td>
						<td class="l" align="right"><?php echo $cost_chakbang;?></td>
						<td class="l" align="right"><?php echo number_format($price_chkbang , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>7. ฉากโค้งชิ้นเดียว  </td>
						<td colspan="2" class="l" align="center"><?php echo $chakcong ;?>    เส้น</td>
						<td class="l" align="right"><?php echo $cost_chakcurve;?></td>
						<td class="l" align="right"><?php echo number_format($price_chkcurve, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>8. ฉาก F (พื้นห้องเย็น)  </td>
						<td colspan="2" class="l" align="center"><?php echo number_format($chakf, 0, '.', ',');?>    เส้น</td>
						<td class="l" align="right"><?php echo number_format($cost_chakf, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_chkf , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>9. อลูมิเนียมบัว   </td>
						<td colspan="2" class="l" align="center"><?php echo $miniumbau ;?>    เส้น</td>
						<td class="l" align="right"><?php echo  number_format($cost_minuimbua, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_bua , 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" style="font-weight: bold; background-color: #EEEEEE;">งานเพดาน <?php echo $qutity;?> แถว แถวละ  <?php echo $qutity_length;?> แผ่น   (<?php echo number_format($all_price_ceiling, 2, '.', ','); ?>)</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>10. แป้นยึดแผ่นเพดาน  เกลียวเร่ง </td>
						<td colspan="2" class="l" align="center"><?php echo $pan ;?> จุด </td>
						<td class="l" align="right"><?php echo number_format($pan_cost+$kloreng_cost, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($pan_price+$kloreng_price , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>11. กิ๊ฟล็อค  </td>
						<td colspan="2" class="l" align="center"><?php echo $gift ;?> ตัว</td>
						<td class="l" align="right"><?php echo number_format($gift_cost, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($gift_price , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>12. อลูมิเนียม H มีรู  </td>
						<td colspan="2" class="l" align="center"><?php echo $h ;?> เส้น</td>
						<td class="l" align="right"><?php echo number_format($h_cost, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($h_price , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>13. สลิง  </td>
						<td colspan="2" class="l" align="center"><?php echo $saling ;?> ม้วน</td>
						<td class="l" align="right"><?php echo number_format($saling_cost, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($saling_price , 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" style="font-weight: bold; background-color: #EEEEEE;">อุปกรณ์อื่นๆ  
						
						   (<?php echo number_format($all_price_acces, 2, '.', ','); ?>) </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>14. ฟริ้นโค้ส  </td>
						<td colspan="2" class="l" align="center"><?php echo $printcode ;?> ถัง </td>
						<td class="l" align="right"><?php echo number_format($cost_printcode, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_printcode , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>15. พลาสติกปูพื้น  </td>
						<td colspan="2" class="l" align="center"><?php echo $plasticflr ;?> ม้วน </td>
						<td class="l" align="right"><?php echo number_format($cost_plastic, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_plastic , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>16. ซีลแลนด์  </td>
						<td colspan="2" class="l" align="center"><?php echo $seland_ ;?> หลอด </td>
						<td class="l" align="right"><?php echo number_format($cost_seland, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_seland , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>17. ซีลิโคน  </td>
						<td colspan="2" class="l" align="center"><?php echo $silicon_ ;?> หลอด </td>
						<td class="l" align="right"><?php echo number_format($cost_silicon, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_silicon , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>18. รีเวท  </td>
						<td colspan="2" class="l" align="center"><?php echo $revet ;?> กล่อง </td>
						<td class="l" align="right"><?php echo number_format($cost_revet, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_revet, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>19. วาล์วปรับแรงดัน </td>
						<td colspan="2" class="l" align="center"><?php echo $prsur ;?> ตัว </td>
						<td class="l" align="right"><?php echo number_format($cost_pressure, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_resur , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>20 ดอกสว่าน ถุงขยะ ทินเนอร์ เศษผ้า </td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><?php echo number_format($jipata , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>21. PU โฟม แบบกระป๋อง และแบบเท</td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><?php echo number_format($pufoam , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>22. ไฟส่องสว่าง LED 18 วัตต์ <?php echo $light_qty;?> โคม (โคมละ 2 หลอด) </td>
						<td colspan="2" class="l" align="center"><?php echo $light_qty*2;?> หลอด</td>
						<td class="l" align="right"><?php echo number_format($cost_light , 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($light , 2, '.', ','); ?></td>
					</tr>
					

					<tr>
						<td> &nbsp; </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>23. ค่าแรงติดตั้ง  </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><?php echo number_format($laborcost , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>24 ค่าขนส่ง (ขึ้นอยู่กับระยะทาง)  </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"> </td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($total_price, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format($total_price*0.07, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($total_price+($total_price*0.07)); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format($total_price+($total_price*0.07), 2, '.', ','); ?></td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				
				
				
			</div><!--end footer-->
			
			
		
			
			
        
        </div>  <!--end subpage-->
    </div> <!--end page-->
   
 
	    <input type="hidden" name="temp_num" value="<?php echo $temp_num?>">
		<input type="hidden" name="r_width" value="<?php echo $r_width?>">
		<input type="hidden" name="r_length" value="<?php echo $r_length?>">
		<input type="hidden" name="r_height" value="<?php echo $r_height?>">
		
	
		<!--<div style="margin-left: 500px;">
			<table>
				<tr>
					<td style="width:200px;">กำไร <input type="text" value="" name="percentprofit" > % </td>
					<td style="width:150px;" align="center">ราคาทุน</td>
				</tr>
				<tr>
					<td align="center"><input type="submit" value="คำนวณราคา"></td>
					<td align="center"><input type="button" value="ราคาทุน" id="findcost"></td>
				</tr>
				
		
			</table>
		</div>-->
		
	</form>
	
</div>
<span style="float:right;"><?php echo $total_result_t;?></span>
<div style="display:none" class="qutity"><?php echo $qutity ?></div>
<div  style="display:none" class="length_iso"><?php echo $length_iso ?></div>
<div style="display:none" class="pan"><?php echo $pan ?></div>
<div style="display:none" class="h"><?php echo $h ?></div>
<div style="display:none" class="gift"><?php echo $gift ?></div>
<div style="display:none" class="saling"><?php echo $saling ?></div>

<div style="display:none" class=""></div>

<div style="display:none" class="pan_price"><?php echo number_format($pan_price , 2, '.', ','); ?></div>
<div  style="display:none" class="kloreng_price"><?php echo number_format($kloreng_price , 2, '.', ','); ?></div>
<div style="display:none" class="gift_price"><?php echo number_format($gift_price , 2, '.', ',');?></div>
<div style="display:none" class="h_price"><?php echo number_format($h_price , 2, '.', ','); ?></div>
<div style="display:none" class="saling_price"><?php echo number_format($saling_price , 2, '.', ',')  ?></div>
<div style="display:none" class="all_price_ceiling"><?php echo number_format($all_price_ceiling , 2, '.', ',')  ?></div>





</body>
</html>