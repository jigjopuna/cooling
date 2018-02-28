<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ห้องเย็นบริการครบวงจร รับปรึกษาทุกปัญหาเกี่ยวกับห้องเย็น ฟรี | Topcooling</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="keywords" content="เช็คราคาห้องเย็น" />
<meta name="description" content="รู้ราคาห้องเย็นภายใน 1 นาที เคยไหม ไม่รู้ว่าจะหาข้อมูลห้องเย็นได้จากไหน ลองดูข้อมูลห้องเย็นได้ที่นี่ " />
<title>เช็คราคาห้องเย็น Top Cooling</title>
<meta property="og:url" content="http://topcooling.net/chkprice.php" />
<meta property="og:type" content="article" />
<meta property="og:title" content="เช็คราคาห้องเย็น Top Cooling" />
<meta property="og:description" content="รู้ราคาห้องเย็นภายใน 1 นาที เคยไหม ไม่รู้ว่าจะหาข้อมูลห้องเย็นได้จากไหน ลองดูข้อมูลห้องเย็นได้ที่นี่ " />
<meta property="og:image" content="img/about/coolr639x309.jpg" />
<?php require_once ('include/google_verify.php');?>


<link rel="shortcut icon" href="/assets/img/favicon.ico">
<link rel="stylesheet" href="sources/css/main.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<script type="text/javascript" src="sys/js/jquery-1.11.1.min.js"></script>
<script>
	$(document).ready(function(){
		
		$('.btn').click(validation);

		/*var weight = $('#weight').val();
		   if((weight=="")||(isNaN(weight))){
			   if(weight==''){
				alert('กรุณากรอกน้ำหนักด้วยค่ะ');
				$('#weight').css("background-color","pink");
				return false;
			   }
				if((isNaN(weight))){
				alert('กรุณากรอกน้ำหนักด้วยตัวเลขค่ะ');
				$('#weight').css("background-color","pink");
				return false;
				}
				return false;
			}*/
	});
	
	function validation(){

		  var r_width = $("#r_width").val();
		  if(r_width==''){
				alert('กรุณาใส่ความกว้างของห้องด้วยค่ะ');
				//$('#r_width').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_width))){
				alert('กรุณาใส่ความกว้างของห้องด้วยตัวเลขค่ะ');
				//$("#r_width").css("background-color","pink");
				return false;
		  }
		  
		  
		   var r_length = $("#r_length").val();
		  if(r_length==''){
				alert('กรุณาใส่ความยาวของห้องด้วยค่ะ');
				//$('#r_length').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_length))){
				alert('กรุณาใส่ความยาวของห้องด้วยตัวเลขค่ะ');
				//$('#r_length').css("background-color","pink");
				return false;
		  }
		  
		  
		  
		  var r_height = $("#r_height").val();
		  if(r_height==''){
				alert('กรุณาใส่ความสูงของห้องด้วยค่ะ');
				//$('#r_height').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_height))){
				alert('กรุณาใส่ความสูงของห้องด้วยตัวเลขค่ะ');
				//$("#r_height").css("background-color","pink");
				return false;
		  }  
		  
		  
		  var qty = $("#qty").val();
		  if(qty==''){
			  $("#qty").val(1000);
		  }
		  
		  var temp_before = $("#temp_before").val();
		  if(temp_before==''){
			  $("#temp_before").val(20);
		  }
		  
		  /*alert( $("#temp_before").val());
		  alert( $("#qty").val());*/
		  
		  
		  var temp_before = $("#temp_before").val();
		  if(temp_before==''){
				alert('กรุณาใส่อุณหภูมิด้วยค่ะ');
				//$('#temp_before').css("background-color","pink");
				return false;
			   }
				if((isNaN(temp_before))){
				alert('กรุณาใส่อุณหภูมิด้วยค่ะ');
				//$("#temp_before").css("background-color","pink");
				return false;
		  }
		 
		  if($('#temparature').val()==0){
			  alert('กรุณาใส่อุณหภูมิด้วยค่ะ');
				return false;
			  
		  }
		  
		   if($('#timeperiod').val()==0){
			  alert('กรุณาใส่ชั่วโมงที่ต้องการลดอุณหภูมิด้วยค่ะ');
				return false;
		  }
		  
	      $('#form1').submit();
	}
</script>

</head>
<body>
<?php require_once('include/googletag.php');?>
<div class="loading-point">

