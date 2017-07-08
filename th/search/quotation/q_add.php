<?php session_start();
	  require_once('../../sys/include/connect.php');
	  
	  
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />
	<title>ใบเสนอราคาอุปกรณ์ห้องเย็น</title>
</head>
<body>
<?php require_once('../../include/googltag.php');

	/*
	  
		ใน inbasket ต้องมีจำนวนสินค้าว่าลูกค้าจะเอากี่ชิ้น เช่นเอา expand 2 ตัว  sign glasses 3 ตัวที่อยู่ในตะกร้าเดียวกัน และมียอดรวมของแต่ละสินค้า หลังจากผ่าน โปรโมชั่นหรือ voucher code หรือ ลูกค้า พรีเมียม
		ALTER TABLE `tb_inbasket` ADD `ib_qty` FLOAT NOT NULL AFTER `p_id`, ADD `ib_amont` FLOAT NOT NULL AFTER `ib_qty`;
		
		ใน basket ต้องมีบอก status ว่าตะกร้านี้ถูก checkout ไปแล้วหรือยัง  มีว่าตะกร้านี้ลูกค้าใช้โปรโมชั่นอะไร และมี คะแนนสะสมให้ด้วย
		ALTER TABLE `tb_basket` ADD `b_status` INT NOT NULL AFTER `b_type`;  b_promo VARCHAR(100) b_point FLOAT
	  */
	  
	  
	  if(isset($_SESSION['ss_basket_id'])){ //เช็คว่ามีตะกร้า id แล้วหรือยัง
		 $basket_id = $_SESSION['ss_basket_id'];
	  }else{ 
		  exit("<script>alert('ยังไม่มีสินค้าในตะกร้า กรุณาเลือกสินค้าก่อนนะคะ');
				window.location = '../product/expand.php';
				</script>");
		  
	  }
	  
	   if(isset($_SESSION['ss_user_id'])){ 
		 $user_id = $_SESSION['ss_user_id'];
		 
		}else {
			$user_id = '';
		}
		
		if(isset($_SESSION['ss_user_type'])){ 
		 $user_type = $_SESSION['ss_user_type'];
		 
		}else {
			$user_type = '';
		}


?>
<style>

body {
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 21cm;
        min-height: 31cm;
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
       /* padding: 1cm;*/
        border: 1px white solid;
        height: 256mm;
       /*outline: 2cm #FFEAEA solid;*/
    }
	table { font-size: 10pt; }
	tr { height: 25px;}
	td.rlb{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; }
	td.rlt{ border-right:solid black 1px; border-left:solid black 1px;border-top:solid black 1px; }
	td.all{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; border-top:solid black 1px; }
	td.rl{ border-right:solid black 1px; border-left:solid black 1px; }
	td.rt{ border-right:solid black 1px; border-top:solid black 1px; }
	td.r{ border-right:solid black 1px;  }
	td.l{ border-left:solid black 1px; padding: 0 5px 0 0; }
	td.br{ border-right:solid black 1px;  border-bottom:solid black 1px;}
	td.b{border-bottom:solid black 1px;}
	td.t{border-top:solid black 1px;}
	tr td:first-child{ padding: 0 0 0 5px; }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            padding-top: 1.5cm;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
</head>

<body>
<?php
	  /*
		==========================================
		|| basket ||  login(u_id) ||
		------------------------------------------
		||   Yes  ||     No       || case 1 ได้ (หมายถึงเข้าหน้า quotation ได้ พร้อมแสดงรายการสินค้าที่จะซื้อ) //guest user 
		||   Yes  ||     Yes      || case 2 ได้ (เอา id ตะกร้ามาใช้ และจะผูกกับ user id ด้วย)
		||   No   ||     Yes      || case 3 ได้ แต่ต้องดูต่อว่าลูกค้าที่ login มาแล้ว สถานะตะกร้าล่าสุดถูก checkout ไปหรือยัง
		||   No   ||     No       || case 4 ดีดกลับไปหน้าสินค้า
		||        ||              ||
		==========================================
		
	  */
	  
	  if($basket_id != '' && $user_id == ''){
		 //echo "case 1 <br>";
		 $sql =  "SELECT * 
				FROM (tb_inbasket inb JOIN tb_basket b ON inb.b_id = b.b_id) 
					 JOIN tb_prodacces p ON p.p_id = inb.p_id 
				WHERE inb.b_id = '$basket_id '";
		 $result = mysql_query($sql);
		 $num = mysql_num_rows($result );
		 
		 
	 } else if($basket_id != '' && $user_id != ''){
		 //echo "case 2 <br>";
		$sql =  "SELECT * 
				FROM (tb_inbasket inb JOIN tb_basket b ON inb.b_id = b.b_id) 
					 JOIN tb_prodacces p ON p.p_id = inb.p_id 
				WHERE inb.b_id = '$basket_id'";
		 $result = mysql_query($sql);
		 $num = mysql_num_rows($result );
		 
	 } else if($basket_id == '' && $user_id != ''){
		 //echo "case 3 <br>";
		
	 
	 }else{
		 
		alertphp('กะ','../product/expand.php');
		 
	 }
	  
	  

	  
	  
	  /*
		query สินค้าที่อยู่ในตะกร้าขึ้นมาแสดง โดยให้สินค้าที่เพิ่ง Add มาขึ้นก่อน
		แล้วถ้ายังไม่ได้ add ตะกร้า ล่ะ จะต้องเช็คอะไรต่อ 
		
		1. เช็ค bassket_id session ตะกร้าก่อน
		2. 
		
		
		1. login หรือยัง
	  
	  */
	  	  
	 

?>



<div class="book">
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php //require_once('../../include/custaddress.php'); ?>
					<span>เรียน : 
						<?php 
						    //$cust_name = 2; $cust_address=3;
							//if($cust_name=='' || $cust_address=='') { 
						?>		
						    <a href="register.php?r_width=<?php echo $r_width;?>&r_length=<?php echo $r_length;?>&r_height=<?php echo $r_height;?>&temparature=<?php echo $temparature;?>&temp_before=<?php echo $temp_before;?>&timeperiod=<?php echo $timeperiod;?>&qty=<?php echo $qty;?>">คลิก เพื่อกรอกชื่อ ทีอยู่</a> 
						
						<?php //} else {  ?>
							<?php //echo $cust_name;?>
						<?php //} ?>
					</span> 
					<span><strong></strong></span><br>
					<span>ที่อยู่ :  	

					<?php/* if($row_custaddr['id']==102) {
						
						  echo $cust_address; echo '  '.$row_custaddr['tum_name']; echo '  '.$row_custaddr['amp_name']; echo '  '.$row_custaddr['pro_name']; echo '  '.$custzip;
						 
						 }else{
							
						  echo $cust_address; if($cust_name!='' && $cust_address!='') { echo '  ต.'; } echo $row_custaddr['tum_name']; if($cust_name!='' && $cust_address!='') { echo '  อ.';} echo $row_custaddr['amp_name']; if($cust_name!='' && $cust_address!='') { echo '  จ.';} echo $row_custaddr['pro_name']; echo '  '.$custzip;
						 }*/
					
					?>
					<?php ?></span><br>
					<span>โทร :  	<?php //echo $cust_tel;?></span><br>
					<span>Email:  	<?php //echo $cust_email;?></span>
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php //echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดสินค้า</td>
					</tr style="border: solid black 1px;">
					
				
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<?php 
						for($i=1; $i<=$num; $i++){
							$row = mysql_fetch_array($result);
							switch ($row['p_cate']) {
								case "1":
									$pdetail = "Your favorite color is red!";
									break;
								case "2":
									echo "Your favorite color is blue!";
									break;
								case "4":
									$pdetail = 'Expandsion '. $row['p_name'].' '.$row['p_model'].' in: '.$row['p_inlet'].' out: '.$row['p_outlet'].' for '.$row['p_numya'];
									break;
								default:
									echo "Your favorite color is neither red, blue, nor green!";
							}
					?>
					
					<tr class="highs" style="">
						<td class="l"><?php echo $pdetail;?></td>
						<td colspan="2" class="l" align="center">1</td>
						<td class="l" align="right"><?php echo number_format($row['p_price'], 0, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row['p_price']*2, 2, '.', ',');?></td>
					</tr>
					
					<?php } ?>
					
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
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				<span><strong><u>เงื่อนไขการคำนวณ</u> </strong></span><br>
				<span>ระยะเวลาลดอุณหภูมิสินค้า :  <?php //echo $timeperiod?> ชั่วโมง</span><br>
				<span>อุณหภูมิสินค้าก่อนเข้าห้อง : <?php //echo $temp_before?> องศาเซลเซียส</span><br>
				<span>ปริมาณสินค้า : <?php //echo number_format($qty, 2, '.', ',') ?> กิโลกรัม</span><br> <br> 
				<span><strong><u>ค่าไฟเฉลี่อต่อเดือน :</u> </strong><?php //echo number_format($totalcur, 2, '.', ','), " บาท   ", " (อัตราค่าไฟปกติ ไม่ใช่ TOU)"; ?> </span><br> 
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
				<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->

    </div> <!--end page-->

</div>
<span style="float:right;"><?php //echo $total_result_t;?></span>
</body>
</html>