<?php session_start(); 
	  require_once('../includes/connect.php');
	  $cate = trim($_GET['cate']);
	  $subcate = trim($_GET['subcate']);
	  
	  $sql_catroom1 = "SELECT * FROM tb_categoryroom";
	  $result_catroom1 = mysql_query($sql_catroom1);
	  $num_catroom1 = mysql_num_rows($result_catroom1);

	  //ถ้าลูกค้ากด ALL ให้ query ทั้งตาราง
	  if($cate == 0){
		$sql = "SELECT * FROM tb_productroom WHERE pr_publish = 1";	  
	  }else{
		  
		  //ดูว่ามี subcate ไหม subcate หมายถึง cate คือประตู subcate ส่วนย่อยของประตู
		  if($cate != '' && $subcate != ''){
			  //$sql = "SELECT * FROM tb_productroom WHERE pr_cate = '$cate' AND pr_subcate = '$subcate' AND pr_publish = 1";
				$sql = "SELECT * FROM tb_tools WHERE t_type = 2 AND t_cate = '$cate' AND t_subcate = '$subcate'";
			  
		  }else{ //ถ้าไม่มี subcate ก็ให้เลือก cate อย่างเดียว เพราะเด่ว subcate เป็น 0 หรือ ค่าว่างเด่วจะมีปัญหา
			  //$sql = "SELECT * FROM tb_productroom WHERE pr_cate = '$cate' AND pr_publish = 1";	 
				$sql = "SELECT * FROM tb_tools WHERE t_type = 2 AND t_cate = '$cate'";
		  }
	  }
	  // query สินค้าอื่นๆ ที่เกียวกับห้องที่เกี่ยวข้องที่ไม่ใช่ cate ที่เลือก  
	  $sql_more = "SELECT * FROM tb_tools WHERE t_type = 2 AND t_cate != '$cate' ORDER BY RAND() LIMIT 0 , 20";
	 
	  $result = mysql_query($sql);
	  $num = mysql_num_rows($result);

      $result_more = mysql_query($sql_more);
	  $num_more = mysql_num_rows($result_more);
	  
	  $producttype = 'r';

	  
	  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>หาซื้ออุปกรณ์อะไหล่ห้องเย็นที่ไหนดี ราคาถูกๆ</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="เรามีขายอะไหล่ห้องเย็นราคาถูกๆ ขายครับ ไม่ว่าจะเป็น กลอนประตู บานพับขาต่ำ ขาสูง วาล์วปรับแรงดัน แผ่นฉนวน PS PU โฟมขาว โฟมเหลือง">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="หาซื้ออุปกรณ์อะไหล่ห้องเย็นที่ไหนดี ราคาถูกๆ" />
	<meta property="og:description" content="เรามีขายอะไหล่ห้องเย็นราคาถูกๆ ขายครับ ไม่ว่าจะเป็น กลอนประตู บานพับขาต่ำ ขาสูง วาล์วปรับแรงดัน แผ่นฉนวน PS PU โฟมขาว โฟมเหลือง" />
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
				<a href="https://topcooling.net/shop/index.php" class="logo">
					<img src="../images/icons/logo.jpg" alt="ห้องเย็นท็อปคูลลิ่ง">
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
				<img src="https://topcooling.net/shop/images/icons/logo.jpg" alt="top cooling ห้องเย็น">
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
						<span class="s-text8 p-t-5 p-b-5">
							มีทั้งหมด <?php echo $num;?>  รายการ  <!--Showing 1–12 of 16 results-->
						</span>
					</div>

					<!-- Product -->
					
					<div class="row">
						<?php 
							for($i=1; $i<=$num; $i++){
								$row = mysql_fetch_array($result);
								$prod_name = $row['t_name'];
								
								if($cate==1 || $cate==2){
									$prod_name1 = $prod_name . ' '.$row['t_type'].' '.$row['t_size'].' นิ้ว'; 
								}else{
									$prod_name1 = $prod_name;
								}
								
								$prices = $row['t_price'];
								$costprice = $row['t_price_sell'];
						?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<a href="../product-detail.php?prod_type=<?php echo $producttype;?>&p_id=<? echo $row['t_id'];?>">
										<img src="../images/product/room/<?php echo $row['t_img'];?>/00.jpg" alt="<?php echo $prod_name1;?>">
									</a>
									
								</div>

								<div class="block2-txt p-t-20">
									<a href="../product-detail.php?prod_type=<?php echo $producttype;?>&p_id=<? echo $row['t_id'];?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $prod_name1;?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<span style="margin-right:50px;"><s>฿<?php echo number_format($prices, 0, '.', ',');?> </s></span> <strong>฿<?php echo number_format($costprice, 0, '.', ',');?></strong>
									</span>
								</div>
							</div>
						</div>
						
						<?php } ?>
						
						
						<?php 
							for($i=1; $i<=$num_more; $i++){
								$row_more = mysql_fetch_array($result_more);
								$product_name = $row_more['t_name'];
						?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="../images/product/<?php echo $row_more['t_img'];?>" alt="<?php echo $product_name;?>"> 

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
									<a href="../product-detail.php?prod_type=<?php echo $producttype;?>&p_id=<? echo $row_more['t_id'];?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $prod_name;?>
										<?php echo $product_name;?>
									</a>


									<span class="block2-price m-text6 p-r-5">
										<span style="margin-right:50px;"><s>฿<?php echo number_format($row_more['t_price'], 0, '.', ',');?> </s></span> <strong>฿<?php echo number_format($row_more['t_price_sell'], 0, '.', ',');?></strong>
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