</div>
<div class="navbar-section">  
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-6 navbar-left">
			<div class="brand-img">
			 
			</div>
			</div>
			<div class="col-md-8 col-xs-6 navbar-right">
				<button id="navbar-mobile-btn" class="hamburger-btn hamburger-btn--menu">
				<span></span>
				<span></span>
				<span></span>
				</button>
				<ul class="navbar-menu">
				 
				 
				<li><a href="#contact-list">ติดต่อเรา</a></li>
				<li><a href="th/article/17howto.php">คำถามที่พบบ่อย</a></li>
				 
				<li><a class="btn-border" style="cursor:pointer;">เข้าสู่ระบบ</a></li>
			</div>
		</div>
	</div>
</div>
<div class="navbar-mobile-menu">
	<ul class="navbar-menu"> 
		<li><a href="" target="_blank">ติดต่อเรา</a></li>
		<li><a href="">คำถามที่พบบ่อย</a></li>
		<li><a class="btn-border" style="cursor:pointer;">เข้าสู่ระบบ</a></li>
	</ul>
</div>
<style media="screen">.section-header .col-sm-6:first-child .heading{text-align:left;}.section-header .col-sm-6:first-child .btn{margin:0;}.dealbox p.policy{letter-spacing:0;line-height:1.4;font-size:13px;}.link:hover{text-decoration:underline;}.videoModal{position:fixed;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,.8);z-index:10000;}.wrapVideo{margin-top:25vh;margin-left:auto;margin-right:auto;text-align:center;}@media  screen and (max-width: 984px) {.dealbox>.wrapper>.form-header>.heading{font-size:34px;}.dealbox p.policy br{display:none;}}@media  screen and (max-width: 767px) {.section-header .col-sm-6:first-child .heading{text-align:center;}}@media  screen and (max-width: 768px) {.section-header .col-sm-6:first-child .btn{margin:0 auto;}.dealbox>.wrapper>.form-header>.heading{font-size:32px;margin-bottom:20px;}.dealbox>.wrapper>.form-header>.heading{font-size:40px;}.dealbox p.policy br{display:block;}}@media  screen and (max-width: 425px) {.dealbox{width:100%;}.dealbox>.wrapper>.form-header>.heading{font-size:34px;margin-bottom:20px;}.dealbox>.wrapper>.form-group.insurance p,.dealbox p.policy{font-size:1em!important;}.dealbox p.policy br{display:none;}}</style>
<div id="videoModal" style="display: none;" class="animated fadeIn videoModal">

<div class="wrapVideo">
<iframe id="player" style="width:95%; max-width: 560px;" height="315" src="https://www.youtube.com/embed/wxH0kIBugGA" frameborder="0" allowfullscreen></iframe>
</div>

