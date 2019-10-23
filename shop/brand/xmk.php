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
	<title>XMK จำหน่ายเครื่องทำความเย็น ห้องเย็น</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="ห้องเย็น คอมเพรสเซอร์ คอล์ยเย็น คอล์ยร้อน ชุดคอนเด็นซิ่ง ราคาถูก คุณภาพดี อุปกรณ์ครบชุดติดตั้งง่าย มีสินค้าพร้อมจัดส่งทั่วไทย 3-5 วัน">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="XMK จำหน่ายเครื่องทำความเย็น ห้องเย็น" />
	<meta property="og:description" content="ห้องเย็น คอมเพรสเซอร์ คอล์ยเย็น คอล์ยร้อน ชุดคอนเด็นซิ่ง ราคาถูก คุณภาพดี อุปกรณ์ครบชุดติดตั้งง่าย มีสินค้าพร้อมจัดส่งทั่วไทย 3-5 วัน" />
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
			Brand
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			XMK
		</span>
	</div>

	<!-- content page -->
	<section class="bgwhite p-t-60">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-50 p-r-0-lg">
						<div class="p-b-40"> 
							<div class="blog-detail-img wrap-pic-w">
							    
								<img src="../images/product/machset/machine/xmk.jpg" alt="XMK Thailand">
								<!--<img src="../images/blog-04.jpg" alt="IMG-BLOG">-->
							</div>

							<div class="blog-detail-txt p-t-33">
								<h4 class="p-b-11 m-text24">
									แบรนด์ XMK เครื่องทำความเย็น
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										By Admin
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										01 JAN, 2020
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
									
									

								</p>

								<p class="p-b-25">
								XMK เครื่องทำความเย็นอุปกรณ์และอะไหล่
								แบรนด์ XMK เป็นแบรนด์ที่มีการพัฒนาสินค้าตลอดเวลา แก้ปัญหาของผู้ใช้งาน ถึงแม้ว่าจะเป็นแบรนด์จากประเทศจีน แต่คุณภาพสินค้า ราคา และ บริการ support มาตราฐานไว้ใจได้จริงๆ ครับ <br /><br />

								สินค้าหลักๆ เป็นเครื่องทำความเย็นห้องเย็นมีหลากหลายประเภท อ่านรายละเอียดต่อด้านล่างได้ครับ<br /><br />

								<span class="topic-article">1. คอนเด็นซิ่ง XMK</span> <br />
								เป็นหัวใจหลักของห้องเย็น มีให้เลือกหลากแบบเพื่อให้ตรงตามวัตถุประสงค์การใช้งานของลูกค้า ไม่ว่าจะเป็นห้องเย็นชิลอุณหภูมิบวก  medium temp ช่วง 0 ถึง 10 องศาเซสเซียส ที่ใช้แช่ผักผลไม้ หรือ ห้องฟรีส Low temp ช่วง -​5 ถึง -​25 องศา ที่ใช้แช่อาหารทะเล อาหารแช่แข็ง เนื้อสัตว์ ไอศรีม เป็นต้น<br /><br />

								คอมเพรสเซอร์ เป็นส่วนสำคัญที่อยู่ในคอนเด็นซิ่ง คอมเพรสเซอร์ที่ใช้ติดตั้งจะมี 3 แบนด์หลักๆ <br />
								- Bitzer ประเภทลูกสูบ<br />
								- Copeland ประเภท scroll<br />
								- Danfoss ประเภท scroll<br />
								<br /><br />
								<span class="topic-article">2. คอยล์เย็น XMK</span> <br />
								ติดตั้งอยู่ในห้องเย็นทำหน้าที่กระจายลมเย็นให้ทั่วห้องเย็นเพื่อสินค้าจะได้รับความเย็นอย่างทั่วถึง การเลือกคอยล์เย็นต้องเลือกให้สอดคล้องกับขนาดของคอมเพรสเซอร์หรือคอนเด็นซิ่งด้วยนะครับ จะทำงานได้อย่างมีประสิทธิภาพ <br /><br />

								<span class="topic-article">3. อะไหล่และอุปกรณ์อื่นๆ</span> <br />
								เป็นส่วนสำคัญอีกอย่างหนึ่ง ที่สนับสนุนให้ระบบทำความเย็นประสิทธิภาพมากขึ้น<br />
								- Oil Seperation ตัวแยกน้ำมันในระบบ<br />
								- Sign Glass ช่วยดูความชื้นและการไหลเวียนน้ำยา<br />
								- Solinoil Valve<br />
								- Expantion Valve อุปกรณ์ฉีดน้ำยาในห้องเย็น<br />
								- Drier ตัวกรอกสิ่งสกปรกออกจากระบบทำความเย็น<br />
								- Hi Low pressure ตัววัดแรงดันน้ำยา<br /><br />

								ทั้งหมดนี้เป็นสินค้าที่ XMK มีสินค้าพร้อมบริการ ในงานห้องเย็นและงานปรับอากาศ

									
								</p>
							</div>
							
							<div class="item-blog-txt">
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
										ห้องเย็น
									</a>

									<a href="#" class="tag-item">
										Condensign Unit
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
							Brand
						</h4>

						<ul>
							<li class="p-t-6 p-b-8 bo6">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									XMK
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Tecumseh
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Q-Coil
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									ACKU
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									COOL SCAPE
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
	
	<section class="blog bgwhite  p-b-65">
		<div class="sec-title p-b-52 p-l-15 p-r-15">
			<h3 class="m-text5 t-center">
				คอนเด็นซิ่งยูนิค (Condensing Unit)  
			</h3>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto" style=" width:50%; float:left;"> 
					<!-- Block3 -->
					<div class="block3">
						<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
							<img src="../images/product/machset/machine/2.jpg" alt="คอมเพรสเซอร์ XMK">
						</a>
					</div>
				</div>

				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto" style=" width:50%; float:left;">
					<!-- Block3 -->
					<div class="block3">
						<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
							<img src="../images/product/machset/machine/2.jpg" alt="คอนเด็นซิ่ง XMK">
						</a>

						
					</div>
				</div>

				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto" style=" width:50%; float:left;">
					<!-- Block3 -->
					<div class="block3">
						<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
							<img src="../images/product/machset/machine/2.jpg" alt="Condensing XMK">
						</a>
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
