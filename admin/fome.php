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
	
	$cost_chakbold = 330;
	$cost_chakl = 410;
	$cost_chakcurve = 390;
	$cost_chakf = 1035;
	$cost_minuimbua = 230;
	
	$cost_printcode = 2150;
	$cost_plastic = 4500;
	$cost_seland = 70;
	$cost_silicon = 88;
	$cost_revet = 407;
	$cost_pressure = 2000;
	
	
	
	
	if($temparature==1){
		$temps = 25;
	}else if ($temparature==2){
		$temps = 18;
	}else if ($temparature==3){
		$temps = 15;
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


	
	
	/*$area_room = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)))*1.1;  ไม่นับพื้น*/
	$area_room = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)));

	
	$cute = $r_width*$r_length*$r_height;
	
	$row_inch = mysql_fetch_array(mysql_query("SELECT pr_size, pr_sell_price FROM tb_productroom WHERE pr_cate = 1 AND pr_temp = '$temps'"));
	
	$isoprice = $row_inch['pr_sell_price'];

	
	
	
	
	//ISOWALL
	$isoside = ceil((($r_length+$r_width)*2)/1.2);
	$isoceil = ceil($r_length/1.2);
	$isosidecost = $r_height*1.2*$isoside*$isoprice;
	$isoceilcost = $r_width*1.2*$isoceil*$isoprice;
	

	
	//Fome Floor
	$inchs = $row_inch['pr_size'];
	$inch2 = $inchs/2;
	if($inch2 < 2 ){ //ถ้าคำนวนโฟมได้น้อยกว่า 2 นิ้ว ให้ใช้ 2 นิ้ว
		$inch2 = 2;
	}
	$fqty = $r_width*$r_length*2;
	$qtypaper = ceil($fqty/3.66);
	

	
	
	$row_flr_cost = mysql_fetch_array(mysql_query("SELECT pr_sell_price FROM tb_productroom WHERE pr_cate = 2 AND pr_size = '$inch2'"));
	$flr_cost = $row_flr_cost['pr_sell_price'];
	
	$fome_flr_cost = $qtypaper*3.6*$flr_cost;
	
	
	

	$chakbold = ceil(($r_height*4)/6);    
	$chaklthing = ceil((($r_width*2) + ($r_length*2))/6);
	$chak2in = $chakbold + $chaklthing;
	$chakf = ceil((($r_width*2)+($r_length*2))/6);
	$miniumbau = ceil(((($r_width*2)+($r_length*2))/6)*2);
	$all_menium = $chakbold + $chaklthing + $chak2in + $chakf + $miniumbau;
	

	
	$printcode = ceil(($r_width*$r_length*2)/36);
	$plasticflr = ceil(($r_width*$r_length)/45);
	$seland_ = ceil($area_room*0.5);
	$silicon_ = ceil($area_room/8);
	$revet = ceil((($all_menium*6*2*0.35)/0.25)/1000);
	$prsur = ceil(($r_width*$r_length*$r_height)/100);
	

	
	
	
	if($area_room <= 100){
		$laborcost = 15000;
	}else if($area_room <= 200){
		$laborcost = 25000;
	}else{
		$laborcost = $area_room*120;
	}

	
	//exit();
	$price_isoside = $isoside*$isoprice*$stdardwall*$r_height;
	$price_isoceil = $isoceil*$isoprice*$stdardwall*$r_width;
	$price_flrfome = 3.6*$qtypaper*$flr_cost; 
	
	$all_price_flrfome =  $price_isoside + $price_isoceil +  $price_flrfome;

	$price_chkbold = $chakbold*$cost_chakbold;
	$price_chkl = $chaklthing*$cost_chakl;
	$price_chkcurve = $cost_chakcurve*$chak2in;
	$price_chkf = $chakf*$cost_chakf;
	$price_bua = $miniumbau*$cost_minuimbua;
	$all_price_chak =  $price_chkbold + $price_chkl + $price_chkcurve + $price_chkf + $price_bua;

	$price_printcode = $printcode*$cost_printcode;
	$price_plastic = $plasticflr*$cost_plastic;
	$price_seland = $seland_*$cost_seland;
	$price_silicon = $silicon_*$cost_silicon;
	$price_revet = $revet*$cost_revet;
	$price_resur = $prsur*$cost_pressure;
	
	$all_price_acces = $price_printcode + $price_plastic + $price_seland + $price_silicon + $price_revet + $price_resur  + $laborcost; 
	
	$total_price = $all_price_flrfome + $all_price_chak + $all_price_acces;
	
	
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
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px; color:red; font-size:36px;">
					ต้นทุนโฟม ห้องเย็น
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> รายการซื้อของ</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ เครื่อง</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left"> <?php echo $area_room; ?> ตารางเมตร (ผนังเพดาน)</td>
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
					
					<tr class="highs" style="">
						<td class="l">ISOWALL </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1. ผนังข้าง กว้าง 1.2 เมตร  ยาว <?php echo $r_height;?></td>
						<td colspan="2" class="l" align="center"><?php echo $isoside;?> แผ่น</td>
						<td class="l" align="right"><?php echo $isoprice;?></td>
						<td class="l" align="right"><?php echo number_format($price_isoside, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>2. เพดานบน กว้าง 1.2 เมตร  ยาว <?php echo $r_width;?></td>
						<td colspan="2" class="l" align="center"><?php echo $isoceil;?> แผ่น</td>
						<td class="l" align="right"><?php echo $isoprice;?></td>
						<td class="l" align="right"><?php echo number_format($price_isoceil, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>3. โฟมพื้น ขนาด  <?php echo $inch2;?> นิ้ว  ปริมาณ <?php echo $fqty;?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtypaper;?> แผ่น</td>
						<td class="l" align="right"><?php echo $flr_cost;?></td>
						<td class="l" align="right"><?php echo number_format($price_flrfome, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" style="font-weight: bold; background-color: #EEEEEE;">อลูมิเนียม ยาว <?php echo $aluminium_lenght;?> เมตร</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>4. ฉากหนา (มุมนอก)  <?php echo number_format(($r_height*4)/6 , 2, '.', ',') ;?>  เส้น  </td>
						<td colspan="2" class="l" align="center"><?php echo $chakbold;?> </td>
						<td class="l" align="right"><?php echo $cost_chakbold;?></td>
						<td class="l" align="right"><?php echo number_format($price_chkbold , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>5. ฉากแอลบาง(บนนอก)  <?php echo number_format((($r_width*2) + ($r_length*2))/6 , 2, '.', ',') ;?>  เส้น  </td>
						<td colspan="2" class="l" align="center"><?php echo $chaklthing ;?> </td>
						<td class="l" align="right"><?php echo $cost_chakl;?></td>
						<td class="l" align="right"><?php echo number_format($price_chkl , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>6. ฉากโค้ง2ชิ้น (ใน) <?php echo number_format((($r_height*4)/6)+((($r_width*2) + ($r_length*2))/6) , 2, '.', ',') ;?>  เส้น  </td>
						<td colspan="2" class="l" align="center"><?php echo $chak2in ;?> </td>
						<td class="l" align="right"><?php echo $cost_chakcurve;?></td>
						<td class="l" align="right"><?php echo number_format($price_chkcurve, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>7. ฉากF (พื้นห้องเย็น) <?php echo number_format((($r_width*2) + ($r_length*2))/6 , 2, '.', ',') ;?>  เส้น  </td>
						<td colspan="2" class="l" align="center"><?php echo number_format($chakf, 0, '.', ',');?> </td>
						<td class="l" align="right"><?php echo number_format($cost_chakf, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_chkf , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>8. อลูมิเนียมบัว <?php echo number_format(((($r_width*2)+($r_length*2))/6)*2 , 2, '.', ',') ;?>  เส้น  </td>
						<td colspan="2" class="l" align="center"><?php echo $miniumbau ;?> </td>
						<td class="l" align="right"><?php echo  number_format($cost_minuimbua, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_bua , 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" style="font-weight: bold; background-color: #EEEEEE;">อุปกรณ์อื่นๆ </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>9. ปริ้นโค้ส  </td>
						<td colspan="2" class="l" align="center"><?php echo $printcode ;?> ถัง </td>
						<td class="l" align="right"><?php echo number_format($cost_printcode, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_printcode , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>10. พลาสติกปูพื้น  </td>
						<td colspan="2" class="l" align="center"><?php echo $plasticflr ;?> ม้วน </td>
						<td class="l" align="right"><?php echo number_format($cost_plastic, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_plastic , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>11. ซีแลนด์  </td>
						<td colspan="2" class="l" align="center"><?php echo $seland_ ;?> หลอด </td>
						<td class="l" align="right"><?php echo number_format($cost_seland, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_seland , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>12. ซีลิโคน  </td>
						<td colspan="2" class="l" align="center"><?php echo $silicon_ ;?> หลอด </td>
						<td class="l" align="right"><?php echo number_format($cost_silicon, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_silicon , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>13. รีเวท  </td>
						<td colspan="2" class="l" align="center"><?php echo $revet ;?> กล่อง </td>
						<td class="l" align="right"><?php echo number_format($cost_revet, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_revet, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>14. เพรชเชอร์รีพอร์ต  </td>
						<td colspan="2" class="l" align="center"><?php echo $prsur ;?> ตัว </td>
						<td class="l" align="right"><?php echo number_format($cost_pressure, 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price_resur , 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>15. ค่าแรง  </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><?php echo number_format($laborcost , 2, '.', ','); ?></td>
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
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php //echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
					<br>
				</div>
				
				
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
</body>
</html>