</div>
<div class="section-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="heading">
			<!--ยินดีต้อนรับเข้าสู่บริการห้องเย็นที่รวดเร็ว</br>-->
			<!--<p style="padding-top: 5px; font-size: 34px;">
			ปรึกษาปัญหาห้องได้ทุกเรื่องเป็นกันเอง-->
			</p>
			</div>
			<div id="videoModalButton" class="btn -primary">
			ชมวิธีการใช้งานเว็บไซต์ <i style="font-size: 18px; vertical-align: baseline;" class="fa fa-play-circle-o"></i>
			</div>
			<div style="color: #ffffff; margin-top: 10px;">
			หรือ <div style="display: inline; cursor: pointer;" class="link">ศึกษาเพิ่มเติม</div>
			</div>
		</div>
		<div class="col-sm-6" style="padding-left: 0px; padding-right: 0px;">
		<form id="form1" name="form" method="post" action="quotation.php">
			<div class="dealbox">
				<div class="wrapper">
				<div class="form-header">
				<div class="heading">
				ขอใบเสนอราคาห้องเย็น
				</div>
				</div>

				
				<!--<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-xs-3" style="font-size:20px;">ขนาดห้อง</div>
							<div class="col-xs-3"><input id="" name="temp_before" class="baht" placeholder="กว้าง"></div>
							<div class="col-xs-3"><input id="" name="temp_before" class="baht" placeholder="ยาว"></div>
							<div class="col-xs-3"><input id="" name="temp_before" class="baht" placeholder="สูง" style="width:100%"></div>
							
						</div>
					</div>
				</div> -->
				
				
				<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-xs-6" style="text-align: left;">ห้องกว้าง (m)</div>
							<div class="col-xs-6">
								<input id="r_width" name="r_width" class="select-box" placeholder="เมตร">
								<!--<select class="select-box" id="r_width" name="r_width">
									<option value="" disabled selected>เมตร</option>
									<option value="1">1 เมตร</option>
									<option value="2">2 เมตร</option>
								</select>
							<div class="select-arrow"></div>-->
							</div>
							<span class="alert-text col-xs-12" style="display:block; text-align: left;"></span>
						</div>
					</div>
				</div> 

				<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-xs-6" style="text-align: left;">ห้องยาว (m)</div>
							<div class="col-xs-6">
								<input id="r_length" name="r_length" class="select-box" placeholder="เมตร">
								<!--<select class="select-box" id="r_length" name="r_length">
									<option value="" disabled selected>เมตร</option>
									<option value="1">1 เมตร</option>
									<option value="2">2 เมตร</option>
								</select>
							<div class="select-arrow"></div>-->
							</div>
							<span class="alert-text col-xs-12" style="display:block; text-align: left;"></span>
						</div>
					</div>
				</div> 

				<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-xs-6" style="text-align: left;">ห้องสูง (m)</div>
							<div class="col-xs-6">
								<input id="r_height" name="r_height" class="select-box" placeholder="เมตร">
								<!--<select class="select-box" id="r_height" name="r_height">
									<option value="" disabled selected>เมตร</option>
									<option value="1">1 เมตร</option>
									<option value="2">2 เมตร</option>
								</select>
							<div class="select-arrow"></div>-->
							</div>
							<span class="alert-text col-xs-12" style="display:block; text-align: left;"></span>
						</div>
					</div>
				</div> 


				<div class="form-group">
					<div class="form-select">
					<div class="row">
					<div class="col-sm-12">
						<select id="temparature" name="temparature" class="select-box -left" placeholder="อุณหภูมิที่ต้องการ">
							<option value="">อุณหภูมิที่ต้องการ</option>
							<option value="1">25 องศา</option>	
							<option value="2">18 องศา</option>
							<option value="3">15 องศา</option>	
							<option value="4"> -5 องศา</option>	
							<option value="5">-12 องศา</option>	
							<option value="6">-15 องศา</option>
							<option value="7">-25 องศา</option>	
							<option value="8">-30 องศา</option>	
							<option value="9">-40 องศา</option>
							
						</select>
					<div class="select-arrow"></div>
					</div>
					</div>
					</div>
				</div>


				<div class="form-group">
					<div class="form-select">
					<div class="row">
					<div class="col-sm-12">
						<select name="timeperiod" id="timeperiod" class="select-box -left" placeholder="อุณหภูมิที่ต้องการ">
							<option value="">ระเวลาลดอุณหภูมิ </option>
							<option value="18">18 ชั่วโมง</option>
							<option value="12">12 ชั่วโมง</option>
							<option value="8">8 ชั่วโมง</option>
							<option value="6">6 ชั่วโมง</option>
						</select>
					<div class="select-arrow"></div>
					</div>
					</div>
					</div>
				</div>



				<div class="form-group">
					<div class="hidden-xs form-suffix">องศาเซลเซียส</div>
					<input id="temp_before" name="temp_before" class="baht" placeholder="อุณหภูมิสินค้าก่อนเข้าห้องเย็น">
				</div>

				<div class="form-group">
					<div class="hidden-xs form-suffix">กิโลกรัม</div>
					<input type="text" id="qty" name="qty" class="baht" placeholder="สินค้าเฉลี่ยเข้าห้องเย็นต่อวัน">
				</div>

				<div class="form-group insurance">


				</div>
				<div class="form-group">
					<button class="btn -primary" type="button">แสดงใบเสนอราคา</button>
				</div>
				</div>
			</div>
		</form>
		</div>
		</div>
	</div>
</div>
<style>

.accessories:hover {
    opacity: 0.5;
	-webkit-transition: opacity 0.5s ease-in-out;
    -moz-transition: opacity 0.5s ease-in-out;
    -ms-transition: opacity 0.5s ease-in-out;
    -o-transition: opacity 0.5s ease-in-out;
    transition: opacity 0.5s ease-in-out;
}
</style>


