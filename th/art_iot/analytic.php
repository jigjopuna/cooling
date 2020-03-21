<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta http-equiv="cache-control" content="max-age=10"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once ('../../include/google_verify.php');?>
<?php require_once ('../../include/googlebot.php');?>
<meta name="copyright" content="topcooling tcl"/>
<meta name="keywords" content="ระบบสมาร์ทห้องเย็น">
<meta name="description" content="จะดีแค่ไหนถ้าเรารู้พฤติกรรมการทำงานของห้องเย็นทั้งระบบ และสามารถควบคุมห้องเย็นได้ด้วยตัวเราเอง รู้ปัญหา แก้ไขได้ทันท่วงที ลดความเสี่ยง ประหยัดค่าไฟ แถมยืดอายุการทำงานของห้องเย็นได้ด้วย ลดต้นทันอีกต่างหาก">
<meta property="og:title" content="ห้องเย็น วิเคราะห์การทำงานระบบทำความเย็น ประหยัดค่าไฟมหาศาล ด้วย IoT"/>
<meta property="og:type" content="article"/>
<meta property="og:image" content="https://topcooling.net/content/images/art_iot/iot/iot.jpg">
<meta property="og:url" content="https://topcooling.net/th/art_iot/analytic.php"/>
<meta property="og:description" content="จะดีแค่ไหนถ้าเรารู้พฤติกรรมการทำงานของห้องเย็นทั้งระบบ และสามารถควบคุมห้องเย็นได้ด้วยตัวเราเอง รู้ปัญหา แก้ไขได้ทันท่วงที ลดความเสี่ยง ประหยัดค่าไฟ แถมยืดอายุการทำงานของห้องเย็นได้ด้วย ลดต้นทันอีกต่างหา"/>
<meta property="fb:app_id" content="574507943122181"/>

<link rel="shortcut icon" href="../../content/images/favicon.png">
<link rel="stylesheet" href="../../sources/css/main.css">
<title>วิเคราะห์ระบบห้องเย็น ประหยัดค่าไฟมหาศาล</title>

<script type="text/javascript" src="../../js/jquery-libs-3-2-1-min.js"></script>
<script src="../../js/main.js"></script>

</head>
<body>
<?php require_once('../../include/googletag.php');?>

<div class="loading-point">

</div>

<?php include('../../sources/inc/inc_menu.php');?>

