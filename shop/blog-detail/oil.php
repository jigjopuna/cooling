<?php session_start(); 
	  require_once('../includes/connect.php');
	  $currmenu = 3;  // ตั้งค่าเมนูให้ default ไว้ที่หมวดนี้
	  
	  $sql_catroom = "SELECT * FROM tb_categoryroom";
	  $result_catroom = mysql_query($sql_catroom);
	  $num_catroom = mysql_num_rows($result_catroom);
	  
	  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ขายน้ำมันคอมเพรสเซอร์สำหรับห้องเย็นโดยเฉพาะ ราคาถูก โทร 084-013-7350</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="น้ำมันคอมเพรสเซอร์ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="ห้องเย็น ถ่ายน้ำมันแล้วเดินเครื่องได้ดีขึ้น เดินเครื่องแบบลื้นปรื้ดๆ ไม่มีสะดุดหายห่วง BITZER COPELAND น้ำมันคอมเพรสเซอร์ห้องเย็น น้ำยา R22 R404a Compressor oil โทร 084-013-7350">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ขายน้ำมันคอมเพรสเซอร์สำหรับห้องเย็นโดยเฉพาะราคาถูก โทร 084-013-7350" />
	<meta property="og:description" content="ห้องเย็น ถ่ายน้ำมันแล้วเดินเครื่องได้ดีขึ้น เดินเครื่องแบบลื้นปรื้ดๆ ไม่มีสะดุดหายห่วง BITZER COPELAND น้ำมันคอมเพรสเซอร์ห้องเย็น น้ำยา R22 R404a Compressor oil โทร 084-013-7350 ราคาถูก" />
	<meta property="og:image" content="<?php echo $httpurl;?>shop/images/product/machine/oil/cover.jpg" />
	<?php include('../includes/google-verify.php');?>
	<?php include('../includes/inc_css_sub.php'); ?>
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<?php include('../includes/inc_social.php');?>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.html" class="logo">
					<img src="../images/icons/logo.jpg" alt="ห้องเย็น tcl">
				</a>

				<!-- Menu -->
				<?php include('../includes/inc_menu_blog.php');?>

				<!-- Header Icon -->
				<div class="header-icons">
					<?php include('../includes/account-user.php');?>
					

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<!-- Header cart noti -->
						<?php include('../includes/inc_minibasket1.php');?>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="../images/icons/logo.jpg" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<?php include('../includes/account-user.php');?>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<!-- Header cart noti -->
						<?php include('../includes/inc_minibasket_mobile1.php');?>
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
		<div class="wrap-side-menu" >
			<?php include('../includes/inc_menu_mobile.php');?>
		</div>
	</header>

	<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="../index.php" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="../blog.php" class="s-text16">
			อะไหล่เครื่องทำความเย็น
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			น้ำมันคอมเพรสเซอร์ห้องเย็น
		</span>
	</div>

	<!-- content page -->
	<section class="bgwhite p-t-60 p-b-25">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-50 p-r-0-lg">
						<div class="p-b-40"> 
							<div class="blog-detail-img wrap-pic-w">
							    
								<img src="../images/product/machine/oil/fancoil_eurotech01.jpg" alt="พัดลม axcail fan ห้องเย็น">
								<!--<img src="../images/blog-04.jpg" alt="IMG-BLOG">-->
							</div>

							<div class="blog-detail-txt p-t-33">
								<h4 class="p-b-11 m-text24">
									ขายน้ำมันคอมเพรสเซอร์ห้องเย็น
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										By Admin
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										28 March, 2020
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										น้ำมันคอมเพรสเซอร์ห้องเย็น
										<span class="m-l-3 m-r-6"> </span>
									</span>

									<span>
										<!--8 Comments-->
									</span>
								</div>

								<p class="p-b-25">
									
									<br />
									น้ำมันคอมเพรสเซอร์ใช้ได้ทั้ง BITZER และ COPELAND <span class="text-strong">AXIAL FAN</span>  <br /><br />
									ห้องเย็น ถ่ายน้ำมันแล้วเดินเครื่องได้ดีขึ้น เดินเครื่องแบบลื้นปรื้ดๆ ไม่มีสะดุดหายห่วง BITZER COPELAND น้ำมันคอมเพรสเซอร์ห้องเย็น น้ำยา R22 R404a Compressor oil โทร 084-013-7350
									<span class="topic-article">วิธีการเลือกซื้อ</span><br />

								
									<a href="https://topcooling.net/shop/images/product/machine/oil/fancoil_eurotech02.jpg" target="_blank">
										<img style="width:100%;" src="https://topcooling.net/shop/images/product/machine/oil/fancoil_eurotech02.jpg" alt="น้ำมันคอม Bitzer Copland"/>
									</a>
									<br /><br />
									
									<a href="https://topcooling.net/shop/images/product/machine/oil/fancoil_eurotech03.jpg" target="_blank">
										<img style="width:100%;" src="https://topcooling.net/shop/images/product/machine/oil/fancoil_eurotech03.jpg" alt="น้ำมันคอม Bitzer"/>
									</a>
									<br /><br />
									
									<a href="https://topcooling.net/shop/images/cool/product/machine/oil/fancoil_eurotech04.jpg" target="_blank">
										<img style="width:100%;" src="https://topcooling.net/shop/images/product/machine/oil/fancoil_eurotech04.jpg" alt="น้ำมันคอมห้องเย็น"/>
									</a>
									<br /><br />

								</p>

								<p class="p-b-25">
								
								</p>
								
								<br><br><br>
								<iframe width="100%" height="400" src="https://www.youtube.com/embed/sbOlgb-0wuE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						
						
							</div>
							
							<div class="item-blog-txt p-t-33">
									<h4 class="p-b-11">

									</h4>

									<div class="s-text8 flex-w flex-m p-b-21">
										<?php include('../includes/contacts.php');?>
									</div>

									<p class="p-b-12">
										<?php include('../includes/inc_qrcode.php');?>
									</p>
							</div>
							

							<div class="flex-m flex-w p-t-20">
								<span class="s-text20 p-r-20">
									Tags
								</span>

								<div class="wrap-tags flex-w">
									<a href="#" class="tag-item">
										น้ำมันคอมเพรสเซอร์ห้องเย็น
									</a>

									<a href="#" class="tag-item">
										น้ำมันห้องเย็น
									</a>
								</div>
							</div>
						</div>

						<!-- Leave a comment -->
						
					</div>
					
				</div> <!--md 8 col 9-->

				<div class="col-md-4 col-lg-3 p-b-80">
					<div class="rightbar">
						<!-- Search -->
						<div class="pos-relative bo11 of-hidden">
							<input class="s-text7 size16 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search">

							<button class="flex-c-m size5 ab-r-m color1 color0-hov trans-0-4">
								<i class="fs-13 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>

						<!-- Categories -->
						<h4 class="m-text23 p-t-56 p-b-34">
							Categories
						</h4>

						<ul>
							<li class="p-t-6 p-b-8 bo6">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									ebm
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Eurotech
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									พัดลมขนาด 300 mm
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									มอเตอร์พัดลมคอยล์ร้อน
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									DIY & Crafts
								</a>
							</li>
						</ul>

						<!-- Featured Products -->
						<?php  include('prod_feature.php');?>

						<!-- Archive -->
						<?php  include('archive.php');?>

						<!-- Tags -->
						<h4 class="m-text23 p-t-50 p-b-25">
							Tags
						</h4>

						<div class="wrap-tags flex-w">
							<a href="#" class="tag-item">
								น้ำมันคอม
							</a>

							<a href="#" class="tag-item">
								compressor oil
							</a>

							<a href="#" class="tag-item">
								น้ำมันคอม  Bitzer
							</a>

							<a href="#" class="tag-item">
								น้ำมันคอม  Copeland
							</a>

							<a href="#" class="tag-item">
								พัดลมคอยล์ร้อน
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Footer -->
	<?php include('../includes/inc_footer_sub.php');?>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


   <?php include('../includes/inc_js_sub.php');?>

</body>
</html>
