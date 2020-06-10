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
	<title>คอยล์เย็น TECUMSEH เชคัมเช่ คอยล์เย็นห้องเย็น</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="Topcooling Shop"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="จำหน่ายชุดคอล์ยเย็น ห้องเย็น ชุดคอยร้อน คอนเด็นซิ่ง คอมเพรสเซอร์ ยี่ห้อ เชคัมเช่ Tecumseh มีของพร้อมจัดส่งทั่วไทย ราคาเป็นกันเอง มารับของเองได้ มีโรงงานจริง หน้าร้านจริง ตรวจสอบได้">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ขายชุดคอยล์เย็นห้องเย็น เทคัมเช่ Tecumseh อุณหภูมิติดลบ -20 องศา " />
	<meta property="og:description" content="จำหน่ายชุดคอล์ยเย็น ห้องเย็น ชุดคอยร้อน คอนเด็นซิ่ง คอมเพรสเซอร์ ยี่ห้อ เชคัมเช่ Tecumseh มีของพร้อมจัดส่งทั่วไทย ราคาเป็นกันเอง มารับของเองได้ มีโรงงานจริง หน้าร้านจริง ตรวจสอบได้" />
	<meta property="og:image" content="<?php echo $httpurl;?>shop/images/product/machine/fan/cover.jpg" />
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
			พัดลมห้องเย็น
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
							    
								<img src="../images/product/machine/tecumseh/tecumseh-cooler01.jpg" alt="คอล์ยเย็น tecumseh>
								<!--<img src="../images/blog-04.jpg" alt="IMG-BLOG">-->
							</div>

							<div class="blog-detail-txt p-t-33">
								<h4 class="p-b-11 m-text24">
									ขายคอบล์เย็นห้องเย็น Tecumseh
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										By Admin
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										28 October, 2020
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										คอล์ยเย็น Tecumseh
										<span class="m-l-3 m-r-6"> </span>
									</span>

									<span>
										<!--8 Comments-->
									</span>
								</div>

								<p class="p-b-25">
									
									<br />
									คอยล์เย็นห้องเย็น ยี่ห้อเทคัมเช่ ใช้สำหรับ <span class="text-strong">ห้องเย็น</span> อุณหภูมิแช่แข็ง ติดลบ Low Temp และอุณหภูมิเย็นๆ ชิล   Medium Temp Fin 5mm และ 7mm 
									มาพร้อม ฮีทเตอร์ ละลายน้ำแข็ง สำหรับการ Defrost คุณภาพดี แบรนด์ระดับโลก ยี่ห้อที่คุณก็รู้ว่าใคร
									 <br /><br />

									<span class="topic-article">คุณสมบัติ</span><br />
									- ระบายความร้อนได้ดี <br />
									- ส่งลมได้ไกล<br />
									- มีตะแกรง แข็งแรงทนทาน<br />
									- เสียงเงียบ ไม่รบกวน<br />
									- มอเตอร์ประหยัดไฟ<br />
									- รับประกันนาน 1 ปี <br /><br />






									<span class="topic-article">วิธีการเลือกซื้อ</span><br />

									1. อุณหภูมิสินค้าที่เราต้องกี่องศา <br /><br />
							    	2. ขนาดของคอมเพรสเซอร์ใช้กำลังไฟฟ้ากี่วัตต์<br /><br />
									3. ขนาดของห้องเย็นเพื่อเตรียมพื้นที่แขวนคอยล์เย็น
								
									<br />
									<br />
									<span class="topic-article">ราคา</span><br />
									รายละเอียดเรื่อง <span class="text-strong"></span>ราคา ให้ดูตามตารางข้างล่างนี้เลยนะครับ
									<br />
									<br />
									
								
									
									<a href="https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech02.jpg" target="_blank">
										<img style="width:100%;" src="../images/product/machine/tecumseh/tecumseh-cooler01.jpg" alt="คอยเย็น tecumseh"/>
									</a>
									<br /><br />
									
									<a href="https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech03.jpg" target="_blank">
										<img style="width:100%;" src="https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech03.jpg" alt="อะไหล่พัดลมห้องเย็น"/>
									</a>
									<br /><br />
									
									<a href="https://topcooling.net/shop/images/cool/product/machine/fan/fancoil_eurotech04.jpg" target="_blank">
										<img style="width:100%;" src="https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech04.jpg" alt="เปลี่ยนพัดลมห้องเย็น"/>
									</a>
									<br /><br />

								</p>

								<p class="p-b-25">
								
								</p>
								<style>
									.table-shopping-cart td { padding-top: 5px; padding-bottom: 5px; line-height: 1}
								</style>
								<div class="wrap-table-shopping-cart bgwhite">
									<table class="table-shopping-cart">
										<tbody>
										
										<tr class="table-row">
											<th class="column-1" colspan="8" style="font-size:24px; text-align: center;" > รายละเอียดพัดลม AXIAL FAN</th>
										</tr>
										
										<tr class="table-head">
											<th class="column-1">Model</th>
											<th class="column-2" style="text-align: center;">ขนาด mm</th>
											<th class="column-5" style="text-align: center;">ราคา</th>
											<th class="column-3">V/Ph/Hz</th>
											<th class="column-3">วัตต์ W</th>
											<th class="column-5">แอมป์ A</th>
											<th class="column-4" style="text-align: center;">Air m<sup>3</sup>/h</th>
											<th class="column-4">Speed rpm</th>
										</tr>
										
									
										<tr class="table-row">
										
										</tr>
										
										</tbody>
									</table>
								</div>
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
										คอล์ยเย็น tecumseh
									</a>

									<a href="#" class="tag-item">
										คอล์ยเย็น เชคัมเช่
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
									คอล์เย็น Q-Coil
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									คอล์เย็น XMK 
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									คอยล์เย็น GUNTNER
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									คอยล์เย็น KABA
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									คอยล์เย็น ALFA LAVAL
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
								พัดลมห้องเย็น
							</a>

							<a href="#" class="tag-item">
								eurotech
							</a>

							<a href="#" class="tag-item">
								ebm
							</a>

							<a href="#" class="tag-item">
								พัดลมคอยล์เย็น
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
