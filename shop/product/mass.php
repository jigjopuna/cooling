<?php session_start(); 
	  require_once('../includes/connect.php');
	  $currmenu = 5;  // ตั้งค่าเมนูให้ default ไว้ที่หมวดนี้
	  
	  $sql_catm = "SELECT * FROM tb_category WHERE cat_publish = 1";
	  $result_catm = mysql_query($sql_catm);
	  $num_catm = mysql_num_rows($result_catm);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ห้องเย็น ชุดเครื่องทำความเย็น รู้ราคาทันที ไม่ต้องรอขอราคา</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="อุปกรณ์ห้องเย็นหายากนักใช่ไหม คอมเพรสเซอร์ ดอนเด็นซิ่ง คอยล์ร้อน คอยล์เย็น ราคาถูก คุณภาพดี มีรับประกัน เรามีสินค้าครบวงจรเรื่องห้องเย็น">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ห้องเย็น ชุดเครื่องทำความเย็น รู้ราคาทันที ไม่ต้องรอขอราคา" />
	<meta property="og:description" content="อุปกรณ์ห้องเย็นหายากนักใช่ไหม คอมเพรสเซอร์ ดอนเด็นซิ่ง คอยล์ร้อน คอยล์เย็น ราคาถูก คุณภาพดี มีรับประกัน เรามีสินค้าครบวงจรเรื่องห้องเย็น" />
	<meta property="og:image" content="" />
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
				<?php include('../includes/inc_menu1.php');?>

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

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(../images/heading-pages-02.jpg);">
		<h2 class="l-text2 t-center">
			Women
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<?php include('../includes/inc_machine_ass.php');?>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<!--<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Default Sorting</option>
									<option>Popularity</option>
									<option>Price: low to high</option>
									<option>Price: high to low</option>
								</select> 
							</div>

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Price</option>
									<option>$0.00 - $50.00</option>
									<option>$50.00 - $100.00</option>
									<option>$100.00 - $150.00</option>
									<option>$150.00 - $200.00</option>
									<option>$200.00+</option>

								</select> 
							</div>
						</div>-->

						<span class="s-text8 p-t-5 p-b-5">
							มีทั้งหมด <?php echo $num_catm;?> หมวดหมู่ <!--Showing 1–12 of 16 results-->
						</span>
					</div>

					<!-- Product -->
					
					<div class="row">
						<?php 
							for($i=1; $i<=$num_catm; $i++){
							$row_catm = mysql_fetch_array($result_catm);
						?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<a href="room_detail.php?cate=<?php echo $row_catm['cat_id']; ?>">
										<img src="../images/category/mass/<?php echo $row_catm['cat_id']; ?>.jpg" alt="ห้องเย็น <?php echo $row_catm['cat_name']; ?>">
									
									</a>
								</div>
							  
								<div class="block2-txt p-t-20">
									<a href="room_detail.php?cate=<?php echo $row_catm['cat_id']; ?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $row_catm['cat_name']; ?>
										<!--โฟมผนังห้องชนิด PU PS และ PIR-->
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						<?php } ?>
						
						

					<!-- Pagination
					<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div> -->
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
	<div id="cattype" style="display:none;"><?php echo $currmenu; ?></div>
	<?php include('../includes/inc_js_sub.php');?>
</body>
</html>