<div id="sec2" class="section-2">
	<div class="container">
		<div class="row -intro" id="refinance-meaning">
			
			<div class="col-md-12">
				<div class="heading">
				 
				วิธีการใช้งาน ตรวจสอบราคาห้องเย็น<span class="hidden-xs"></span> 
				</div>
				<p>
				1. ใส่ขนาดห้องเย็นที่ต้องการ<br><br>
	2. เลือกอุณหภูมิที่ต้องการ เช่น ต้องแช่หมู ไก่ ปลา ให้ได้อุณภูมิที่ต้องการเลือกได้เลย ถ้าอยากได้อุณหภูมิ -20 องศา ก็เลือก 0 ถึง -20 องศา<br><br>
	3. ระยะเวลาลดอุณหภูมิสินค้า คือเมื่อเอาสินค้าเข้าห้องเย็นแล้ว ต้องการให้สินค้าเย็นให้ได้ -20 องศา ภายในกี่ชั่วโมง<br><br>
	4. อุณหภูมิสินค้าก่อนเข้าห้อง หมายถึงสินค้าที่ยังไม่ได้แช่เย็นก่อนเข้าห้องเย็นอุณหภูมิเท่า ทั่วไปๆ ก็ประมาณ 20 ถึง 25 องศา<br><br>
	5. ปริมาณ หมายถึง 1 วันจะเอาสินค้าเข้าห้องเย็นกี่กิโล ช่องนี้ใส่คราวๆ ก็ได้ครับ<br><br>
	6. กดปุ่ม "คำนวณราคา" จากนั้นใบเสนอราคาจะแสดงขึ้นมา<br><br>
	
	<strong>หมายเหตุ</strong> : ราคานี้เป็นราคาห้องเย็นมือหนึ่ง<br><br>
	ระบบห้องนี้สร้างขึ้นมาเพื่ออำนวยความสะดวกให้กับทุกคนที่ต้องการทราบราคาห้องเย็น แต่ไม่รู้ว่าจะไปหาข้อมูลได้ที่ไหน<br><br>
	
	หามีข้อสงสัยติดต่อ 082-360-1523
				</p>
				
			</div>
			
			
			
		
		</div>
		
	</div>
</div>

<!--<div id="sec2" class="section-2">
	<div class="container">
		<div class="row -intro" id="refinance-meaning">
			<div class="col-md-6">
				<div class="heading">
				 
				ห้องเย็นช่วยธุรกิจเราดีขึ้นได้อย่างไร<span class="hidden-xs"></span> 
				</div>
				<p>
				ช่วยให้สินค้าที่ต้องการความเย็นรักษาระดับคุณภาพสินค้า ได้นานขึ้น</br>
				ช่วยลดตู้แช่แข็งจำนวนมาก ค่าไฟแพง ดูแลขนย้ายสินค้าลำบาก </br>
				ห้องเย็นทำให้สินค้าเราสดใหม่อยู่เสมอ หมดปัญหาเรื่องของเน่าเสีย
				</p>
				<p class="text -primary">ตัวอย่าง*</p>
				<img src="sources/assets/images/pic-money-1.png">
			</div>
			
			<div class="col-md-6">
				<div class="img-2-bubble bounce">
				ประหยัดเงินสูงสุด
				<span>1,619,468 บาท</span>
				</div>
				<img class="img-2" src="sources/assets/images/pic-money-2.png">
			</div>
		</div>
		<div class="row">
		<p class="text -small">
		* ข้อมูลที่แสดงข้างต้นเป็นเพียงตัวอย่าง จากการการคำนวณที่วงเงินกู้ 3 ล้านบาท ระยะเวลาผ่อน
		ที่เหลือ 25 ปี และเลือกชำระคืนแบบผ่อนเท่ากันทุกเดือน โดยคิดจากอัตราดอกเบี้ย 6.8% ต่อปี
		และรีไฟแนนซ์คิดจากอัตราดอกเบี้ย 3.75% ต่อปี (โปรดอ่าน <a href="/term" style="color: grey;">ข้อตกลงและเงื่อนไข</a> ของ )
		</p>
		
		</div>
	</div>
</div>-->

<div class="section-testimonial">
	<div class="heading">
	ห้องเย็นมือสอง ประกอบใหม่
	</div>
	 
	<div class="container">
		<div class="row">
			<img src="content/images/secondhand.jpg" width="100%" alt="ห้องเย็นมือสอง">
		</div>
	</div>	
</div>

 <div class="section-testimonial">
	<div class="heading">
	ห้องเย็นสำเร็จรูปตั้งพื้น ของใหม่
	</div>
	 
	<div class="container">
		<div class="row">
			<img src="content/images/new.jpg" width="100%" alt="ห้องเย็นราคา">
		</div>
	</div>	
