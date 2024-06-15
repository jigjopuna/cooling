<?php session_start();
	  include('../include/connect.php');
      include('../include/thaibaht.php');
	  $nDay   = date("w");
	  $nMonth = date("n");
	  $date   = date("j");
	  $year   = date("Y");
	  $years   = date("Y")+543;
	  $thatdate = $date."-".$nMonth."-".$year;
	  
	  if($nMonth==01){
		  $mon = 'มกราคาม';
	  }else if ($nMonth==02){
		  $mon = 'กุมภาพันธ์';
	  }else if ($nMonth==03){
		  $mon = 'มีนาคม';
	  }else if ($nMonth==04){
		  $mon = 'เมษายน';
	  }else if ($nMonth==05){
		   $mon = 'พฤษภาคม';
	  }else if ($nMonth==06){
		   $mon = 'มิถุนายน';
	  }else if ($nMonth==07){
		   $mon = 'กรกฏาคม';
	  }else if ($nMonth==08){
		   $mon = 'สิงหาคม';
	  }else if ($nMonth==09){
		   $mon = 'กันยายน';
	  }else if ($nMonth==10){
		   $mon = 'ตุลาคม';
	  }else if ($nMonth==11){
		   $mon = 'พฤศจิกายน';
	  }else if ($nMonth==12){
		   $mon = 'ธันวามคม';
	  }
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="ราคาห้อง และโฟม" />
	<meta name="description" content="ราคาห้อง และโฟม" />
	<?php include('../sys/include/metatagsys.php');?>
	<title>ใบแจ้งหนี้ห้องเช่า</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
	<link type="text/css" rel="stylesheet" href="../css/billsignature.css">
</head>
<body>
<?php 
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../../sys/pages/login/login.php';</script>");}

	$bill_head = 'ใบเสร็จรับเงิน/ใบกำกับภาษี';
?>



<div class="book">
<form method="post" action="pfq.php"id="form1">
	<div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
								<img src="https://topcooling.net/content/images/logo-small-cpn.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				<span>บริษัท ซีพีเอ็น888 จำกัด 108 หมู่ 12 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>CPN888 Co.,Ltd 108 M.12 TUPLOUNG MUEANG NAKORN PATHOM 73000</span><br>
				<span>Tel. 034-001155, 083-125-1868 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0735563000439 </span><br>
				<span>Web: https://cpn888.co.th</span>
				</div>			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
								ใบแจ้งหนี้
			</div>
						<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;">
					<p style="padding-left: 20px;">รหัสลูกค้า / Code : <br>
					นามลูกค้า / Name : บริษัท ต่อปาก ฟู๊ดแอนด์มาร์เก็ตติ้ง จำกัด<br> 
					ที่อยู่ / Address: 
					388/267 หมู่ที่ 10 ต.หนองปรือ อ.บางละมุง จ.ชลบุรี					<br> 
					โทรศัพท์ / Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 097-0701080<br>
					เลขที่ประจำตัวผู้เสียภาษี / Tax ID :0205560023963
				</p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $thatdate;?><br>  					
					
					เลขที่ใบแจ้งหนี้/  No. : C562<br>
					ชนิดการขาย :  เงินสด </p>
				</div>
			</div>
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width: 100%;">
					<tbody><tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align="center">จำนวน</td>
						<td style="width:12%;" align="center">หน่วยนับ</td>
						<td style="width:12%;" align="center">ราคา</td>
						<td style="width:12%;" align="center">รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td>&nbsp;</td>
						<td>กำหนดชำระวันที่ 31 <?php echo $mon.' '.$years;?> </td>
						<td align="right"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>  
					</tr>
					
					<tr>
						<td>1</td>
						<td>ค่าบริการเช่าห้องเย็น</td>
						<td align="right">1</td>
						<td align="center">ห้อง</td>
						<td align="center">12,000.00</td>
						<td align="center">12,000.00</td>  
					</tr>
					
					<tr>
						<td>2</td>
						<td>ค่าไฟฟ้า</td>
						<td align="right">1,260</td>
						<td align="center">หน่วย</td>
						<td align="center">7.00</td>
						<td align="center">8,820.00</td>  
					</tr>
				</tbody></table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p> </p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.ไทยพานิชย์ บจก.ซีพีเอ็น888 เลขที่บัญชี 830-249575-5 (ออมทรัพย์)  <!-- ธ.กสิกรไทย  เดชาธร ผลินธร เลขที่บัญชี 855-2-01920-3 (ออมทรัพย์) -->
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tbody><tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right">20,820.00</td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td>ภาษีมูลค่าเพิ่ม 7% </td>
							<td align="right">1,457.40</td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right">22,277.40</td>
						</tr>
					</tbody></table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>				
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; กัญญาณัฐ เย็นสุข &nbsp;&nbsp;)</div>	
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; จุฑามาศ ชาญชัยเดชาชัย &nbsp;&nbsp;)</div>		
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div>
	
	<div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
								<img src="https://topcooling.net/content/images/logo-small-cpn.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				<span>บริษัท ซีพีเอ็น888 จำกัด 108 หมู่ 12 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>CPN888 Co.,Ltd 108 M.12 TUPLOUNG MUEANG NAKORN PATHOM 73000</span><br>
				<span>Tel. 034-001155, 083-125-1868 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0735563000439 </span><br>
				<span>Web: https://cpn888.co.th</span>
				</div>			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
								ใบแจ้งหนี้ 
