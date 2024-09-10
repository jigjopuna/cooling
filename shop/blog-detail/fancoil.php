<?php 
	  include('../../include/connect.php');
	  $currmenu = 3;  // ตั้งค่าเมนูให้ default ไว้ที่หมวดนี้

	  $sql_eurotech = "SELECT * FROM tb_tools WHERE t_type = 1 AND t_cate = 32 AND t_subcate = 1 AND t_publish = 1 ORDER BY t_attrib1";
	  $result_eurotech = mysqli_query($conn, $sql_eurotech);
	  $num_eurotech = mysqli_num_rows($result_eurotech);
	  
	  //Stainless
	  $sql_stales = "SELECT * FROM tb_tools WHERE t_type = 1 AND t_cate = 32 AND t_subcate =  2 AND t_publish = 1 ORDER BY t_attrib1";
	  $result_stales = mysqli_query($conn, $sql_stales);
	  $num_stales = mysqli_num_rows($result_stales);
	  
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ขายพัดลมคอยล์เย็นห้องเย็น มอเตอร์พัดลมคอยเย็น</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('../includes/inc_robot.php'); ?>
	
	<meta name="copyright" content="พัดลมห้องเย็น"/>
	<meta name="keywords" content="อะไหล่ห้องเย็น, อุปกรณ์ห้องเย็น" />
    <meta name="description" content="ร้านขายพัดลมคอยเย็น ห้องเย็น ร้านอยู่ที่ไหน ร้านไหนมีขายบ้าง ราคากี่บาท พัดคอยเย็นเสีย ซ่อมได้ไหม คุ้มค่าซ่อมหรือเปล่า หรือซื้อใหม่จะคุ้มกว่าไหม ราคาไม่ต่างกัน เรามีพัดสแตนเลส ใบพัดและตะแกรง สแตนเลสด้วย">
    <meta name="author" content="">
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="ขายพัดลมคอยล์เย็นห้องเย็น มอเตอร์พัดลมคอยเย็น AXIAL FAN Eurotech" />
	<meta property="og:description" content="ร้านขายพัดลมคอยเย็น ห้องเย็น ร้านอยู่ที่ไหน ร้านไหนมีขายบ้าง ราคากี่บาท พัดคอยเย็นเสีย ซ่อมได้ไหม คุ้มค่าซ่อมหรือเปล่า หรือซื้อใหม่จะคุ้มกว่าไหม ราคาไม่ต่างกัน เรามีพัดสแตนเลส ใบพัดและตะแกรง สแตนเลสด้วย" />
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
						<?php //include('../includes/inc_minibasket_mobile1.php');?>
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
							    
								<img src="../images/product/machine/fan/fancoil_eurotech01.jpg" alt="พัดลม axcail fan ห้องเย็น">
								<!--<img src="../images/blog-04.jpg" alt="IMG-BLOG">-->
							</div>

							<div class="blog-detail-txt p-t-33">
								<h4 class="p-b-11 m-text24">
									ขายพัดลมคอยล์เย็นห้องเย็น
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										By Admin
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										28 January, 2024
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										พัดลมห้องเย็น
										<span class="m-l-3 m-r-6"> </span>
									</span>

									<span>
										<!--8 Comments-->
									</span>
								</div>

								<p class="p-b-25">
									
									<br />
									พัดลมคอยล์เย็น ห้องเย็น พัดลมคอยล์ร้อน ห้องเย็น<span class="text-strong">AXIAL FAN</span> ยี่ห้อ Eurotech หรือ ebm มีพัดลมแบบสแตนเลส ใบพัด ตะแกรงสแตนเลส มีสินค้าพร้อมจัดส่ง ไม่ต้องรอนาน <br /><br />

									<span class="topic-article">คุณสมบัติ</span><br />
									- ระบายความร้อนได้ดี <br />
									- ส่งลมได้ไกล<br />
									- มีตะแกรง แข็งแรงทนทาน<br />
									- เสียงเงียบ ไม่รบกวน<br />
									- มอเตอร์ประหยัดไฟ<br />
									- รับประกันนาน 1 ปี <br />
									-  ใบพัดเป็นใบเหล็กแข็งแรง <br /><br />


									<span class="topic-article">วิธีการเลือกซื้อ</span><br />

									1. ดูขนาดพัดลมที่ต้องการ เช่น 300 mm, 500 mm หรือ ใหญ่กว่านี้ ให้เหมาะสมกับพัดลมที่จะเปลี่ยน<br /><br />
							    	2. ดูมอเตอร์ไฟฟ้าที่ใช้ ใช้กี่เฟส ใช้แรงดัน 230v หรือ 380v ถ้าเป็น 3 เฟสจะไม่มีแคป หรือ คาปาซิเตอร์ ถ้าเป็น single phase จะมีแคปให้ ถ้าเรามีไฟ 1 เฟส จะใช้กับพัดลม 3 เฟสไม่ได้<br /><br />
									3. ทิศทางลมใบพัด ของพัดลม จะมีแบบเป่า กับ แบบดูด (แบบเป่าขนาดพัดลมใหญ่สุดที่ 350 mm)
								
									<br />
									<br />
									พัดลมติดตั้งไม่ยาก เพียงแค่ยึดน็อตพัดลมเข้ากับโครงคอยล์เย็นหรือคอยล์ร้อน และต่อสายไฟฟ้าเข้ามาที่พัดลมก็เสร็จเรียบร้อย<br /><br />
									<span class="topic-article">ราคา</span><br />
									รายละเอียดเรื่อง <span class="text-strong"></span>ราคา ให้ดูตามตารางข้างล่างนี้เลยนะครับ
									<br />
									<br />
									
								
									
									<a href="https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech02.jpg" target="_blank">
										<img style="width:100%;" src="https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech02.jpg" alt="พัดลมคอยล์เย็น ห้องเย็น"/>
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
										
										<?php 
										for($i=1; $i<=$num_eurotech;$i++){
											$row_eurotech = mysqli_fetch_array($result_eurotech);
									?>
										<tr class="table-row">
											<td class="column-1">
												<a href="https://chokeutsaha.co.th/quotation.php?tid=<?php echo $row_eurotech['t_id'];?>&ship=<?php echo $row_eurotech['t_kw2'];?>" target="_blank">
													<?php echo $row_eurotech['t_model'];?>
												</a>
											</td>
											
											
											<th class="column-2" style="text-align: center;" ><?php echo $row_eurotech['t_attrib1']; ?></th>
											<th class="column-5" style="text-align: center; font-size:18px; font-weight:bold; color:red;"><?php echo number_format($row_eurotech['t_price_sell'], 0, '.', ','); ?></th>
											<td class="column-3"><?php echo $row_eurotech['t_volt'].'/'.$row_eurotech['t_kw1'].'/'.$row_eurotech['t_hz'];?></td>
											<td class="column-3"><?php echo $row_eurotech['t_kw']; ?></td>
											<th class="column-5"><?php echo $row_eurotech['t_amp']; ?></th>
											<td class="column-4" style="text-align: center;"><?php echo number_format($row_eurotech['t_attrib2'], 0, '.', ',');  ?></td>
											<td class="column-4"><?php echo number_format($row_eurotech['t_attrib3'], 0, '.', ',');?></td>
										</tr>
									<?php } ?>
									
										
										</tbody>
									</table>
								</div>
								<br><br>
								
								
								<div class="wrap-table-shopping-cart bgwhite">
									<table class="table-shopping-cart">
										<tbody>
										
										<tr class="table-row">
											<th class="column-1" colspan="8" style="font-size:24px; text-align: center;" > พัดลม AXIAL FAN สแตนเลส</th>
										</tr>
										
										<tr class="table-head">
											<th class="column-1" style="width:27%;">Model</th>
											<th class="column-2" style="width:10%; text-align: center;">ขนาด mm</th>
											<th class="column-5" style="width:10%; text-align: center;">ราคา</th>
											<th class="column-3" style="width:10%;">V/Ph/Hz</th>
											<th class="column-3" style="width:10%;">วัตต์ W</th>
											<th class="column-5" style="width:10%;">แอมป์ A</th>
											<th class="column-4" style="width:10%; text-align: center;">Air m<sup>3</sup>/h</th>
											<th class="column-4" style="width:10%;">Speed rpm</th>
										</tr>
										
										
									<?php 
										for($i=1; $i<=$num_stales;$i++){
											$row_stales = mysqli_fetch_array($result_stales);
									?>
										<tr class="table-row">
											<td class="column-1">
												<a href="https://chokeutsaha.co.th/quotation.php?tid=<?php echo $row_stales['t_id'];?>&ship=<?php echo $row_stales['t_kw2'];?>" target="_blank">
													<?php echo $row_stales['t_model'].' ('.$row_stales['t_detail'].')';?>
												</a>
											</td>
											<th class="column-2" style="text-align: center;" ><?php echo $row_stales['t_attrib1']; ?></th>
											<th class="column-5" style="text-align: center; font-size:18px; font-weight:bold; color:red;"><?php echo number_format($row_stales['t_price_sell'], 0, '.', ','); ?></th>
											<td class="column-3"><?php echo $row_stales['t_volt'].'/'.$row_stales['t_kw1'].'/'.$row_stales['t_hz'];?></td>
											<td class="column-3"><?php echo $row_stales['t_kw']; ?></td>
											<th class="column-5"><?php echo $row_stales['t_amp']; ?></th>
											<td class="column-4" style="text-align: center;"><?php echo number_format($row_stales['t_attrib2'], 0, '.', ',');  ?></td>
											<td class="column-4"><?php echo number_format($row_stales['t_attrib3'], 0, '.', ',');?></td>
										</tr>
									<?php } ?>
										
										</tbody>
									</table>
								</div>
								<br><br>
								
								
								
								
								<span class="topic-article">รีวิวพัดลมห้องเย็น</span><br>
								<iframe width="100%" height="400" src="https://www.youtube.com/embed/fpF08RLbnNI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br><br>
								
								<span class="topic-article">รีวิวพัดลมคอยล์ร้อน 630 mm</span><br>
								<iframe width="100%" height="400" src="https://www.youtube.com/embed/gbOej8VVhtU?si=9HXYTue3cgvUoZ3O" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe><br><br>


								<span class="topic-article">รีวิวพัดลมคอยล์เย็น แสตนเลส 630 mm</span><br>
								<iframe width="100%" height="400" src="https://www.youtube.com/embed/43yFBL6M06s?si=yGINje8YGO6MPjH7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe><br><br>
						
						
							</div>
							
							<div class="item-blog-txt p-t-33">
									<h4 class="p-b-11">

									</h4>

									<div class="s-text8 flex-w flex-m p-b-21">
										<?php //include('../includes/contacts.php');?>
										ติดต่อสอบถาม สั่งซื้อ<br>
										Line ID : phurits<br>
										TEL : 099-129-0789 หรือ 084-013-7350 <br>
									</div>

									<p class="p-b-12">
										<?php //include('../includes/inc_qrcode.php');?>
									</p>
							</div>
							

							<div class="flex-m flex-w p-t-20">
								<span class="s-text20 p-r-20">
									Tags
								</span>

								<div class="wrap-tags flex-w">
									<a href="#" class="tag-item">
										พัดลมคอยล์เย็น
									</a>

									<a href="#" class="tag-item">
										มอเตอร์พัดลมคอยล์เย็น
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
   <script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "โชคอุตสาหะ", 
  "priceRange":"4000-20000 บาท", 
  "servesCuisine":"พัดลมห้องเย็น", 
  "description": "จำหน่ายพัดลมห้องเย็น มอเตอร์พัดลมคอยล์เย็น ที่ใช้สำหรับห้องเย็นและอุตสาหกรรม", 
  "image": "https://topcooling.net/shop/images/product/machine/fan/fancoil_eurotech01.jpg",
  "address":{ 
      "@type":"PostalAddress",
      "streetAddress":"190/70 ม.10 ",
      "addressLocality":"ราชบุรี",
      "addressRegion":"ราชบุรี", 
      "postalCode":"70000"
   }, 
   "geo":{ 
      "@type":"GeoCoordinates",
      "latitude": 13.52373294645152, 
      "longitude": 99.80735148909625
   },
  "brand": {
    "@type": "Thing",
    "name": "โชคอุตสาหะ"
  },
  "contactPoint": {
    "@type": "ContactPoint", 
	"telephone": "+66 84-013-7350",
    "contactType": " ยินดีบริการลูกค้า"
  },
  
  "offers": {
    "@type": "Offer",
    "availability": "http://schema.org/InStock",
    "price": "4000.00",
    "priceCurrency": "THB"
  },
  
   "openingHoursSpecification":[ 
      
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Monday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Tuesday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Wednesday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Thursday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Friday"
         ],
         "opens":"08:00",
         "closes":"17:00"
      },
      { 
         "@type":"OpeningHoursSpecification",
         "dayOfWeek":[ 
            "Saturday"
         ],
         "opens":"11:00",
         "closes":"23:59"
      }
   ],
   "aggregateRating":{ 
      "@type":"AggregateRating",
      "ratingValue":5,
      "reviewCount":120,
      "ratingCount":156
   }
}
</script>

</body>
</html>
