<?php session_start(); 
	  require_once('../includes/connect.php');
	  $cate = trim($_GET['cate']);
	  $subcate = trim($_GET['subcate']);
	  
	  
	  
	  //ดูว่ามี subcate ไหม subcate หมายถึง cate คือประตู subcate ส่วนย่อยของประตู
	  if($cate != '' && $subcate != ''){
		  $sql = "SELECT * FROM tb_productroom WHERE pr_cate = '$cate' AND pr_subcate = '$subcate' AND pr_publish = 1";
		  
	  }else{ //ถ้าไม่มี subcate ก็ให้เลือก cate อย่างเดียว เพราะเด่ว subcate เป็น 0 หรือ ค่าว่างเด่วจะมีปัญหา
		  $sql = "SELECT * FROM tb_productroom WHERE pr_cate = '$cate' AND pr_publish = 1";	  
	  }
	  
	  // query สินค้าอื่นๆ ที่เกียวกับห้องที่เกี่ยวข้องที่ไม่ใช่ cate ที่เลือก  
	  $sql_more = "SELECT * FROM tb_productroom WHERE pr_cate != '$cate' AND pr_publish = 1 AND pr_name != '' ORDER BY RAND() LIMIT 0 , 20";
	 
	  $result = mysql_query($sql);
	  $num = mysql_num_rows($result);
	  

      $result_more = mysql_query($sql_more);
	  $num_more = mysql_num_rows($result_more);
	  
	  $producttype = 'r';

	  
	  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>อุปกรณ์ประกอบห้องเย็น</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="ห้องเย็น จำหน่ายชุด Condensing คอมเพรสเซอร์ คอล์ยเย็น อุปกรณ์เครื่องทำความเย็น รวมถึงห้องเย็น พนังห้อง โฟม PU PS PIR อุปกรณ์ประกอบห้อง">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ขายอุปกรณ์ห้องเย็น ทุกอย่างที่เกี่ยวกับห้องเย็น" />
	<meta property="og:description" content="ห้องเย็น จำหน่ายชุด Condensing คอมเพรสเซอร์ คอล์ยเย็น อุปกรณ์เครื่องทำความเย็น รวมถึงห้องเย็น พนังห้อง โฟม PU PS PIR อุปกรณ์ประกอบห้อง" />
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
					<img src="../images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<?php include('../includes/inc_menu2.php');?>

				<!-- Header Icon -->
				<div class="header-icons">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="../images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<img src="../images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="../images/item-cart-01.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											White Shirt With Pleat Detail Back
										</a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="../images/item-cart-02.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Converse All Star Hi Black Canvas
										</a>

										<span class="header-cart-item-info">
											1 x $39.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="../images/item-cart-03.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Nixon Porter Leather Watch In Tan
										</a>

										<span class="header-cart-item-info">
											1 x $17.00
										</span>
									</div>
								</li>
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="../images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="../images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="../images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="../images/item-cart-01.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											White Shirt With Pleat Detail Back
										</a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="../images/item-cart-02.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Converse All Star Hi Black Canvas
										</a>

										<span class="header-cart-item-info">
											1 x $39.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="../images/item-cart-03.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Nixon Porter Leather Watch In Tan
										</a>

										<span class="header-cart-item-info">
											1 x $17.00
										</span>
									</div>
								</li>
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
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
	<!--<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(../images/heading-pages-02.jpg);">
		<h2 class="l-text2 t-center">
			Women
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p>
	</section>-->


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
							มีทั้งหมด 10 รายการ <!--Showing 1–12 of 16 results-->
						</span>
					</div>

					<!-- Product -->
					
					<div class="row">
						<?php 
							for($i=1; $i<=$num; $i++){
								$row = mysql_fetch_array($result);
								$prod_name = $row['pr_name'];
						?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="../images/product/room/<?php echo $row['pr_img'];?>/00.jpg" alt="<?php echo $prod_name;?>">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												ใส่ตะกร้า
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="../product-detail.php?prod_type=<?php echo $producttype;?>&p_id=<? echo $row['pr_id'];?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $prod_name;?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<span style="margin-right:50px;"><s>฿<?php echo number_format($row['pr_price'], 0, '.', ',');?> </s></span> <strong>฿<?php echo number_format($row['pr_sell_price'], 0, '.', ',');?></strong>
									</span>
								</div>
							</div>
						</div>
						
						<?php } ?>
						
						
						<?php 
							for($i=1; $i<=$num_more; $i++){
								$row_more = mysql_fetch_array($result_more);
								$product_name = $row_more['pr_name'];
						?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="../images/product/<?php echo $row_more['pr_img'];?>" alt="<?php echo $product_name;?>"> 

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												ใส่ตะกร้า
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="../product-detail.php?prod_type=<?php echo $producttype;?>&p_id=<? echo $row_more['pr_id'];?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $prod_name;?>
										<?php echo $product_name;?>
									</a>


									<span class="block2-price m-text6 p-r-5">
										<span style="margin-right:50px;"><s>฿<?php echo number_format($row_more['pr_price'], 0, '.', ',');?> </s></span> <strong>฿<?php echo number_format($row_more['pr_sell_price'], 0, '.', ',');?></strong>
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
	<div id="cattype" style="display:none;"><?php echo 3; ?></div>
	<?php include('../includes/inc_js_sub.php');?>
</body>
</html>
