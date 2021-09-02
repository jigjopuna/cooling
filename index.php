<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="cache-control" content="max-age=10"/>
<title>ห้องเย็นบริการครบวงจร รับปรึกษาทุกปัญหาเกี่ยวกับห้องเย็น ฟรี | Topcooling</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="author" content="Topcooling"/>
<meta name="robots" content="index, follow">
<meta name="copyright" content="Topcooling 2017"/>
<meta name="keywords" content="ห้องเย็น, ห้องเย็นราคา, ห้องเย็นมือสอง, เครื่องทำความเย็นอาหาร, ห้องเย็นไม่เย็น">
<meta name="description" content="รับสร้างห้องเย็น เพิ่มผลกำไรให้กับธุรกิจอาหารสดได้มากขึ้น  กับระบบออนไลน์ของเรา รู้ราคาห้องเย็นภายใน 1 นาที ที่คุณกำหนดราคาเองได้">
<?php require_once ('include/google_verify.php');?>
<meta property="og:title" content="ห้องเย็นบริการครบวงจร รับปรึกษาทุกปัญหาเกี่ยวกับห้องเย็น ฟรี | Topcooling"/>
<meta property="og:type" content="article"/>
<meta property="og:image" content=""/>
<meta property="og:url" content="https://www.topcooling.net"/>
<meta property="og:description" content="รับสร้างห้องเย็น เพิ่มผลกำไรให้กับธุรกิจอาหารสดได้มากขึ้น  กับระบบออนไลน์ของเรา รู้ราคาห้องเย็นภายใน 1 นาที ที่คุณกำหนดราคาเองได้"/>
<link rel="shortcut icon" href="content/images/favicon.png">
<link rel="stylesheet" href="sources/css/main.css">
<link rel="canonical" href="https://topcooling.net" />
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<script type="text/javascript" src="sys/js/jquery-1.11.1.min.js"></script>
<script>
	$(document).ready(function(){
		/*$$('#navbar-mobile-btn').click(function(){
		('.navbar-mobile-menu').css('right','0');
		 setTimeout(function(){ 
			$('.navbar-mobile-menu').css('right','-214px'); }, 3000);
		});*/
		
		
		$('#q_btn').click(validation);
		$("#navbar-mobile-btn").click(function(){
			$('.navbar-menu').toggle();
		});
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
					<li><a href="/th/article/sumred.php">ห้องเย็นสำเร็จรูป</a></li>
					<li><a href="/th/article/speedlock.php">ห้องเย็นฝั่ง</a></li>
					<li><a href="#contact-list">ติดต่อเรา</a></li>
					<li><a href="/th/article/17howto.php">คำถามที่พบบ่อย</a></li>
				<li><a class="btn-border" style="cursor:pointer;"></a></li>
			</div>
		</div>
	</div>
</div>

<div class="navbar-mobile-menu">
	
	<ul class="navbar-menu"> 
		<li><a href="" target="_blank">ติดต่อเรา</a></li>
		<li><a href="https://topcooling.net/th/article/17howto.php">คำถามที่พบบ่อย</a></li>
		<li><a class="btn-border" style="cursor:pointer;"></a></li>
	</ul>
</div>
<style media="screen">.section-header .col-sm-6:first-child .heading{text-align:left;}.section-header .col-sm-6:first-child .btn{margin:0;}.dealbox p.policy{letter-spacing:0;line-height:1.4;font-size:13px;}.link:hover{text-decoration:underline;}.videoModal{position:fixed;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,.8);z-index:10000;}.wrapVideo{margin-top:25vh;margin-left:auto;margin-right:auto;text-align:center;}@media  screen and (max-width: 984px) {.dealbox>.wrapper>.form-header>.heading{font-size:34px;}.dealbox p.policy br{display:none;}}@media  screen and (max-width: 767px) {.section-header .col-sm-6:first-child .heading{text-align:center;}}@media  screen and (max-width: 768px) {.section-header .col-sm-6:first-child .btn{margin:0 auto;}.dealbox>.wrapper>.form-header>.heading{font-size:32px;margin-bottom:20px;}.dealbox>.wrapper>.form-header>.heading{font-size:40px;}.dealbox p.policy br{display:block;}}@media  screen and (max-width: 425px) {.dealbox{width:100%;}.dealbox>.wrapper>.form-header>.heading{font-size:34px;margin-bottom:20px;}.dealbox>.wrapper>.form-group.insurance p,.dealbox p.policy{font-size:1em!important;}.dealbox p.policy br{display:none;}}</style>
<div id="videoModal" style="display: none;" class="animated fadeIn videoModal">

<div class="wrapVideo">
<iframe id="player" style="width:95%; max-width: 560px;" height="315" src="https://www.youtube.com/embed/wxH0kIBugGA" frameborder="0" allowfullscreen></iframe>
</div>

</div>
<div class="section-header" style="min-height:871px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="heading">
			<!--ยินดีต้อนรับเข้าสู่บริการห้องเย็นที่รวดเร็ว</br>-->
			<p style="padding-top: 5px; font-size: 34px;">
			<!--ปรึกษาปัญหาห้องได้ทุกเรื่องเป็นกันเอง-->
			</p>
			</div>
			<!--<div id="videoModalButton" class="btn -primary">
			ชมวิธีการใช้งานเว็บไซต์ <i style="font-size: 18px; vertical-align: baseline;" class="fa fa-play-circle-o"></i>
			</div>-->
			<!--<div style="color: #ffffff; margin-top: 10px;">
			หรือ <div style="display: inline; cursor: pointer;" class="link">ศึกษาเพิ่มเติม</div>
			</div>-->
		</div>
		<div class="col-sm-6" style="padding-left: 0px; padding-right: 0px;">
		<!--<form id="form1" name="form" method="post" action="quotation.php">
			<div class="dealbox">
				<div class="wrapper">
				<div class="form-header">
				<div class="heading">
				ขอใบเสนอราคาห้องเย็นฝั่ง
				</div>
				</div>
				
				<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-xs-6" style="text-align: left;">ห้องกว้าง (m)</div>
							<div class="col-xs-6">
								<input id="r_width" name="r_width" class="select-box" placeholder="เมตร">
								
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
							<option value="" >ระเวลาลดอุณหภูมิ </option>
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
					<button  id="q_btn" class="btn -primary" type="button">แสดงใบเสนอราคา</button>
				</div>
				</div>
			</div>
		</form>-->
		</div>
		</div>
	</div>
</div>

<div id="" class="section-2">
	<div class="container">
		<div class="row -intro" id="refinance-meaning">
			
			<div class="col-md-12">
				<div class="heading">
				เกี่ยวกับ ซีพีเอ็น 888
				</div>
				<div style="font-size:19px;">
				 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;เราเป็นผู้เชี่ยวชาญในด้านการผลิต ออกแบบ และติดตั้งห้องเย็นสำเร็จรูป ห้องเย็นฝั่งประกอบเร็ว ในอุตสาหกรรมความเย็น นอกจากนี้เรายังพัฒนาห้องเย็น  เพื่อให้ SME หรือ บุคคลทั่วไปสามารถเข้าถึง ใช้งานห้องเย็นได้ง่ายและสะดวก ในราคาที่เหมาะสม<br><br><br>
 
				ด้วยปัญหาของผู้ใช้งานห้องเย็นในด้านการดูแลรักษา และซ่อมบำรุงพัฒนาเทคโนโลยี เราจึงมีระบบตรวจสอบอุณหภูมิห้องเย็นผ่านอินเตอร์เน็ต ลดความเสี่ยงสินค้าภายในห้องเย็นเสียหาย เพื่อให้สอดคล้องกับ Thailand 4.0
				</div>
			</div>
		</div>		
	</div>
</div>

<!--
<div class="section-testimonial">
	<div class="heading">
	ก่อตั้ง หจก. มาแล้วกว่า 30 ปี
	</div>
	 
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4 p-b-50 2colmobile">
				
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 p-b-50 2colmobile">
				<a href="content/images/social/commerce.jpg" target="_blank"><img src="content/images/social/commerce.jpg" class="img-portrit" style="width:100%" alt="ประวัติท็อปคูลลิ่ง"></a>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 p-b-50 2colmobile">
			</div>
		</div>
	</div>	
</div>

<div class="section-testimonial">
	<div class="heading">
	หยุดทำการ 3 วัน นะครับ 
	</div>
	<p style="font-size: 28px;">
		หยุด 3 วันนะครับ ไปต่างประเทศ<br>
		จะเปิดทำการอีกครั้งวันที่ 27 กันยายน 2561<br><br>

		ระหว่างนี้ยังสามารถส่งข้อความ<br>
		ทาง Facebook และ Line ได้อยู่นะครับ<br><br>

		โทรอาจจะไม่ติด<br><br>

		FB : <a href="https://goo.gl/55am5r" target="_blank">goo.gl/55am5r</a><br>
		Line ID : @topcooling (ใส่ @ ข้างหน้าด้วย)<br>
		Line QR : <a href="https://goo.gl/S9zZcF" target="_blank">goo.gl/S9zZcF</a><br>
	</p><br><br>
	 
	<div class="container">
		<div class="row">
			<img style="width:100%;" src="content/images/holiday1.jpg" width="100%" alt="ห้องเย็นมือสอง">
		</div>
	</div>	
</div>-->

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



<div class="">
	<div class="heading">
	</div>
	 
	<div class="container">
			<?php include('sources/inc/inc_holiday.php');?>
		<div class="row">
		</div>
	</div>	
</div>
<div class="section-testimonial">
	<div class="heading">
	ห้องเย็นฝั่งประกอบเร็วติดตั้งหน้างาน
	</div>
	 
	<div class="container">
		<div class="row">
			<img src="content/images/speedlock-1400-900.jpg" width="100%" alt="ห้องเย็นราคา">
		</div>
	</div>	
</div>




<div class="section-testimonial"> 
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span style="font-size:36px;" class="topic-article"> คลิปประกอบห้องเย็น</span><br><br><br>
				<iframe width="100%" height="400" src="https://www.youtube.com/embed/D9E0P3XkbqA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				<br><br>
			</div>
		</div>	
	</div>	
</div>

<div class="section-testimonial">
	<div class="heading">
	ห้องเย็นสำเร็จรูปตั้งพื้น
	</div>
	 
	<div class="container">
		<div class="row">
			<img src="content/images/sumred-land-1200-700.jpg" width="100%" alt="ห้องเย็นราคา">
		</div>
	</div>	
</div>


 <div class="section-4">
	<div class="container">
		<!--<div class="row -step">
			<div class="col-md-12">
				<div class="heading">
				ห้องเย็นมือสองประกอบใหม่
				</div>
			</div>
		</div>-->
		
		<div class="row -step-list">
			<div class="col-sm-6 -step-item">
				<a href="th/article/sumred.php">
					<img src="content/images/cool/300px.jpg" style="width:300px; height:300px;">
				</a>
				<!--<p>-->
					<div class="heading">
						<a href="th/article/sumred.php">
							ห้องเย็นสำเร็จรูปตั้งพื้น
						</a>
					</div>
						
					<div style="font-size:17px;">
					ยกไปวางที่หน้างาน พร้อมใช้งานทันที <br>
					พื้นที่วางห้องเย็น ควรสูงกว่า 2.6 ม.<br>
					เคลื่อนย้ายได้สะดวก <br>
					โครงสร้างเหล็กแข็งแรง<br>
					ไม่เหมาะกับพื้นที่เล็กๆ ที่ขนย้ายไม่สะดวก<br>
					รับประกัน 1 ปีเต็ม <br>
					เวลาผลิต 25 - 30 วัน <br>
					มีระบบเช็คอุณหภูมิผ่านมือถือ<br>
					</div>
					<a href="th/article/sumred.php" style="text-decoration:underline !important;">ข้อมูลเพิ่มเติม</a>
					<br><br><span class="heading" style="color:red;">ราคาเริ่ม 280,000 </span>
				<!--</p>-->
			</div>
			<div class="col-sm-6 -step-item">
				<a href="th/article/speedlock.php">
					<img src="content/images/cool/speed300.jpg" style="width:300px; height:300px;">
				</a>
				<!--<p style="font-size:20px;">-->
					<div class="heading">
						<a href="th/article/speedlock.php">
							ห้องเย็นแบบฝั่งประกอบเร็ว
						</a>
					</div>
						
					<div style="font-size:17px;">
					ประกอบติดตั้งห้องเย็น ที่หน้างาน<br>
					ติดตั้งกับพื้นที่ทุกรูปแบบ (พื้นที่เรียบ)<br>
					ใช้เวลาติดตั้ง 1 ถึง 2 วัน ใช้งานได้ทันที<br>
					อุปกรณ์ของใหม่ได้คุณภาพทั้งหมด<br>
					สามารถรื้อและขนย้ายได้<br>
					ต่อขยายห้องได้ในอนาคต<br>
					รับประกันนาน 1 ปี <br>
					มีระบบเช็คอุณหภูมิผ่านมือถือ<br>
					</div>
					<a href="th/article/speedlock.php" style="text-decoration:underline !important;">ข้อมูลเพิ่มเติม</a>
					<br><br><span class="heading" style="color:red;">ราคาเริ่ม 292,000 </span>
				<!--</p>-->
			</div>
			
		</div>
	</div>
</div>

<div class="section-4">
	<div class="container">
		<div class="row -step">
			<div class="col-md-12">
				<div class="heading">
				เคล็ดลับการเตรียมตัวก่อนมีห้องเย็น <!--<img class="logo -inline" src="sources/assets/images/.svg">-->
				</div>
			</div>
		</div>
		
		<div class="row -step-list">
			<div class="col-sm-6 -step-item">
				<img src="sources/assets/images/build.svg">
				<p>
				1. เตรียมพื้นที่ สำหรับติดตั้งห้องเย็น เช่นการเตรียมระดับพื้นที่
				</p>
			</div>
			<div class="col-sm-6 -step-item">
				<img src="sources/assets/images/electric-tower.svg">
				<p>
				2. เช็คระบบไฟฟ้าให้เพียงพอกับห้องเย็น
				</p>
			</div>
			
		</div>
	</div>
</div>
 
<!--<div class="section-testimonial">
	<div class="heading">
	ห้องเย็นมือสอง ประกอบใหม่
	</div>
	 
	<div class="container">
		<div class="row">
			<img src="content/images/secondhand.jpg" width="100%" alt="ห้องเย็นมือสอง">
		</div>
	</div>	
</div>-->


 
 <div class="section-testimonial">
	<div class="heading">
	<!--ดูแลบำรักษาห้องเย็นง่ายๆ --> ความรู้ดีๆ เกี่ยวกับห้องเย็น
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
							<h2 class="blog-title">17 ข้อต้องรู้ก่อนมีห้องเย็น</h2>
							<p class="blog-excerpt">เชื่อว่าหลายท่านที่กำลังมองหาห้องเย็นสักห้อง กำลังตัดสินใจอยู่ ให้อ่านบทความนี้ จะช่วยท่านตัดใจได้ดี และถูกต้องแน่นอน จากประสบการณ์ตรง กว่า 30 ปี</p>
						</div>
					</div>
					</a>
				</div>

				<div class="articles"><a href="th/art_iot/iot.php">
					<div class="blog-box">
						<div class="blog-img" style="background: url('sources/assets/images/chktemp.jpg');">
						<span>+ อ่านต่อ</span>
						</div>
						<div class="blog-content">
							<span class="blog-time "></span>
							<h2 class="blog-title">มีระบบ Cloud อัจฉริยะ เช็คอุณหภูมิผ่านมือถือ</h2>
							<p class="blog-excerpt">เพราะสินค้าในห้องเย็นมีมูลค่าสูงมาก หากมีระบบนี้ จะช่วยลดความเสี่ยงห้องเย็นไม่เย็นไปได้อย่างมาก ตรวจสอบอุณหภูมิได้ตลอด 24 ชม. แม้ไม่ได้อยู่หน้าห้องเย็น</p>
						</div>
					</div>
					</a>
				</div>
			
			
			<div class="articles"><a href="th/article/3phase.php">
				<div class="blog-box">
					<div class="blog-img" style="background: url('sources/assets/images/3phase-s.jpg');">
					<span>+ อ่านต่อ</span>
					</div>
					<div class="blog-content">
						<span class="blog-time"></span>
						<h2 class="blog-title">ทำไมห้องเย็นต้องใช้ไฟฟ้า 3 เฟส</h2>
						<p class="blog-excerpt">ไฟฟ้า 3 เฟสกับห้องเย็นเป็นของคู่กัน ช่วยประหยัดราคาต้นทุนค่าไฟในระยะยาว และยืดอายุการใช้งานของอุปกรณ์ไฟฟ้า</p>
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



 <div class="section-testimonial">
	<div class="heading">
	ขั้นตอนก่อนสร้างห้องเย็น <!--ดูแลบำรักษาห้องเย็นง่ายๆ -->
	</div>
	 
	<div class="container">
		<div class="row">
			<div class="blog-slider" >
			
				<div class="articles"><a href="th/article/prepair.php">
				<div class="blog-box">
					<div class="blog-img" style="background: url('content/images/article/prepair/307x230.jpg');">
					<span>+ อ่านต่อ</span>
					</div>
					<div class="blog-content">
						<span class="blog-time"></span>
						<h2 class="blog-title ">ห้องเย็นก่อนจะติดตั้งเราต้องเตรียมอะไรบ้าง</h2>
						<p class="blog-excerpt">ก่อนมีห้องเย็นมาดูกันว่าเราต้องรู้ และต้องเตรียมอะไรบ้างทั้งเรื่องพื้นจัดวาง และระบบไฟฟ้า เรามีห้องเย็นให้เลือกหลายรูปแบบราคาถูกไม่แพง รวดเร็วติดตั้งง่าย ด่วนๆ</p>
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

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<a class="blog-readmore" href="https://www.tocooling.com/blog" target="_blank">อ่านทั้งหมด ></a>
			</div>
		</div>
	</div>	
</div>



<?php include('include/inc_img_footer.php'); ?>



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
 
<div class="section-testimonial">
	<div class="heading">
	ความรู้เรื่องห้องเย็นที่น่าสนใจ
	</div>
	 
	<div class="container">
		<div class="row">
			<div class="blog-slider" >
				<div class="articles"><a href="th/article/icestorage.php">
					<div class="blog-box">
						<div class="blog-img" style="background: url('sources/assets/images/compare.jpg');">
						<span>+ อ่านต่อ</span>
						</div>
						<div class="blog-content">
							<span class="blog-time"></span>
							<h2 class="blog-title">ห้องเย็นเก็บน้ำแข็ง</h2>
							<p class="blog-excerpt"> จะมีห้องเย็นเก็บน้ำแข็ง โดยเฉพาะโรงน้ำแข็ง จะต้องเตรียมตัวอย่างไรบ้าง เก็บน้ำแข็งได้กี่ตัน ใช้เครื่องกี่แรง ถึงจะเก็บน้ำแข็งได้ดี มีคุณภาพ</p>
						</div>
					</div>
					</a>
				</div>

			<div class="articles"><a href="th/article/3phase.php">
				<div class="blog-box">
					<div class="blog-img" style="background: url('sources/assets/images/3phase-s.jpg');">
					<span>+ อ่านต่อ</span>
					</div>
					<div class="blog-content">
						<span class="blog-time "></span>
						<h2 class="blog-title ">ทำไมห้องเย็นต้องใช้ไฟฟ้า 3 เฟส</h2>
						<p class="blog-excerpt ">ไฟฟ้า 3 เฟสกับห้องเย็นเป็นของคู่กัน ช่วยประหยัดราคาต้นทุนค่าไฟในระยะยาว และยืดอายุการใช้งานของอุปกรณ์ไฟฟ้า</p>
					</div>
				</div>
				</a>
			</div>
			
			
			<div class="articles"><a href="th/article/5cause.php" target="_blank">
				<div class="blog-box">
					<div class="blog-img" style="background: url('content/images/article/5cause/307x230.jpg');">
					<span>+ อ่านต่อ</span>
					</div>
					<div class="blog-content">
						<span class="blog-time "></span>
						<h2 class="blog-title ">5 สาเหตุหลักที่ห้องเย็นไม่เย็น</h2>
						<p class="blog-excerpt "> ห้องเย็น ปัญหาที่พบบ่อยๆ พร้อมวิธีการแก้ปัญหาง่ายๆ ที่ทุกคนดูเลหรือทำเองได้  ห้องเสีย ไม่เย็น อ่านแล้วช่วยแก้ไขได้</p>
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
		</div><br><br><br>
		
		<!--<div class="row">
			<div class="col-xs-12">
				<span style="font-size:36px;" class="topic-article"> มาดูคลิปตัวอย่างการเก็บแช่หมูในห้องเย็น</span><br><br><br>
				<iframe width="100%" height="400" src="https://www.youtube.com/embed/hO-_B2puhgg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				<br><br>
			</div>
		</div>-->
		
	</div>	
	
	
</div>


<?php include('include/inc_1_footer.php');?>
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "TOPCOOLING", 
  "priceRange":"168000 - 400000 บาท", 
  "servesCuisine":"ห้องเย็น", 
  "description": "รับสร้างห้องเย็น เพิ่มผลกำไรให้กับธุรกิจอาหารสดได้มากขึ้น  กับระบบออนไลน์ของเรา รู้ราคาห้องเย็นภายใน 1 นาที ที่คุณกำหนดราคาเองได้ ห้องเย็นคุณภาพคับแก้ว มาชมห้องเย็นตัวอย่างจริงๆ ได้ที่โรงงานนะครับ อยู่นครปฐม", 
  "image": "https://topcooling.net/content/images/cool/sec-300x300.jpg",
  "address":{ 
      "@type":"PostalAddress",
      "streetAddress":"ห้างหุ้นส่วนจำกัด ท็อปคูลลิ่ง  28/1 ม.6 ต.ทัพหลวง อ.เมือง ",
      "addressLocality":"ตรงข้ามร้านอาหารครัวหลังบ้าน",
      "addressRegion":"นครปฐม",
      "postalCode":"73000"
   }, 
   "geo":{ 
      "@type":"GeoCoordinates",
      "latitude": 13.878727, 
      "longitude": 100.008955
   },
  "brand": {
    "@type": "Thing",
    "name": "TOPCOOLING"
  },
  "contactPoint": {
    "@type": "ContactPoint", 
	"telephone": "+66 84-013-7350",
    "contactType": "TCL ยินดีบริการลูกค้า"
  },
  
  "offers": {
    "@type": "Offer",
    "availability": "http://schema.org/InStock",
    "price": "168000.00",
    "priceCurrency": "THB"
  },
  "review": [
    {
      "@type": "Review",
      "author": "เกด",
      "datePublished": "2019-12-05",
      "description": "เย็นเร็วดีทันใจ ของไม่เสีย",
      "name": "รีวิวห้องเย็น 5 ดาว",
      "reviewRating": {
        "@type": "Rating",
        "bestRating": "5",
        "ratingValue": "1",
        "worstRating": "1"
      }
    },
    {
      "@type": "Review",
      "author": "Supachai",
      "datePublished": "2019-12-25",
      "description": "ดีมากเลย มือสองแต่เหมือนใหม่ทุกอย่าง แนะนำห้องเย็น Topcooling เลยครับ",
      "name": "รีวิวห้องเย็น 5 ดาว",
      "reviewRating": {
        "@type": "Rating",
        "bestRating": "5",
        "ratingValue": "4",
        "worstRating": "1"
      }
    }
   ], 
   "openingHoursSpecification":[ 
      
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Monday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Tuesday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Wednesday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Thursday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Friday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Saturday"
         ],
         "opens":"11:00",
         "closes":"23:59"
      }
   ],
   "aggregateRating":{ 
      "@type":"AggregateRating",
      "ratingValue":4,
      "reviewCount":120,
      "ratingCount":156
   }
}
</script>

<script type="text/javascript">
     //www.ptengine.com heatmap
	window._pt_lt = new Date().getTime();
	window._pt_sp_2 = [];
	_pt_sp_2.push("setAccount,73a3cfa8");
	var _protocol =(("https:" == document.location.protocol) ? " https://" : " http://");
	(function() {
		var atag = document.createElement("script");
		atag.type = "text/javascript";
		atag.async = true;
		atag.src = _protocol + "js.ptengine.jp/73a3cfa8.js";
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(atag, s);
	})();
</script>
</body>
</html>
