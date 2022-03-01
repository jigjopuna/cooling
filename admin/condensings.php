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
	<link rel="shortcut icon" href="../content/images/favicon.png">
	<title>ราคาเครื่อง <?php echo date("Y").'-'.$nMonth.'-'.$date; ?></title>
	<?php include('../include/metanoindex.php')?>
	<?php include('../include/inc_font.php')?>
	<link rel="stylesheet" href="../css/quotation.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<script>
	$(document).ready(function(){
		$("#btn-calngod").click(calucalatengod);
		$("#calroom").click(calucalatroom);
		
	});
	function calucalatengod(){
		var installs = $('#installs').text();
		if(installs == 0) {
			var allprice = $('#totolprice').text().replace(/,/g, '');
			var firsts = (allprice*0.7).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			var seconds = (allprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			$('.cal_ngo1').text(firsts);
			$('.cal_ngo2').text(seconds);
		}else{
			var allprice = $('#totolprice').text().replace(/,/g, '');
			var firsts = (allprice*0.5).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			var seconds = (allprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			var third = (allprice*0.2).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			$('.cal_ngo1').text(firsts);
			$('.cal_ngo2').text(seconds);
			$('.cal_ngo3').text(third);
			
		}
	}
	
	function calucalatroom(){
			var romprice = $('#roomprice').text().replace(/,/g, '');
			var first1 = (romprice*0.7).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			var second2 = (romprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			$('.roomngod1').text(first1);
			$('.roomngod2').text(second2);
	
	}
	

</script>

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
	
	$condensing = trim($_POST['condensing']);
	$coilyen = trim($_POST['coilyen']); 
	$hascoilyen = trim($_POST['hascoilyen']);
	
	$controlbox = trim($_POST['controlbox']);
	$foaminch = trim($_POST['foaminch']);
	$doortype = trim($_POST['doortype']);
	
	$r_width = trim($_POST['r_width']);
	$r_lenght = trim($_POST['r_lenght']);
	$r_high = trim($_POST['r_high']);
	
	$ord_temp = trim($_POST['ord_temp']);
	
	
	
	$discount = trim($_POST['discount']);
	$qtyhp = trim($_POST['qtyhp']);
	$shipcost = trim($_POST['shipcost']);
	
	$hp = trim($_POST['hp']);
	$combrand = trim($_POST['combrand']);
	$install = trim($_POST['install']);
	$install_price = trim($_POST['install_price']);
	$hasroom = trim($_POST['hasroom']);
	
	$d_high = trim($_POST['d_high']);
	$d_width = trim($_POST['d_width']);
	
	
	$corp = trim($_POST['corp']);
	$foam = trim($_POST['foam']);
	$sale_id = trim($_POST['sale_id']);
	
	$sales = mysql_fetch_array(mysql_query("SELECT e.e_id, e.e_name, e.e_lname, e.e_tel, e.e_email FROM tb_emp e WHERE e_id = '$sale_id'"));
	$sale_name = $sales['e_name'];
	$sale_lname = $sales['e_lname'];
	$sale_tel = $sales['e_tel'];
	$sale_email = $sales['e_email'];
	
	$profit = 0.4;
	
	
	
	
	
	/*echo 'combrand : '.$combrand.'<br>';
	echo 'coilyen : '.$coilyen.'<br>';
	echo 'hp : '.$hp .'<br>';*/
	
	
	//SELECT t_name, t_cost, t_model, t_hp, t_subcate FROM tb_tools WHERE t_type = 11 AND t_subtype = 1 AND t_cate = 4 AND t_subcate = 0  

	
	//เอาเครื่องอย่างเดียว
	 
	//เอาคอยเย็นด้วย
	
	//เอาตู้คอนโทรลด้วย
	
	//จ้างติดตั้งด้วย
	
	

	
	$ngod1 = $total_price*0.5;
	$ngod2 = $total_price*0.5;
	
	if($hp==3){
		$copeland=21;
		$fancon = 1;
	}else if($hp==4){
		$copeland=29;
		$fancon = 1;
	}else if($hp==5){
		$copeland=38;
		$fancon = 2;
	}else if($hp==6){
		$fancon = 2;
	}else if($hp==7){
		$copeland=48;
		$fancon = 2;
	}else if($hp==8){
		$copeland=58;
		$fancon = 2;
	}
	

	$cdu = mysql_fetch_array(mysql_query("SELECT * FROM tb_tools t JOIN tb_com_brand c ON c.comp_id = t.t_brand WHERE t.t_type = 11 AND t.t_subtype =1 AND t.t_brand = '$combrand' AND t.t_hp = '$hp'"));
	$cooler = mysql_fetch_array(mysql_query("SELECT * FROM tb_tools t JOIN tb_cooling_brand c ON c.cool_id = t.t_brand WHERE t.t_type = 11 AND t.t_subtype = 2 AND t.t_brand = '$coilyen' AND t.t_hp = '$hp'"));
	
	$controlprice = 0; 
	$cooler_cost = 0;
	
	if($controlbox == 'on'){ $contbox = 1; $controlprice = 20000; } else { $contbox = 0; }
	if($hascoilyen == 'on'){ $meecoil = 1; $cooler_cost = $cooler['t_price_sell']; } else { $meecoil = 0; }
	if($install == 'on'){ $tidtung = 1; $install_raka = $install_price;} else { $tidtung = 0; $install_raka = 0;}
	if($hasroom == 'on'){ $hasrooms = 1; } else { $hasrooms = 0;  }
	
	
	$cdu_cost = $cdu['t_price_sell'];
	$price = ($cdu_cost + $cooler_cost)*1.1;
	
	
	/*echo 'cdu_cost : '.$cdu_cost.'<br>';
	echo 'cooler_cost : '.$cooler_cost.'<br>';
	echo 'price : '.$price .'<br>';
	exit();*/
	
	$set_price = $controlprice +  $price + $install_raka + $shipcost;
	$vats = $set_price*0.07;
	$amount = $set_price + $vats;
	
	$sql_com = "SELECT * FROM tb_com_brand";
	$result_com = mysql_query($sql_com);
	$num_com = mysql_num_rows($result_com);
	
	for($i=1; $i<=$num_com; $i++){
		$row_com = mysql_fetch_array($result_com);
		if($combrand == $row_com['comp_id']){
		   $compressor_name = $row_com['com_brand'];
		   $com_img = $row_com['com_img'];
		   $comp_id = $row_com['comp_id'];
		}
	}
	  
	  
	$sql_cool = "SELECT * FROM  tb_cooling_brand";
	$result_cool = mysql_query($sql_cool);
	$num_cool = mysql_num_rows($result_cool);
	
	for($i=1; $i<=$num_cool; $i++){
		$row_cool = mysql_fetch_array($result_cool);
		if($coilyen == $row_cool['cool_id']){
		   $cool_name = $row_cool['cool_brand'];
		   $cool_img = $row_cool['cool_img'];
		}
	}
	if($comp_id==1) {
		if($hp==1){ } else if($hp==2){ } else if($hp==3){ $hp1=21; }else if($hp==4){ $hp1=29; }else if($hp==5){ $hp1=38; }else if($hp==6){ $hp1=45; } else if($hp==7){ $hp1=48; }else if($hp==8){ $hp1=58; }
	}	
	
	
	/********** ROOM ZONE********/
	
	$cute = ($r_width*$r_high*2) + ($r_lenght*$r_high*2) + ($r_width*$r_lenght*2);
	$walqty = ceil((($r_lenght*2)+($r_width*2))/1.2)+1;
	$pedan = ceil($r_lenght/1.2);
	$floors = ceil($r_lenght/1.2);
	
	//หาตารางเมตรของแผ่นทั้งหมด
	$sqmwall = $walqty*$r_high*1.2;
	$sqmpedan = $pedan*$r_width*1.2;
	$sqmfloor = $floors*$r_width*1.2;
	$sqmsum = $sqmfloor+$sqmpedan+$sqmwall;
	
	
	
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
	$foam_sum_price =  $sqmsum * $wall_price;
	$wall_and_door = $foam_sum_price + $pratoo;
	
	$kumrai = $wall_and_door*$profit;
	$walkai = $wall_and_door + $kumrai;
	$vats = $walkai*0.07;
	$kaivat = $walkai + $vats;
	
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
			
			<div style="width:100%; float:none; overflow:hidden;"></div>
			<div id="product_price" style="margin-top:10px; clear:both; ">
			
					<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tbody>
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดชุดเครื่องทำความเย็น</td>
					</tr>
					
					
					
					
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l" style="width: 60%">Description </td>
						<td colspan="2" class="l" style="width: 10%">QTY</td>
						<td class="l" style="width: 15%">Unit Price</td>
						<td class="l" style="width: 15%">Amount</td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l">ใช้กับห้องเย็นขนาด <?php echo $r_width.' x '.$r_lenght.' x '.$r_high;?> เมตร (กว้าง ยาว สูง) อุณหภูมิ <?php echo $ord_temp;?>C<sup>o</sup> </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
				
					
					<tr class="highs" style="">
						<td class="l">1. ชุด Compressor 
							<?php echo $compressor_name; ?> ขนาด <?php echo $hp?>HP
						</td>
						
						
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"><?php echo number_format($price, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($price, 2, '.', ',');?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp; - ใช้กับน้ำยา R404a ไฟฟ้า 3 เฟส</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">2. ชุดคอนเด็นซิ่ง <?php echo $condensing;?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					
				
					
					<tr class="highs" style="">
						<td class="l">3. อุปกรณ์ภายใน </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
    
   				    <tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp; - Receive Tank, Filter Drier, Sign Glasses, Solinoid Valve </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;  - Oil Seperator</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<?php if($tidtung==1){ ?>
						
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp; - ท่อทองแดงระยะไม่เกิน 10 เมตร และอุปกรณ์ติดตั้งอื่นๆ </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<?php } ?>
					
					<?php if($meecoil==1){ ?>
						<tr class="highs" style="">
							<td class="l">4. คอยล์เย็น ยี่ห้อ  <?php echo $cool_name; ?></td>
							<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
							<td class="l" align="center"></td>
							<td class="l" align="right"></td>
						</tr>
						
						<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp; - พร้อม Expansion Valve อุปกรณ์ฉีดน้ำยา</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<?php } ?>
					
					<?php if($contbox==1){ ?>
						<tr class="highs" style="">
						<td class="l">5. ระบบไฟฟ้า และระบบควบคุมห้องเย็น <strong><u> 3 เฟส</u></strong> ประกอบพร้อมใช้งาน</td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"><?php echo number_format($controlprice, 2, '.', ',');?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - Carel easy, Phase protection, Overload, Magnetic, Brecker</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - ตู้คอนโทรลเบอร์ 4 กันน้ำกันฝุ่น, ไฟแสดงสถานะ และสวิตซ์ ON/OFF </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<?php } ?>

					<tr class="highs" style="">
						<td class="l">6. ค่าจัดส่งสินค้า</td>
						<td colspan="2" class="l" align="center">1 งาน</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"><?php echo number_format($shipcost, 2, '.', ',');?></td>
					</tr>
					
					
					<?php if($tidtung==1){ ?>
						<tr class="highs" style="">
							<td class="l">7. ค่าติดตั้งและเดินทาง</td>
							<td colspan="2" class="l" align="center">1 งาน</td>
							<td class="l" align="center"></td>
							<td class="l" align="right"><?php echo number_format($install_raka, 2, '.', ',');?></td>
						</tr>
					<?php } ?>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					<tr>
						<td rowspan="3">
							<div style="width:100%" ;="">
								<div style="width:30%; float:left;">
									<img style="width:100px; height:100px;" src="../content/images/social/frame2.png">
								</div>
								<div style="width:70%; float:left; height:100px;">
									<p align="left;" style="margin-top:35px;"> ข้อมูลเพิ่มเติม SCAN ME </p>
								</div>
							</div>
						</td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($set_price, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ภาษีมูลค่าเพิ่ม 7%</td>
						<td class="rt l" align="right"><?php echo number_format($vats, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" id="totolprice"><?php echo number_format($amount, 2, '.', ',');?></td> 
					</tr>
				
				</tbody></table>
			</div><!--end product_price-->
			
			
			
			<div id="amount" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left"><span style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน </span> &nbsp;&nbsp; <?php if($tidtung == 1 ) { echo '(ภาษีหักที่จ่าย ได้เฉพาะค่าติดตั้งห้องเย็น)';}?> </td>
						</tr>
						
						<?php if($tidtung == 0 ) {?>
							<tr>
								<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   70%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
								<td align="left" style="width: 35%"><span class="cal_ngo1"><?php echo number_format($ngod1, 2, '.', ',');?></span> บาท</td>
							</tr>
							
							<tr>
								<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระก่อนจัดส่งอุปกรณ์ </td>
								<td align="left"><span class="cal_ngo2"><?php echo number_format($ngod2, 2, '.', ',');?></span> บาท</td>
							</tr>
						
						<?php } else { ?>
							<tr>
								<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   50%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
								<td align="left" style="width: 35%"><span class="cal_ngo1"><?php echo number_format($ngod1, 2, '.', ',');?></span> บาท</td>
							</tr>
							
							<tr>
								<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระก่อนจัดส่งอุปกรณ์ </td>
								<td align="left"><span class="cal_ngo2"><?php echo number_format($ngod2, 2, '.', ',');?></span> บาท</td>
							</tr>
							
							<tr>
								<td align="left"> <span style="text-decoration: underline;">งวดที่ 3</span>   20% ชำระเมื่อใช้งานได้เรียบร้อย</td>
								<td align="left"><span class="cal_ngo3"><?php echo number_format($ngod3, 2, '.', ',');?></span> บาท</td>
							</tr>
						<?php } ?>
						
						
						<?php
						if($corp == 2) { 
							
					?>
						<tr>
							<td colspan="2" align="left">บัญชีธนาคารกสิกรไทย </td>
							<tr>
								<td colspan="2" align="left">  บจ.ซีพีเอ็น888  เลขที่บัญชี <!--ชื่อบัญชี เดชาธร ผลินธร--> <span style="text-decoration: underline; font-weight: bold;"> 075-8-81892-6 <!--855-2-01920-3--></span></td>
							</tr>
						</tr>
					<?php } else { ?>
						
						<tr>
							<td colspan="2" align="left">บัญชีธนาคารกสิกรไทย </td>
							<tr>
								<td colspan="2" align="left">  บจ.ซีพีเอ็น888  เลขที่บัญชี <!--ชื่อบัญชี เดชาธร ผลินธร--> <span style="text-decoration: underline; font-weight: bold;"> 075-8-81892-6 <!--855-2-01920-3--></span></td>
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
							<td align="left">  ส่งสินค้า <?php if($tidtung == 1 ) { ?> และติดตั้ง<?php } ?> ภายใน 20 วันหลังจากได้รับมัดจำงวดที่ 1</td>
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
					<span>(นายภูริชญ์ โชคอุตสาหะ)</span> <br><br>
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
	
	
	<?php if($hasrooms == 1) { include('hasroom.php'); }?> 
	
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
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 2</div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายละเอียดแนบท้ายใบเสนอราคา</span></p>
			</div>
			
			
			
			
			<div class="container">
				<div class="row">
					<div class="col3">
						<div style="width: 300px; height:280px; background: orange;">
								<img src="../content/images/quotation/<?php echo $com_img.$fancon;?>.jpg">
						</div>
					</div>
					<div class="col4"><span class="topic">ชุดคอนเด็นซิ่งยูนิต ประกอบด้วย</span><br>
						<p><span class="intopic">คอมเพรสเซอร์ :</span> 
							<?php echo $compressor_name.  ' ขนาด '.$hp.'HP'; ?>
						</p>
						<p><span class="intopic">ชุดคอยล์ร้อน :</span> ระบายความร้อนด้วยอากาศ <?php echo $fancon; ?> พัดลม</p>
						<p><span class="intopic">ไฮ-โล เพรสเชอร์ :</span> อุปกรณ์วัดระดับแรงดันน้ำยา</p>
						<p><span class="intopic">รีซีฟเวอร์และวาล์วนิรภัย :</span></p>
						<p><span class="intopic">เช็ควาล์วและเซอร์วิสวาล์ว :</span> </p>
						<p><span class="intopic">ดรายเออร์ :</span> อุปกรณ์กรอกสิ่งสกปรกออกจากระบบทำความเย็น</p></div>
				</div> <!--end row-->
				
				<div class="row">
					<div class="col1">
						<span class="topic">ชุดคอยล์เย็น</span><br>
						<p><span class="intopic">ยีห้อ (แบรนด์):</span> <?php echo $cool_name;?></p>
						<p><span class="intopic">รุ่น :</span> <?php echo $cool_name;?> </p>
						<p><span class="intopic">จำนวนพัดลม/ขนาดใบพัด :</span> 2 x 350 mm</p>
						<p><span class="intopic">ระยะส่งลม :</span> 5 เมตร </p>
						<p><span class="intopic">ระยะครีบ (ฟิย) :</span> 7 mm</p>
						<p><span class="intopic">สวิตซ์ :</span> เปิด-ปิดการทำงานของเครื่องทำความเย็น</p>
						
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/<?php echo $cool_img;?>.jpg">
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
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');
				?>
			</div><!--end cover_header-->
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;">หน้า 3</div>
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
						<p><span class="intopic">น้ำยาทำความเย็น :</span> ชนิด R404a</p>
						<p><span class="intopic">ท่อทองแดง : </span> Type L สำหรับส่งน้ำยาในระบบ รวมถึงข้อต่อต่างๆ</p>
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
						<p><span class="intopic">ตู้ควบคุม :</span> ได้มาตารฐาน IP65 กันน้ำ กันฝุ่น</p>
						
					</div>
					<div class="col2">
						<div style="width: 300px; height:280px; background: orange;">
							<img src="../content/images/quotation/0001.jpg">
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
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');
				?>
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
						<span class="topic">ฮีทเตอร์สำหรับละลายน้ำแข็ง (Defrost)</span><br>
						<p><span class="intopic">ฮีทเตอร์คอยเย็น :</span> ป้องกันน้ำแข็งเกาะบริเวณฟินที่คอยล์เย็น</p>
						
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
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');
				?>
			</div><!--end cover_header-->
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;"></div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายการอุปกรณ์ติดตั้งเพิ่มเติม</span></p>
			</div>
			
			
			<div id="product_price" style="margin-top:10px; clear:both; ">
				<table style="width:100%; border: 1px solid black; font-size:14px;">
						<tbody><tr>
							<td colspan="3" align="center" class="suptopic">รายการ อุปกรณ์ติดตั้งเครื่อง</td>
						</tr>
						
						
						
						<tr class="column-text">
							<td># </td>
							<td align="center">รายการ</td>
							<td>จำนวน (หน่วย ชิ้น)</td>
						</tr>
						<tr>
							<td colspan="3" align="center"><hr></td>
						
						</tr> 
						
						<tr>
							<td colspan="3" align="left" style="font-weight:bold; font-family: Kanit, sans-serif">อุปกรณ์ติดตั้งเครื่อง</td>

						</tr>


						<tr>
								<td style="font-size:12px;">1 </td>
								<td>ข้อต่อทองแดง 3 ทาง 4 หุน 1/2</td>
								<td>3 ตัว</td>
							</tr>
							
							
							
							<tr>
								<td style="font-size:12px;">2 </td>
								<td>ข้องอทองแดง 90 องศา 6 หุน 3/4</td>
								<td>10 ตัว</td>
							</tr>
							
							
							<tr>
								<td style="font-size:12px;">3 </td>
								<td>ข้องอทองแดง 90องศา 4 หุน 1/2 ยาว</td>
								<td>10 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">4 </td>
								<td>ดรายเออร์ (Drier) 4 หุน 1/2 </td>
								<td>1 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">5 </td>
								<td>ท่อทองแดง 1/2</td>
								<td>5 เส้น</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">6 </td>
								<td>ท่อทองแดง 3/4L</td>
								<td>3 เส้น</td>
							</tr>
													
					
							
							<tr>
								<td style="font-size:12px;">7 </td>
								<td>น้ำยา R404</td>
								<td>1 ถัง</td>
							</tr>
							
							
							
							
							
							<tr>
								<td style="font-size:12px;">8 </td>
								<td>เช็ควาล์ว 4 หุน 1/2 </td>
								<td>2 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">9</td>
								<td>แค้มป์ยึดท่อทองแดง3/8</td>
								<td>15 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">10 </td>
								<td>แฟร์ 2 หุน 1/4</td>
								<td>4 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">11 </td>
								<td>แฟร์ 4 หุน 1/2</td>
								<td>2 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">12 </td>
								<td>แหวนสะปริง</td>
								<td>12 ตัว</td>
							</tr>
													
							<tr>
								<td style="font-size:12px;">13 </td>
								<td>แหวนอีแปะ</td>
								<td>12 ตัว</td>
							</tr>
							

							<tr>
								<td style="font-size:12px;">14 </td>
								<td>ก้ามปู 16 mm</td>
								<td>15 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">15 </td>
								<td>ก้ามปู 32 mm</td>
								<td>15 ตัว</td>
							</tr>
							
							
							<tr>
								<td style="font-size:12px;">16 </td>
								<td>ก้ามปู PVC 3/4</td>
								<td>6 ตัว</td>
							</tr>
							
													
							
							<tr>
								<td style="font-size:12px;">17 </td>
								<td>ท่อ PVC 6 หุน 3/4</td>
								<td>4 เส้น</td>
							</tr>
													<tr>
								<td style="font-size:12px;">18 </td>
								<td>ท่ออ่อน 16mm</td>
								<td>5 เส้น</td>
							</tr>
													<tr>
								<td style="font-size:12px;">19</td>
								<td>ท่ออ่อน 32mm</td>
								<td>5 เส้น</td>
							</tr>
					
													<tr>
								<td style="font-size:12px;">20 </td>
								<td>แป้นสตัส 6 นิ้ว แขวนคอยล์เย็น</td>
								<td>8 ตัว</td>
							</tr>
							
							<tr>
								<td colspan="3" align="center"> &nbsp;</td>
							</tr> 
						
							
						

						
					</tbody></table>
			</div>
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
			
			<div style="width: 100%; clear:both; height: 10px;">
				<div style="float: right;"></div>
			</div>
			
			<div style="width: 100%; clear:both; height: 40px;">
				<p style="text-align:center;"><span class="intopic" style="font-size:20px; text-decoration:underline;">รายการอุปกรณ์ติดตั้งเพิ่มเติม</span></p>
			</div>
			
			
			<div id="product_price" style="margin-top:10px; clear:both; ">
				<table style="width:100%; border: 1px solid black; font-size:14px;">
						<tbody><tr>
							<td colspan="3" align="center" class="suptopic">รายการ อุปกรณ์ติดตั้งเครื่อง</td>
						</tr>
						
						
						
						<tr class="column-text">
							<td># </td>
							<td align="center">รายการ</td>
							<td>จำนวน (หน่วย ชิ้น)</td>
						</tr>
						<tr>
							<td colspan="3" align="center"><hr></td>
						
						</tr> 
						
						<!--<tr>
								<td colspan="3" align="left" style="font-weight:bold; font-family: Kanit, sans-serif">ระบบละลายน้ำแข็ง ดีฟรอส</td>
							</tr>
							<tr>
								<td style="font-size:12px;">1 </td>
								<td>Solienoid โซลินอยล์ Sanhua 1/2 SxS MDF-A36H   </td>
								<td>2 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">2 </td>
								<td>บอลวาล์ว 4 หุน 1/2 7022</td>
								<td>2 ตัว</td>
							</tr>
							
							<tr>
								<td colspan="3" align="center"> &nbsp;</td>
							</tr>--> 

						
							<tr>
								<td colspan="3" align="left" style="font-weight:bold; font-family: Kanit, sans-serif">อุปกรณ์ติดตั้งระบบไฟฟ้า</td>
							</tr>	
							
							
						
													
							
							<tr>
								<td style="font-size:12px;">1 </td>
								<td>สายTHW 1x2.5 สีขาว, สีดำ, สีแดง อย่างละ 1 ม้วน</td>
								<td>3 ม้วน</td>
							</tr>
							
							
													<tr>
								<td style="font-size:12px;">2 </td>
								<td>สายVSF 1x1 สีขาว, สีดำ, สีแดง อย่างละ 1 ม้วน </td>
								<td>1 ม้วน</td>
							</tr>
	
							<tr>
								<td style="font-size:12px;">3 </td>
								<td>สายชิว 3x1 </td>
								<td>5 เมตร</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">4 </td>
								<td>ข้อต่อสีขาว 16 mm</td>
								<td>15 ตัว</td>
							</tr>
													<tr>
								<td style="font-size:12px;">5 </td>
								<td>ข้อต่อสีขาว 32 mm</td>
								<td>15 ตัว</td>
							</tr>
													<tr>
								<td style="font-size:12px;">6</td>
								<td>คอนเน็คเตอร์ 16mm</td>
								<td>15 ตัว</td>
							</tr>
													<tr>
								<td style="font-size:12px;">7 </td>
								<td>คอนเน็คเตอร์ 32 mm</td>
								<td>15 ตัว</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">8 </td>
								<td>ท่อขาว 16mm</td>
								<td>2 เส้น</td>
							</tr>
						
							<tr>
								<td style="font-size:12px;">9 </td>
								<td>ท่อขาว 32mm</td>
								<td>4 เส้น</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">10 </td>
								<td>บ็อกกันน้ำ 4x4 </td>
								<td>1 กล่อง</td>
							</tr>
							
							
							<tr>
								<td style="font-size:12px;">11 </td>
								<td>บ็อกกันน้ำกันฝุ่น 1 ช่อง</td>
								<td>1 กล่อง</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">12 </td>
								<td>รางสายไฟแบบปิดสีขาว 40</td>
								<td>2 เส้น</td>
							</tr>
													<tr>
								<td style="font-size:12px;">13 </td>
								<td>รางสายไฟแบบปิดสีขาว 40</td>
								<td>1 เส้น</td>
							</tr>
							
							<tr>
								<td style="font-size:12px;">14 </td>
								<td>รางสายไฟแบบโปร่ง (สีเทา)</td>
								<td>1 เส้น</td>
							</tr>
							
							<tr>
								<td align="right" class="summary"> &nbsp; </td>
								<td colspan="2" align="right" class="summary">  </td>
								<td>&nbsp; </td>
							</tr>
							
							
						
						
						

						
					</tbody></table>
			</div>
			<div class="conclude" style="clear: both; line-height:18px;"></div><!--end conclude -->
			<br><br><br>
			<div class="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div>
	
	
</div>
<input type="button" value="คำนวนงวดเครื่อง" id="btn-calngod">
<input type="button" value="คำนวนงวดห้อง" id="calroom">
<div style="display:none;" id="installs"><?php echo $tidtung;?></div>

<div style="display:none;" id="cduprice"><?php echo $cdu_cost*1.1;?></div>
<div style="display:none;" id="coolerprice"><?php echo $cooler_cost*1.1;?></div>
<div style="display:none;" id="install_price"><?php echo $install_price;?></div>
<div style="display:none;" id="controlprice"><?php echo $controlprice;?></div> 
<div style="display:none;" id="shipcost"><?php echo $shipcost;?></div>

<div style="display:none;" id="">---------------------</div>


<div style="display:none;" id="foams_type"><?php echo $foams;?></div>
<div style="display:none;" id="foaminch"><?php echo $foaminch;?></div>
<div style="display:none;" id="costfoam"><?php echo $wall_price;?></div>

<div style="display:none;" id="sqmwall"><?php echo $sqmwall;?></div>
<div style="display:none;" id="sqmpedan"><?php echo $sqmpedan;?></div>
<div style="display:none;" id="sqmfloor"><?php echo $sqmfloor;?></div>
<div style="display:none;" id="sqm-isowall-sum"><?php echo number_format($sqmsum, 2, '.', ',');?></div> 
<div style="display:none;" id="foam_sum_price"><?php echo number_format($foam_sum_price, 2, '.', ',');?></div>

<div style="display:none;" id="wall_and_door"><?php echo number_format($wall_and_door, 2, '.', ',');?></div> 
<div style="display:none;" id="kumrai"><?php echo number_format($kumrai, 2, '.', ',');?></div>
<div style="display:none;" id="vats"><?php echo number_format($vats, 2, '.', ',');?></div>
<div style="display:none;" id="kaivat"><?php echo number_format($kaivat, 2, '.', ',');?></div>

</body>
</html>