</div>
						<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;">
					<p style="padding-left: 20px;">รหัสลูกค้า / Code : C896<br>
					นามลูกค้า / Name : บริษัท วีว่า ฟู้ด แอนด์ โปรดักส์ จำกัด<br> 
					ที่อยู่ / Address: 
					427 ถนนเลียบคลองสอง แขวงบางชัน เขตคลองสามวา กรุงเทพมหานคร 10510					<br> 
					โทรศัพท์ / Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 0809250470<br>
					เลขที่ประจำตัวผู้เสียภาษี / Tax ID : 0105559176388</p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $thatdate;?><br>  					
					
					เลขที่ใบแจ้งหนี้ /  No. : 
					
					 C6609-597 <br>
					ชนิดการขาย :  เงินสด </p>
				</div>
			</div>
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width: 100%;">
					<tbody><tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align="center">จำนวน</td>
						<td style="width:12%;" align="center">หน่วยนับ</td>
						<td style="width:12%;" align="center">ราคา</td>
						<td style="width:12%;" align="center">รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					

                    <tr>
						<td></td>
						<td>รอบชำระวันที่ 31  <?php echo $mon.' '.$years;?> </td>
						<td align="right"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>  
					</tr>
					<tr>
						<td>1</td>
						<td>ค่าบริการเช่าห้องเย็น</td>
						<td align="right">1</td>
						<td align="center">ห้อง</td>
						<td align="center">14,000.00</td>
						<td align="center">14,000.00</td>  
					</tr>
				</tbody></table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p></p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.ไทยพานิชย์ บจก.ซีพีเอ็น888 เลขที่บัญชี 830-249575-5 (ออมทรัพย์)  <!-- ธ.กสิกรไทย  เดชาธร ผลินธร เลขที่บัญชี 855-2-01920-3 (ออมทรัพย์) -->
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tbody><tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right">14,000.00</td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td>ภาษีมูลค่าเพิ่ม 7% </td>
							<td align="right">980.00</td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right">14,980.00</td>
						</tr>
					</tbody></table>
				
				</div>
				
					<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>				
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; กัญญาณัฐ เย็นสุข &nbsp;&nbsp;)</div>	
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; จุฑามาศ ชาญชัยเดชาชัย &nbsp;&nbsp;)</div>		
				</div>			
			</div>
			

        </div>  <!--end subpage-->
    </div>
	
	<div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
								<img src="https://topcooling.net/content/images/logo-small-cpn.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				<span>บริษัท ซีพีเอ็น888 จำกัด 108 หมู่ 12 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>CPN888 Co.,Ltd 108 M.12 TUPLOUNG MUEANG NAKORN PATHOM 73000</span><br>
				<span>Tel. 034-001155, 083-125-1868 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0735563000439 </span><br>
				<span>Web: https://cpn888.co.th</span>
				</div>			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">ใบแจ้งหนี้</div>
						<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;">
					<p style="padding-left: 20px;">รหัสลูกค้า / Code : C488<br>
					นามลูกค้า : บริษัท โหระพาแคทเทอริ่ง จำกัด (สำนักงานใหญ่)<br> 
					ที่อยู่ : 
					1649/1 ซอยจรัญสนิทวงศ์ 75 แขวงบางพลัด เขตบางพลัด กรุงเทพมหานคร 					<br> 
					โทรศัพท์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 0981818849<br>
					เลขที่ประจำตัวผู้เสียภาษี  : 0105564155644</p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $thatdate;?><br>  					
					
					เลขที่ใบแจ้งหนี้ /  No. : 
					
					C488<br>
					ชนิดการขาย :  เงินสด </p>
				</div>
			</div>
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width: 100%;">
					<tbody><tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align="center">จำนวน</td>
						<td style="width:12%;" align="center">หน่วยนับ</td>
						<td style="width:12%;" align="center">ราคา</td>
						<td style="width:12%;" align="center">รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					
					<tr>
						<td></td>
						<td>รอบชำระวันที่ 16  <?php echo $mon.' '.$years;?> </td>
						<td align="right"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>  
					</tr>
					
					<tr>
						<td>1</td>
						<td>ค่าบริการเช่าห้องเย็น </td>
						<td align="right">1</td>
						<td align="center">ห้อง</td>
						<td align="center">15,000.00</td>
						<td align="center">15,000.00</td>  
					</tr>
				</tbody></table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p></p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.ไทยพานิชย์  บจก.ซีพีเอ็น888 เลขที่บัญชี 830-249575-5 (ออมทรัพย์)  <!-- ธ.กสิกรไทย  เดชาธร ผลินธร เลขที่บัญชี 855-2-01920-3 (ออมทรัพย์) -->
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tbody><tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right">15,000.00</td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td>ภาษีมูลค่าเพิ่ม 7% </td>
							<td align="right">1,050.00</td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right">16,050.00</td>
						</tr>
					</tbody></table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>				
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; กัญญาณัฐ เย็นสุข &nbsp;&nbsp;)</div>	
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; จุฑามาศ ชาญชัยเดชาชัย &nbsp;&nbsp;)</div>		
				</div>
			</div>
			
        </div>  <!--end subpage-->
    </div>
	<div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
								<img src="https://topcooling.net/content/images/logo-small-cpn.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				<span>บริษัท ซีพีเอ็น888 จำกัด 108 หมู่ 12 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>CPN888 Co.,Ltd 108 M.12 TUPLOUNG MUEANG NAKORN PATHOM 73000</span><br>
				<span>Tel. 034-001155, 083-125-1868 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0735563000439 </span><br>
				<span>Web: https://cpn888.co.th</span>
				</div>			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">ใบแจ้งหนี้</div>
						<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;">
					<p style="padding-left: 20px;">รหัสลูกค้า / Code : C620<br>
					นามลูกค้า / Name : สุพรรษา สาครชัยเจริญ<br> 
					ที่อยู่ / Address: 
					499/418 หมู่บ้านแกรนด์วิลเลจ ตำบลหนองดินแดง อำเภอเมืองนครปฐม จังหวัดนครปฐม 73000					<br> 
					โทรศัพท์ / Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 0948300181<br>
					เลขที่ประจำตัวผู้เสียภาษี / Tax ID : </p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $thatdate;?><br>  					
					
					เลขที่ใบแจ้งหนี้ /  No. : 
					
					C620<br>
					ชนิดการขาย :  เงินสด </p>
				</div>
			</div>
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width: 100%;">
					<tbody><tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align="center">จำนวน</td>
						<td style="width:12%;" align="center">หน่วยนับ</td>
						<td style="width:12%;" align="center">ราคา</td>
						<td style="width:12%;" align="center">รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td></td>
						<td> กำหนดชำระวันที่ 15 <?php echo $mon.' '.$years;?></td>
						<td align="right"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>  
					</tr>
					
					<tr>
						<td>1</td>
						<td>ค่าบริการเช่าห้องเย็น </td>
						<td align="right">1</td>
						<td align="center">ห้อง</td>
						<td align="center">12,000.00</td>
						<td align="center">12,000.00</td>  
					</tr>
					
					<tr>
						<td>2</td>
						<td>ค่าไฟฟ้า</td>
						<td align="right">1,297</td>
						<td align="center">หน่วย</td>
						<td align="center">7.00</td>
						<td align="center">9,079.00</td>  
					</tr>
					
					<tr>
						<td> </td>
						<td> หน่วยไฟฟ้าที่เริ่มใช้ 10 กันยายน 9,983 หน่วย</td>
						<td align="right"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>  
					</tr>
					
					
					<tr>
						<td> </td>
						<td> หน่วยไฟฟ้าวันที่ 8 ตุลาคม 11,280  หน่วย</td>
						<td align="right"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>  
					</tr>
					
					
				</tbody></table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p></p><br>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.ไทยพานิชย์  บจก.ซีพีเอ็น888 เลขที่บัญชี 830-249575-5 (ออมทรัพย์)  <!-- ธ.กสิกรไทย  เดชาธร ผลินธร เลขที่บัญชี 855-2-01920-3 (ออมทรัพย์) -->
					</p>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tbody><tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right">21,079.00</td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td>ภาษีมูลค่าเพิ่ม 7% </td>
							<td align="right">1,475.53</td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right">22,554.53</td>
						</tr>
					</tbody></table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>				
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; กัญญาณัฐ เย็นสุข &nbsp;&nbsp;)</div>	
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; จุฑามาศ ชาญชัยเดชาชัย &nbsp;&nbsp;)</div>		
				</div>
			</div>
			
        </div>  <!--end subpage-->
    </div>
	
	<div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
								<img src="https://topcooling.net/content/images/logo-small-cpn.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				<span>บริษัท ซีพีเอ็น888 จำกัด 108 หมู่ 12 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>CPN888 Co.,Ltd 108 M.12 TUPLOUNG MUEANG NAKORN PATHOM 73000</span><br>
				<span>Tel. 034-001155, 083-125-1868 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0735563000439 </span><br>
				<span>Web: https://cpn888.co.th</span>
				</div>			</div><!--end cover_header-->
				
				
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				ใบแจ้งหนี้ / ใบวางบิล			</div>
						<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;">
					<p style="padding-left: 20px;">รหัสลูกค้า / Code : C627<br>
					นามลูกค้า / Name : รัตนา ศรีสุวรรณโณ<br> 
					ที่อยู่ / Address: 
					88/4 หมู่ 1 ตำบลสนามแย้ อำเภอท่ามะกา จังหวัดกาญจนบุรี 71120					<br> 
					โทรศัพท์ / Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 092-4725882<br>
					เลขที่ประจำตัวผู้เสียภาษี / Tax ID : </p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $thatdate;?><br>  					
					
					
					
					เลขที่ใบแจ้งหนี้ /  No. : C627<br>
					ชนิดการขาย :  เงินสด </p>
				</div>
			</div>
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width: 100%;">
					<tbody><tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align="center">จำนวน</td>
						<td style="width:12%;" align="center">หน่วยนับ</td>
						<td style="width:12%;" align="center">ราคา</td>
						<td style="width:12%;" align="center">รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					
					<tr>
						<td></td>
						<td> กำหนดชำระวันที่ 15 <?php echo $mon.' '.$years;?></td>
						<td align="right"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>  
					</tr>
					
					<tr>
						<td>1</td>
						<td>ค่างวดห้องเย็นเก็บสินค้า</td>
						<td align="right">1</td>
						<td align="center">ห้อง</td>
						<td align="center"></td>
						<td align="center">14,953.27</td>  
					</tr>
				</tbody></table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p></p><br>
					
										
					
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.ไทยพานิชย์  บจก.ซีพีเอ็น888 เลขที่บัญชี 830-249575-5 (ออมทรัพย์) 
					</p>
					
											
					
					
				
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tbody><tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right">14,953.27</td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>  ภาษีมูลค่าเพิ่ม 7% </td>
							<td align="right">1,046.73</td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right">16,000.00</td>
						</tr>
					</tbody></table>
				
				</div>
				
				<div id="signature">	
					<div class="sign">ผู้อนุมัติ ...........................</div>				
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>				
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; กัญญาณัฐ เย็นสุข &nbsp;&nbsp;)</div>	
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; จุฑามาศ ชาญชัยเดชาชัย &nbsp;&nbsp;)</div>		
				</div>			
			</div>
			

        </div>  <!--end subpage-->
    </div>
	
	
</form>
	
</div>
</body>
</html>