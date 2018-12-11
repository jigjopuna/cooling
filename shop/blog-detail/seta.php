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
	<title>ขายชุดคอมเพรสเซอร์ห้องเย็นราคาดี เหมาะสม มีคุณภาพ</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="ซื้อเครื่องทำความเย็นห้องเย็นที่ไหนดี อะไหล่ อุปกรณ์พร้อม ชุดคอนเดนซิ่ง คอล์ยร้อน คอล์ยเย็น คอมเพรสเซอร์ และอุปกรณ์อื่นๆ ที่นี่มีขาย ราคาไม่แพง Condensing Cold Storage เราจัดให้ครบชุดเลย ซื้อไปติดตั้งได้ทันที ไม่กี่ชั่วโมงก็เสร็จ">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ขายชุดคอมเพรสเซอร์ห้องเย็นราคาดี เหมาะสม มีคุณภาพ" />
	<meta property="og:description" content="ซื้อเครื่องทำความเย็นห้องเย็นที่ไหนดี อะไหล่ อุปกรณ์พร้อม ชุดคอนเดนซิ่ง คอล์ยร้อน คอล์ยเย็น คอมเพรสเซอร์ และอุปกรณ์อื่นๆ ที่นี่มีขาย ราคาไม่แพง Condensing Cold Storage เราจัดให้ครบชุดเลย ซื้อไปติดตั้งได้ทันที ไม่กี่ชั่วโมงก็เสร็จ" />
	<meta property="og:image" content="<?php echo $httpurl;?>shop/images/product/machset/machine/compressor-cover-cold.jpg" />
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
			SET เครื่องห้องเย็น
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			ชุดทำความเย็นห้องเย็นพร้อมอุปกรณ์
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
							    
								<img src="../images/product/machset/machine/compressor-cover-cold.jpg" alt="คอยล์ร้อนห้องเย็น">
								<!--<img src="../images/blog-04.jpg" alt="IMG-BLOG">-->
							</div>

							<div class="blog-detail-txt p-t-33">
								<h4 class="p-b-11 m-text24">
									ขายชุดเครื่องคอมเพรสเซอร์ห้องเย็น
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										By Admin
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										28 Dec, 2018
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										คอนเด็นซิ่งห้องเย็น
										<span class="m-l-3 m-r-6"> </span>
									</span>

									<span>
										<!--8 Comments-->
									</span>
								</div>

								<p class="p-b-25">
									
									<br />
									- ชุดคอนเด็นซิ่ง Condensing<br />
									- คอล์ยร้อน<br />
									- คอล์ยเย็น<br />
									- คอมเพรสเซอร์<br />
									- ตู้คอนโทรลระบบไฟฟ้าทั้งหมด<br />
									<br />
									ชุดคอนเด็นซิ่งประกอบให้สำเร็จ ภายในมีอุปกรณ์ครบ ดรายเออร์, ไซด์กล๊าส, เอ็กแปน, โซลินอยวาล์ว, สตอปวาล์ว, รีซีฟเวอร์, Hi Low Pressure, ออยเซฟเฟอรเรชั่น, พัดลมระบายความร้อนและ ท่อทองแดงเชื่อมต่ออุปกรณ์ต่างๆ 
									<br />
									<br />
									รุ่นของอุปกรณ์<br />
									1. คอมเพรสเซอร์ Copeland<br />
									2. คอยล์เย็น  EDEN<br />
									3. คอยร้อน XMK<br />
									4. อุปกรณ์อื่น Danfoss<br />
									<br />
									รายละเอียดราคาดูได้ตามรูปด้านล่างนี้เลยครับ<br />
									<br />
									<br />
									<a href="https://topcooling.net/shop/images/cool/machprice.jpg" target="_blank"><img style="width:100%;" src="https://topcooling.net/shop/images/cool/machprice.jpg" alt="คอมเพรสเซอร์ห้องเย็นราคา"/></a>
									<br />

								</p>

								<p class="p-b-25">
								เงื่อนไข<br />
									1. อุณหภูมิช่วงที่ทำได้ +10 ถึง -18 องศา ถ้าใช้อุณหภูมิต่ำกว่านี้ ต้องใช้เครื่องตัวใหญ่
									<br /><br />
									2. ปริมาณสินค้าเข้าต่อวันไม่เกิน 800 kg ถ้าเกินกว่านี้ต้องใช้เครื่องตัวใหญ่
									<br /><br />
									3. อุณหภูมิสินค้าก่อนเข้าห้องเย็น +20 องศา ถ้าแช่แข็งมาแล้วก็จะดี
									<br /><br />
									4. เวลาลดอุณหภูมิให้ถึง -18 องศา ใช้เวลา 18 ชั่วโมง ถ้าให้สินค้าแข็งเร็วเช่น 6 ชั่วโมง ต้องใช้เครื่องบลาสฟรีส
									<br /><br />

									ถ้าลูกค้าต้องการหาห้องเย็นให้เหมาะสมกับสินค้าเราเอง ส่งข้อมูลมาให้เรา ทางทีมงานจะคำนวณเลือกเครื่องให้เหมาะสมกับลูกค้า จะทำให้สินค้าเก็บได้มีคุณภาพ และประหยัดค่าไฟได้ด้วยครับ<br /><br />
									<img style="width:100%;" src="../images/product/machset/machine/2.jpg" alt="ชุดคอนเดนซิ่งห้องเย็น"/><br /><br />
									<img style="width:100%;" src="../images/product/machset/machine/3.jpg" alt="คอยล์เย็นห้องเย็น"/><br /><br />
									<img style="width:100%;" src="../images/product/machset/machine/4.jpg" alt="ระบบควบคุมห้องเย็น"/><br /><br />
									
								</p>
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
										Streetstyle
									</a>

									<a href="#" class="tag-item">
										Crafts
									</a>
								</div>
							</div>
						</div>

						<!-- Leave a comment -->
						
					</div>
				</div>

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
									Fashion
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Beauty
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Street Style
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Life Style
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									DIY & Crafts
								</a>
							</li>
						</ul>

						<!-- Featured Products -->
						<h4 class="m-text23 p-t-65 p-b-34">
							Featured Products
						</h4>

						<ul class="bgwhite">
							<li class="flex-w p-b-20">
								<a href="product-detail.html" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
									<img src="../images/item-16.jpg" alt="IMG-PRODUCT">
								</a>

								<div class="w-size23 p-t-5">
									<a href="product-detail.html" class="s-text20">
										White Shirt With Pleat Detail Back
									</a>

									<span class="dis-block s-text17 p-t-6">
										$19.00
									</span>
								</div>
							</li>

							<li class="flex-w p-b-20">
								<a href="product-detail.html" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
									<img src="../images/item-17.jpg" alt="IMG-PRODUCT">
								</a>

								<div class="w-size23 p-t-5">
									<a href="product-detail.html" class="s-text20">
										Converse All Star Hi Black Canvas
									</a>

									<span class="dis-block s-text17 p-t-6">
										$39.00
									</span>
								</div>
							</li>

							<li class="flex-w p-b-20">
								<a href="product-detail.html" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
									<img src="../images/item-08.jpg" alt="IMG-PRODUCT">
								</a>

								<div class="w-size23 p-t-5">
									<a href="product-detail.html" class="s-text20">
										Nixon Porter Leather Watch In Tan
									</a>

									<span class="dis-block s-text17 p-t-6">
										$17.00
									</span>
								</div>
							</li>

							<li class="flex-w p-b-20">
								<a href="product-detail.html" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
									<img src="../images/item-03.jpg" alt="IMG-PRODUCT">
								</a>

								<div class="w-size23 p-t-5">
									<a href="product-detail.html" class="s-text20">
										Denim jacket blue
									</a>

									<span class="dis-block s-text17 p-t-6">
										$39.00
									</span>
								</div>
							</li>

							<li class="flex-w p-b-20">
								<a href="product-detail.html" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
									<img src="../images/item-05.jpg" alt="IMG-PRODUCT">
								</a>

								<div class="w-size23 p-t-5">
									<a href="product-detail.html" class="s-text20">
										Nixon Porter Leather Watch In Tan
									</a>

									<span class="dis-block s-text17 p-t-6">
										$17.00
									</span>
								</div>
							</li>
						</ul>

						<!-- Archive -->
						<h4 class="m-text23 p-t-50 p-b-16">
							Archive
						</h4>

						<ul>
							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									July 2018
								</a>

								<span class="s-text13">
									(9)
								</span>
							</li>

							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									June 2018
								</a>

								<span class="s-text13">
									(39)
								</span>
							</li>

							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									May 2018
								</a>

								<span class="s-text13">
									(29)
								</span>
							</li>

							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									April  2018
								</a>

								<span class="s-text13">
									(35)
								</span>
							</li>

							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									March 2018
								</a>

								<span class="s-text13">
									(22)
								</span>
							</li>

							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									February 2018
								</a>

								<span class="s-text13">
									(32)
								</span>
							</li>

							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									January 2018
								</a>

								<span class="s-text13">
									(21)
								</span>
							</li>

							<li class="flex-sb-m">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									December 2017
								</a>

								<span class="s-text13">
									(26)
								</span>
							</li>
						</ul>

						<!-- Tags -->
						<h4 class="m-text23 p-t-50 p-b-25">
							Tags
						</h4>

						<div class="wrap-tags flex-w">
							<a href="#" class="tag-item">
								Fashion
							</a>

							<a href="#" class="tag-item">
								Lifestyle
							</a>

							<a href="#" class="tag-item">
								Denim
							</a>

							<a href="#" class="tag-item">
								Streetstyle
							</a>

							<a href="#" class="tag-item">
								Crafts
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