<div id="sec2" class="section-2">
	<div class="container">
		<div class="row" id="">
			<div class="col-md-12">
				
				<div class="heading" style="text-align: center;">
				
				วิเคราะห์ระบบห้องเย็น
				
				</div><br><br>
				<img src="../../content/images/art_iot/iot/iot.jpg" alt="iot ห้องเย็น"><br><br>
			
				<div class="p_article">
					<h2>กราฟห้องเย็น IoT</h2>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
					<span class="text-strong">มาดูกราฟที่ 1</span> กันครับ เป็นห้องเก็บอาหารทะเล ใช้อุณหภูมิ <span class="text-strong">-​25 องศา</span> จากกราฟ จะมีจุดสังเกตุทั้งหมด 6 จุด ซึ่งทั้ง 6 จุดนี้สามารถอธิบายการทำงานของเครื่องทำความเย็นได้<br><br> 
					<img src="../../content/images/art_iot/iot/analy02.jpg" alt="วิเคราะห์ห้องเย็น"><br>
					<img src="../../content/images/art_iot/iot/analy03.jpg" alt="วิเคราะห์ห้องเย็น"><br>
					<br><br>

					<span class="boldun">1. รู้การทำงาน</span> เราสามารถรู้ได้ว่าใน 1 วัน เครื่องคอมเพรสเซอร์, คอล์ยร้อน และ คอยล์เย็น ทำงาน <span class="text-strong">กี่นาที</span> ฮีทเตอร์ทำงานกี่ครั้งต่อวัน ครั้งละกี่นาที ดูว่าตรงกับที่เราตั้งตัวเทอร์โมสตัสไหม<br><br>

					<span class="boldun">2. รู้สถานะห้องเย็น</span> เรารู้ได้ว่าห้องเย็นทำงานปกติไหม ดูจากกราฟ ถ้ากราฟขึ้นลงเป็น cycle ลักษณะนี้ ถือว่า <span class="text-strong">ปกติ</span> <br><br>
					  ห้องเย็นแต่ละห้องจะมี <span class="text-strong"> พฤติกรรม </span> รูปแบบกราฟแตกต่างกันออกไป ขึ้นอยู่กับการใช้งานของแต่ละห้องเย็น ผมจะให้ดูกราฟหลายๆ แบบนะครับ<br><br>

					<span class="boldun">3. รู้ปัญหาก่อน</span> เรารู้ได้ว่าห้องเย็นหรือเครื่องทำความเย็น <span class="text-strong">มีปัญหา</span>  ตอนไหน เป็นเวลาเท่าไร จะได้แก้ไขปัญหาได้ทันเวลา ดูจากกราฟได้<br>

					<span class="bold_brown">จุดที่ 1</span> คือจุดอุณหภูมิลงต่ำที่สุดที่ -25 องศา จุดนี้คือจุดเครื่องทำความเย็นหยุดทำงานด้วย <br><br>

					<span class="bold_brown">จุดที่ 2</span> อุณหภูมิสูงขึ้นไปถึง -​12 องศา เครื่องจะกลับมาทำงานอีกครั้ง สังเกตุเวลาไหมครับ ว่าใช้เวลากี่นาทีจาก -​25 ขึ้นไปถึง -​12 องศา จะใช้เวลา ประมาณ <span class="text-strong">30 นาที</span> ครับ นั้นหมายถึงว่าเครื่องจะทำงาน 30 นาที หยุด 30 นาที สลับกันไปอย่างนี้ไปเรื่อยๆ<br><br>

					<span class="bold_brown">จุดที่ 3</span> เป็นที่ทำงานต่อเนื่องจากจุดที่ 1 และ 2 <br><br>

					<span class="bold_brown">จุดที่ 4</span> จุดที่ <span class="text-strong">defrost</span> หรือละลายน้ำแข็ง ทำงานเสร็จเรียบร้อย<br><br>
					
					<span class="bold_brown">จุดที่ 5</span> จุดที่ คอมเพรสเซอร์กลับมาทำงาน หลังจาก Defrost เสร็จ ใช้เวลาเพียงประมาณ 30 นาที ก็สามารถดึงอุณหภูมิลงมาถึงอุณหภูมิที่เราต้องค่าไว้ได้<br><br>
					
					<span class="bold_brown">จุดที่ 6</span> ครบรอบ 3 ชั่วโมง จะกลับมา Defrost ใหม่ จนเสร็จเรียบร้อยอีกครั้ง ตามที่ได้ตั้งค่า SET POINT ไว้ และจะเป็น LOOP แบบนี้ไปเรื่อยๆ <br><br>

					จากข้อมูลที่เราทราบ  ลูกค้าสามารถนำข้อมูลไป <span class="text-strong">ประยุกต์</span> วิเคราะห์ระบบห้องเย็นของตัวเองได้ เช่นการคำนวณเรื่องค่าไฟฟ้า และการปรับค่าตัวควบคุมห้องเย็นได้<br><br>



					<h2>กราฟที่ 2 </h2>
					เป็นห้องเย็นเก็บอาหาร ร้านชาบูเก็บแช่ หมู ไก่ อาหารทะเล จากรูปกราฟ มีจุดสังเกตุ 4 จุด ให้เราลองเปรียบเทียบกับกราฟแรกนะครับ กราฟที่ 1 กับ กราฟ 2 ต่างกันยังไงบ้าง <br><br>
					
					<img src="../../content/images/art_iot/iot/analy01.jpg" alt="วิเคราะห์ห้องเย็น"><br>

					ห้องนี้อุณหภูมิ -​12 องศาเซลเซียส แต่ที่ตั้งค่า <span class="text-strong">Set Point</span> จริงๆ อยู่ที่ -15 องศา นั้นหมายความว่า ห้องเย็นเย็นไม่ได้อุณหภูมิที่ต้องการ ทำได้แค่ -12 องศา แต่จริงๆ เราต้องการ -15 องศา<br><br>
					
					ห้องนี้มีการเซ็ตค่าไว้ดังนี้  อุณหภูมิ ตั้งไว้ <span class="text-strong">-15 องศา </span>ระยะเวลาละลายน้ำแข็ง 4 ชั่วโมง ครั้งละ 25 นาที<br><br>
					
					<span class="bold_brown">จุดที่ 1</span> คือจุดอุณหภูมิลงต่ำที่สุดที่ -11 องศา ความต้องการจริงๆ คือ -15 องศา   แต่ถูกตัดการทำงานก่อนด้วย Defrost ละลายน้ำแข็งครบเวลาที่ต้องละลาย<br><br>
					
					
					<span class="bold_brown">จุดที่ 2</span> ใช้เวลา Defrost ประมาณ 25 นาที จากจุดที่ 1 ถึงจุดที่ 2 จากนั้นเครื่องทำความเย็นก็กลับมาทำงานอีกครั้ง<br><br>
					
					<span class="bold_brown">จุดที่ 3</span> คอมเพรสเซอร์ทำงานใช้เวลา ประมาณ <span class="text-strong">3 ชั่วโมงครึ่ง</span> ทำงานหลักจาก Defrost จนมาถึงเวลาการ Defrost ในรอบถัดไปอุณหภูมิก็ได้เพียง -12 องศา เท่านั้น ยังไม่ถึง -15 องศาตามที่ต้องการ<br><br>
					
					
					<span class="bold_brown">จุดที่ 4</span> เหมือนจุดที่ 2 เลยครับ<br><br>
					
					<span class="bold_brown">สังเกต</span> พฤติกรรมห้องเย็นที่ 2 บอกอะไรเราได้บ้าง อย่างแรกที่รู้เลยคือคอมเพรสเซอร์กับคอยล์เย็นทำงานตลอดเวลา <span class="text-strong">ไม่ได้หยุด</span> ทำงานเลย หยุดแค่เพียงช่วงเวลาที่ Defrost ละลายน้ำแข็งเท่านั้น ถ้าเครื่องทำงานลักษณะนี้อาจจะใช้ไฟฟ้ามากกว่าห้องที่ 1 แน่ๆ ค่าไฟก็จะแพงกว่านั้นเอง
					
					<br><br>
					
					<span class="bold_brown">เราจะแก้ปัญหา</span> ที่อุณหภูมิไม่ถึงนี้ได้อย่างไรบ้าง ก็มีหลายสาเหตุนะครับ อย่างเช่น <span class="text-strong">โหลดสินค้า</span> ที่เอาเข้าห้องเย็นอาจกจะใส่มากเกินกว่าปกติเยอะๆ หรือเป็นสินค้าสดปริมาณมาก ไม่สอดคล้องกับขนาดเครื่องทำความเย็นทำให้อุณหภูมิไม่ถึง หรือ มีปัญหาที่ <span class="text-strong">ระบบห้องเย็นเอง</span> ส่วนนี้ก็ต้องไปวิเคราะห์ปัญหาที่หน้างานเอานะครับ บอกคร่าวๆ ได้ประมาณนี้  
					
					
					<br><br>
					
					
					
					<span class="bold_brown">แล้วถ้าห้องเย็นทำงานไม่ปกติล่ะ จะมีอะไรแจ้งเตือนเราไหม</span>
					<br><br>
					 <span class="text-strong">ผมได้พัฒนา</span> ระบบแจ้งเตือนไว้เรียบร้อยแล้วครับผม สบายใจได้ ถ้าเมื่อไรที่ห้อง  <span class="text-strong">มีปัญหา</span> ระบบจะ  <span class="text-strong">แจ้งเตือน</span> ผ่านแอปไลน์ที่ทุกคนใช้กันอยู่แล้ว ไปยังลูกค้าและทีมซ่อมบำรุงห้องเย็นของ ท็อปคูลลิ่ง ทันทีทุกเวลา ไม่ว่าจะกลางวัน หรือกลางคืน ตลอด 24 ชม. เราจะได้แก้ไขปัญหาได้ทันเวลา ก่อนที่สินค้าในห้องเย็นจะเสียหาย 
					<br><br>
					
					<img src="../../content/images/art_iot/iot/alert11.jpg" alt="ซ่อมห้องเย็น"><br><br>

					ถ้าเราไม่ได้อยู่บ้านหรืออยู่บริเวณห้องเย็น ก็สามารถดูอุณหภูมิ ณ ปัจจุบัน และแจ้งเตือนได้ตลอด  ผมขอ <span class="text-strong">ยกตัวอย่าง</span> เคสหนึ่งในรูปด้านล่างนี้ 

					ตอนเวลา  <span class="text-strong">19.15 น.</span> และไม่มีคนอยู่บริเวณห้องเย็นเลย เกิดเหตุการณ์ <span class="text-strong">คอยล์ร้อนตัดการทำงาน</span> เนื่องจากมอเตอร์พัดลมคอยล์ยร้อน กินกระแสไฟฟ้าผิดปกติ ตัวโอเวอร์โหลดจึงตัดการทำงานเพื่อป้องกันไม่ให้มอเตอร์เสียหรือไหม้ ระบบทำความเย็นหยุดการทำงาน

					แต่เรามีระบบแจ้งเตือนผ่านไปยัง Line แจ้งเตือนทุกนาที จึงมั่นใจในความปลอดภัยได้ครับผม <br><br>
					
					<img src="../../content/images/art_iot/iot/alert2.jpg" alt="ห้องเย็นเสีย"><br><br>

					<?php include('../../sources/inc/inc_contact_art.php');?>
					<br>
					<br>
				</div>

			</div>

		<div class="row">
		<p class="text -small">
		หมายเหตุ
		</p>
		
		
		
		</div>
	</div>
</div>

<?php //include('../../sources/inc/inc_art_line.php');?>
<?php include('../../sources/inc/inc_article-relate.php');?>
<?php include('../../sources/inc/inc_footer.php');?>

</body>
</html>
