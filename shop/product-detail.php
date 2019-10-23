<?php session_start(); 
	  require_once('includes/connect.php');
	  $prod_type = trim($_GET['prod_type']);
	  $prod_id = trim($_GET['p_id']);
	  
	  
	  if($prod_type=='r'){
		  $sql = "SELECT * FROM tb_productroom WHERE pr_id = '$prod_id'";
		  $currmenu = 3;  // ตั้งค่าเมนูให้ default ไว้ที่หมวดนี้
		  $menuname = 'อุปกรณ์ห้องเย็น';
		  $url = 'room.php';
		  
		  $row = mysql_fetch_array(mysql_query($sql));
		  $prodname =  $row['pr_name'];
		  $seo =  $row['pr_seo'];
		  $descr1 =  $row['pr_descr1'];
		  $descr2 =  $row['pr_descr2'];
		  $descr3 =  $row['pr_descr3'];
		  $pr_img =  $row['pr_img'];
		  $video =  $row['pr_vdo'];
		  
	  }else if($prod_type=='m'){
		  
	  }
	  
	  /*$takaid = $_SESSION['session_basket'];
	  $getbas = "SELECT * FROM tb_inbasket WHERE bas_id='$takaid'";
	  $nubbas = mysql_fetch_array(mysql_query("SELECT count(*) nubtaka FROM tb_inbasket WHERE bas_id='$takaid'"));
	  echo $nubbas['nubtaka']; exit();*/
	  
	  
	  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $prodname;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $seo?>">
    <meta name="author" content="topcooling, tcl">
	
	<meta property="og:url" content="https://topcooline.net/shop/product-detail.php?prod_type=<?php echo $prod_type?>&p_id=<?php echo $prod_id?>" />
	<meta property="og:type" content="article"/>
	<meta property="og:title" content="<?php echo $prodname?>"/>
	<meta property="og:description" content="<?php echo $seo?>"/>
	<!--<meta property="og:image" content="https://topcooline.net/shop/images/<?php //echo $pr_img?>"/>-->
	<meta property="og:image" content="images/product/room/<?php echo $pr_img;?>/5.jpg"/>
	
	
	<?php include('includes/inc_css.php'); ?>
</head>
<body class="animsition">
	<?php require_once('includes/google-verify.php');?>
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
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<?php include('includes/inc_minibasket.php');?>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="images/icons/logo.jpg" alt="ห้องเย็น tcl">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

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

	<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="index.php" class="s-text16">
			หน้าแรก
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="<?php echo $url;?>" class="s-text16">
			<?php echo $menuname;?>
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="#" class="s-text16">
			<?php echo $prodname;?>
			
		</a>

	</div>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="images/product/room/<?php echo $pr_img;?>/11.jpg">
							<div class="wrap-pic-w">
								<img src="images/product/room/<?php echo $pr_img;?>/1.jpg" alt="">
							</div>
						</div>

						<div class="item-slick3" data-thumb="images/product/room/<?php echo $pr_img;?>/22.jpg">
							<div class="wrap-pic-w">
								<img src="images/product/room/<?php echo $pr_img;?>/2.jpg" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="images/product/room/<?php echo $pr_img;?>/33.jpg">
							<div class="wrap-pic-w">
								<img src="images/product/room/<?php echo $pr_img;?>/3.jpg" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?php echo $prodname;?>
				</h4>

				<span class="m-text17">
					<span style="margin-right:50px;"><s><?php echo '฿'.number_format($row['pr_price'], 0, '.', ',');?></s></span>    <?php echo '฿'.number_format($row['pr_sell_price'], 0, '.', ',');?>
				</span>

				<p class="s-text8 p-t-10">
					<?php echo $descr1;?>
				</p>

				
				<div class="p-t-33 p-b-60">
				<?php //if($prod_type == 'm') { ?>
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							Size
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="size">
								<option>Choose an option</option>
								<option>Size S</option>
								<option>Size M</option>
								<option>Size L</option>
								<option>Size XL</option>
							</select>
						</div>
					</div>

					<div class="flex-m flex-w">
						<div class="s-text15 w-size15 t-center">
							Color
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="color">
								<option>Choose an option</option>
								<option>Gray</option>
								<option>Red</option>
								<option>Black</option>
								<option>Blue</option>
							</select>
						</div>
					</div>
				<?php //} ?>

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product" id="num-product" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Add to Cart
								</button>
								<input type="hidden" value="<?php echo $prod_id;?>" id="product_id">
								<input type="hidden" value="<?php echo $prod_type;?>" id="prod_type">
							</div>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: <?php echo $prod_type.'-0'.$prod_id?></span>
					<span class="s-text8">Categories: Mug, Design</span>
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						คุณสมบัติ
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
						<?php echo $row['pr_descr2'];?>
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						รายละเอียด
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
						<?php echo $row['pr_descr3'];?>
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Reviews (0)
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<section class="bgwhite p-t-60">
		<?php  include('images/product/room/'.$pr_img.'/'.$pr_img.'.php');?>
	</section>


	<!-- Relate Product -->
	<?php  include('includes/inc_relateprod.php');?>


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
	<div id="cattype" style="display:none;"><?php echo $currmenu; ?></div>
    
	<?php include('includes/inc_js.php');?>
</body>
</html>
