<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="cache-control" content="max-age=10"/>
<title>เพิ่มข้อมูลลูกค้าใหม่ ห้องเย็น | Topcooling</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="author" content="Topcooling"/>
<meta name="robots" content="index, follow">
<meta name="copyright" content="Topcooling 2017"/>
<meta name="keywords" content="">
<meta name="description" content="">
<?php require_once ('../../include/google_verify.php');?>
<meta property="og:title" content=""/>
<meta property="og:type" content="article"/>
<meta property="og:image" content=""/>
<meta property="og:url" content="http://www.topcooling.net"/>
<meta property="og:description" content=""/>
 


<link rel="shortcut icon" href="../../assets/img/favicon.ico">
<link rel="stylesheet" href="../../sources/css/main.css">
<script type="text/javascript" src="../../sys/js/jquery-1.11.1.min.js"></script>
<script>
	$(document).ready(function(){
			multiList();
			$('#r_btn').click(validation);

	});//end ready
	
	function multiList(){
		$("#province").load("../../ajax/province_server.php");
		$("#province").change(function(){
	  		 var url = "../../ajax/amphur_server.php";
	  		 var param = "province="+$("#province").val();
	   
		   $.ajax({
				url      : url,
				data     : param,
				dataType : "html",
				type     : "POST",
				success: function(result){
					$("#amphur").html(result);	
				}
			});//end ajax province
		   $("#tumbon").html('');
	    });// end change province
		
		
		$("#amphur").load("../../ajax/amphur_onload.php");
		$("#amphur").change(function(){
			   var url = "../../ajax/tumbon_server.php";
			   var param = "amphur="+$("#amphur").val();
			   
			   $.ajax({
					url      : url,
					data     : param,
					dataType : "html",
					type     : "POST",
					success: function(result){
						$("#tumbon").html(result);	
					}
				});  //end ajax amphur
			});//end change amphur
	
			$("#tumbon").load("../../ajax/tumbon_onload.php");
		}// end fn multiList0
		
		
		function validation(){
			var custname = $('#cust_name').val();
			if(custname==''){
				$('#cust_name ').val("ยังไม่ได้ใส่ชื่อลูกค้า");
			}
			
			if($('#province').val()==0){
				 alert('เลือกจังหวัดด้วยนะค่ะ');
				 return false;
			}
			
			if($('#amphur').val()==0){
				 alert('เลือกอำเภอด้วยนะค่ะ');
				 return false;
			}
			
			if($('#tumbon').val()==0){
				 alert('เลือกตำบลด้วยนะค่ะ');
				 return false;
			}
			
			$('#form1').submit();
			
		}
</script>  

 
</head>
<body>
<?php require_once('../../include/googletag.php');?>
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
				 
				 
				<li><a href="" target="_blank">ติดต่อเรา</a></li>
				<li><a href="/faq">คำถามที่พบบ่อย</a></li>
				 
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
			ยินดีต้อนรับสำหรับลูกค้าใหม่</br>
			<p style="padding-top: 5px; font-size: 34px;">
			ที่ต้องการพัฒนาธุรกิจให้เติบโต ด้วยห้องเย็น
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
						ข้อมูลลูกค้าใหม่
					</div>
				</div>
				
				<div class="form-group">
					<div class="hidden-xs form-suffix">ชื่อ-นามสกุล</div>
					<input type="text" id="cust_name" name="cust_name" class="baht" placeholder="ชื่อ-นามสกุล">
				</div>

				<div class="form-group">
					<div class="hidden-xs form-suffix">บริษัท</div>
					<input type="text" id="cust_corp" name="cust_corp" class="baht" placeholder="ชื่อบริษัท">
				</div>

				
				<div class="form-group">
					<div class="hidden-xs form-suffix">เบอร์ติดต่อ</div>
					<input id="phoneno" name="phoneno" class="baht" placeholder="เบอร์ติดต่อ">
				</div>
				
				
				<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-sm-12">
								<select name="province" id="province" class="select-box -left" placeholder="จังหวัด">
									
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
								<select name="amphur" id="amphur" class="select-box -left" placeholder="อำเภอ">
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
								<select name="tumbon" id="tumbon" class="select-box -left" placeholder="ตำบล">
								</select>
								<div class="select-arrow"></div>
							</div>
						</div>
					</div>
				</div>



				
				<div class="form-group">
					<div class="hidden-xs form-suffix">ที่อยู่</div>
					<input type="text" id="address" name="address" class="baht" placeholder="ที่อยู่">
				</div>
				
				
				<div class="form-group">
					<div class="hidden-xs form-suffix">รหัสไปรษณีย์</div>
					<input id="temp_before" name="zipcode" class="baht" placeholder="รหัสไปรษณีย์">
				</div>
				
				<div class="form-group">
					<div class="hidden-xs form-suffix">อีเมลล์</div>
					<input type="text" id="email" name="email" class="baht" placeholder="อีเมลล์">
				</div>

				
				

				<div class="form-group insurance">


				</div>
				<div class="form-group">
					<button  id="r_btn" class="btn -primary" type="button">บันทึกข้อมูล</button>
				</div>
				</div>
			</div>
		</form>
		</div>
		</div>
	</div>
</div>

<?php include('../../include/inc_1_footer.php');?>

</body>
</html>
