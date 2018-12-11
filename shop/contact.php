<?php session_start(); 
	  require_once('includes/connect.php');
	  $currmenu = 1;  // ตั้งค่าเมนูให้ default ไว้ที่หมวดนี้

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Topcooling Shop</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('includes/inc_robot.php'); ?>
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="ห้องเย็น จำหน่ายชุด Condensing คอมเพรสเซอร์ คอล์ยเย็น อุปกรณ์เครื่องทำความเย็น รวมถึงห้องเย็น พนังห้อง โฟม PU PS PIR อุปกรณ์ประกอบห้อง">
    <meta name="author" content="topcooling, tcl">
	
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ขายอุปกรณ์ห้องเย็น ทุกอย่างที่เกี่ยวกับห้องเย็น" />
	<meta property="og:description" content="ห้องเย็น จำหน่ายชุด Condensing คอมเพรสเซอร์ คอล์ยเย็น อุปกรณ์เครื่องทำความเย็น รวมถึงห้องเย็น พนังห้อง โฟม PU PS PIR อุปกรณ์ประกอบห้อง" />
	<meta property="og:image" content="" />
	
	<?php require_once('includes/google-verify.php');?>
	<?php include('includes/inc_css.php'); ?>
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<?php include('includes/inc_social.php');?>
			

			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.html" class="logo">
					<img src="images/icons/logo.jpg" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<?php include('includes/inc_menu.php');?>

				<!-- Header Icon -->
				<div class="header-icons">
					<?php include('includes/account-user1.php');?>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<!-- Header cart noti fist paht-->
						<?php include('includes/inc_minibasket.php');?>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.php" class="logo-mobile">
				<img src="images/icons/logo.jpg" alt="ห้องเย็น tcl">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<?php include('../includes/account-user1.php');?>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<!-- Header cart noti -->
						<?php include('includes/inc_minibasket_mobile.php');?>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<?php include('includes/inc_menu_mobile.php');?>
	</header>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Contact
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
						<div class="contact-map size21" id="google_map" data-map-x="40.614439" data-map-y="-73.926781" data-pin="images/icons/icon-position-map.png" data-scrollwhell="0" data-draggable="1"></div>
					</div>
				</div>

				<div class="col-md-6 p-b-30">
					<form class="leave-comment">
						<h4 class="m-text26 p-b-36 p-t-15">
							ติดต่อเราได้นะค่ะ
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Phone Number">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email Address">
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								Send
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>


	<!-- Footer -->
	<?php include('includes/inc_footer.php');?>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



	<?php include('includes/inc_js.php');?>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>

</body>
</html>
