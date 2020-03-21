<?php session_start(); 
	  require_once('../includes/connect.php');
	  $currmenu = 3;  // ตั้งค่าเมนูให้ default ไว้ที่หมวดนี้
	  
	  $sql_catroom = "SELECT c.catr_id, c.catr_name, COUNT(t.t_cate) 
					  FROM tb_tools t JOIN tb_categoryroom c ON t.t_cate = c.catr_id
					  WHERE t.t_type = 2 GROUP BY t.t_cate";
	  $result_catroom = mysql_query($sql_catroom);
	  $num_catroom = mysql_num_rows($result_catroom);
	  
	  $sql_catroom1 = "SELECT * FROM tb_categoryroom";
	  $result_catroom1 = mysql_query($sql_catroom1);
	  $num_catroom1 = mysql_num_rows($result_catroom1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ขายอุปกรณ์ประกอบห้องเย็น โฟมฉนวน ประตู บานพับ</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="จำหน่ายอุปกรณ์ห้องเย็น ทุกอย่างที่เกี่ยวกับห้องเย็น กลอนประตูห้องเย็น บานพับประตูห้องเย็น  ซิลิโคน ซีลแลนท์ ราคาถูก มีสินค้าพร้อมส่ง ขอใบเสนอราคาง่าย">
    <meta name="author" content="topcooling">
	<meta property="og:url" content="https://topcooling.net/shop/product/room.php" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ขายอุปกรณ์ประกอบห้องเย็น โฟมฉนวน ประตู บานพับ" />
	<meta property="og:description" content="จำหน่ายอุปกรณ์ห้องเย็น ทุกอย่างที่เกี่ยวกับห้องเย็น กลอนประตูห้องเย็น บานพับประตูห้องเย็น  ซิลิโคน ซีลแลนท์ ราคาถูก มีสินค้าพร้อมส่ง ขอใบเสนอราคาง่าย" />
	<meta property="og:image" content="" />
	<?php include('../includes/google-verify.php');?>
	<?php include('../includes/inc_css_sub.php'); ?>
	<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">


</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<?php include('../includes/inc_social.php');?>
			<div class="wrap_header">
				<!-- Logo -->
				<a href="https://topcooling.net/shop/index.php" class="logo">
					<img src="https://topcooling.net/shop/images/icons/logo.jpg" alt="ห้องเย็น tcl">
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
			<a href="https://topcooling.net/shop/index.php" class="logo-mobile">
				<img src="https://topcooling.net/shop/images/icons/logo.jpg" alt="อะไหล่ห้องเย็น">
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
					<?php include('../includes/inc_room_ass.php');?>
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
							มีทั้งหมด <?php echo $num_catroom; ?> หมวดหมู่ <!--Showing 1–12 of 16 results-->
						</span>
					</div>

					<!-- Product -->
					
					
					<div class="row">
						<?php 
							for($i=1; $i<=$num_catroom; $i++){
							$row_catroom = mysql_fetch_array($result_catroom);
						?>
						<div class="col-sm-6 col-md-6 col-lg-3 p-b-50 2colmobile" style=" width:50%; float:left;">
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<a href="https://topcooling.net/shop/product/room_detail.php?cate=<?php echo $row_catroom['catr_id']; ?>">
										<img src="https://topcooling.net/shop/images/category/room/<?php echo $row_catroom['catr_id']; ?>.jpg" alt="ห้องเย็น <?php echo $row_catroom['catr_name']; ?>">
									
									</a>
									<!--<img src="../images/item-02.jpg" alt="IMG-PRODUCT">-->

								</div>
							  
								<div class="block2-txt p-t-20">
									<a href="https://topcooling.net/shop/product/room_detail.php?cate=<?php echo $row_catroom['catr_id']; ?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $row_catroom['catr_name']; ?>
										<!--โฟมผนังห้องชนิด PU PS และ PIR-->
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						
								<?php } ?>
						
						<!--<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ">
									<img src="../images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="room_detail.php?cate=5" class="block2-name dis-block s-text3 p-b-5">
										ประตูห้องเย็น บานเลื่อน บานสวิง
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ">
									<img src="../images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="room_detail.php?cate=5&subcate=2" class="block2-name dis-block s-text3 p-b-5">
										อุปกรณ์ประตูห้องเย็น บานพับขาสูง ขาต่ำ และกลอนประตู
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ">
									<img src="../images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="room_detail.php?cate=6" class="block2-name dis-block s-text3 p-b-5">
										ม่านห้องเย็น
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ">
									<img src="../images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="room_detail.php?cate=3" class="block2-name dis-block s-text3 p-b-5">
										อลูมิเนียมห้องเย็น ฉากโค้ง ตัวที และอื่นๆ 
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ">
									<img src="../images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
										
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="room_detail.php?cate=8" class="block2-name dis-block s-text3 p-b-5">
										ซิลิโคน / ซีลแลนซ์ และอุปกรณ์
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ">
									<img src="../images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="room_detail.php?cate=10" class="block2-name dis-block s-text3 p-b-5">
										วาล์วปรับแรงดัน Pressure Report
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ">
									<img src="../images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
										อุปกรณ์อื่นๆ ใบเลื่อยใบเจีย รีเวท ท่อและน็อตต่างๆ
									</a>

									<span class="block2-price m-text6 p-r-5">
										
									</span>
								</div>
							</div>
						</div>-->

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
	
	<script>
		$(document).ready(function(){
			$("#search-product").autocomplete({
				source: "../../ajax/search_prod_room_shop.php",
				minLength: 1
			});
		});
	</script>
</body>
</html>