</div>

 
<div class="section-testimonial">
	<div class="heading">
	ขั้นตอนก่อนสร้างห้องเย็น <!--ดูแลบำรักษาห้องเย็นง่ายๆ -->
	</div>
	 
	<div class="container">
		<div class="row">
			<div class="blog-slider" >
			
			
				<div class="articles"><a href="th/article/17howto.php">
					<div class="blog-box">
						<div class="blog-img" style="background: url('sources/assets/images/17howto.jpg');">
						<span>+ อ่านต่อ</span>
						</div>
						<div class="blog-content">
							<span class="blog-time"></span>
							<h2 class="blog-title">19 ข้อต้องรู้ก่อนมีห้องเย็น</h2>
							<p class="blog-excerpt">เชื่อว่าหลายท่านที่กำลังมองหาห้องเย็นสักห้อง กำลังตัดสินใจอยู่ ให้อ่านบทความนี้ จะช่วยท่านตัดใจได้ดี และถูกต้องแน่นอน จากประสบการณ์ตรง กว่า 30 ปี</p>
						</div>
					</div>
					</a>
				</div>
				
				<div class="articles"><a href="th/article/outside.php">
					<div class="blog-box">
						<div class="blog-img" style="background: url('content/images/article/out-side/outside-01.jpg');">
						<span>+ อ่านต่อ</span>
						</div>
						<div class="blog-content">
							<span class="blog-time "></span>
							<h2 class="blog-title ">วางแผนออกแบบ ดูหน้างาน</h2>
							<p class="blog-excerpt ">การวางแผน และดูหน้างานที่สิ่งจำเป็นอย่างมาก เพราะเราต้องป้องกันปัญหาที่เกิดจากปัจจัยภายนอก ที่มีผลกระทบกับห้องเย็น เช่น ความชื้น อุณหภูมิ แมลง เป็นต้น</p>
						</div>
					</div>
					</a>
				</div>
				
				
			
			
			

			<div class="articles"><a href="th/article/pre-design.php">
				<div class="blog-box">
					<div class="blog-img" style="background: url('content/images/article/design-room/main-post.jpg');">
					<span>+ อ่านต่อ</span>
					</div>
					<div class="blog-content">
						<span class="blog-time"></span>
						<h2 class="blog-title ">ออกแบบห้องเย็น 3D ฟรี ก่อนทำจริง</h2>
						<p class="blog-excerpt">หมดปัญหาเรื่องได้ห้องเย็นที่ไม่ตรงกับความต้องการ เราออกแบบให้เห็นภาพจริง 3 มิติ ก่อนสร้างห้องเย็นทุกครั้ง   เราอยากให้ลูกค้าได้ห้องเย็นที่ดีที่สุดเพื่อตอบโจทย์ธุรกิจของลูกคัา</p>
					</div>
				</div>
				</a>
			</div>
			
			<div class="articles"><a href="th/article/brief.php">
					<div class="blog-box">
						<div class="blog-img" style="background: url('sources/assets/images/delivery.jpg');">
						<span>+ อ่านต่อ</span>
						</div>
						<div class="blog-content">
							<span class="blog-time "></span>
							<h2 class="blog-title ">คุยรายละเอียด ความต้องการของลูกค้า</h2>
							<p class="blog-excerpt ">เพราะห้องเย็นแต่ละห้องไม่เหมือนกัน และสินค้าที่แช่ในห้องเย็นก็แตกต่างกัน เพื่อให้ห้องเย็นมีประสิทธิภาพสูงสุดและเหมาะกับ สินค้าของลูกค้า เราจะออกแบบให้ตรงกับความต้องการมากที่สุด</p>
						</div>
					</div>
					</a>
				</div>
			
				<div class="articles"><a href="https://topcooling.net/th/art_iot/iot.php">
					<div class="blog-box">
						<div class="blog-img" style="background: url('sources/assets/images/chktemp.jpg');">
						<span>+ อ่านต่อ</span>
						</div>
						<div class="blog-content">
							<span class="blog-time "></span>
							<h2 class="blog-title ">มีระบบ Cloud อัจฉริยะ เช็คอุณหภูมิผ่านมือถือ</h2>
							<p class="blog-excerpt ">เพราะสินค้าในห้องเย็นมีมูลค่าสูงมาก หากมีระบบนี้ จะช่วยลดความเสี่ยงห้องเย็นไม่เย็นไปได้อย่างมาก ตรวจสอบอุณหภูมิได้ตลอด 24 ชม. แม้ไม่ได้อยู่หน้าห้องเย็น</p>
						</div>
					</div>
					</a>
				</div>
			
			
			
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<a class="blog-readmore" href="https://www.tocooling.com/blog" target="_blank">อ่านทั้งหมด ></a>
			</div>
		</div>
	</div>	
</div>

<div class="section-calculate">
	<div class="heading">
		หมดปัญหาเรื่องหาข้อมูลอะไหล่ห้องเย็นไม่ได้
	</div>
	
	<div class="subheading">
		ฟรี! ไม่เก็บค่าบริการในการใช้งาน
	</div>
	
	<div class="btn -primary">
		ค้นหาราคาอุปกรณ์ห้องเย็น
	</div>
</div>

<?php include('include/inc_1_footer.php');?>
 

</body>
</html>