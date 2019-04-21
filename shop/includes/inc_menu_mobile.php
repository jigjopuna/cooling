<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							ฟรีค่าขนส่งเมื่อซื้อมากกว่า 10,000 บาท
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								Line : @tclshop
							</span>

							<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>BAHT</option>
									<option>USD</option>
								</select>
							</div>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>
					
					
					<li class="item-menu-mobile">
						<a href="https://topcooling.net/shop/index.php">หน้าแรก</a>
					</li>
					
					<li class="item-menu-mobile">
						<a href="machine.php">เครื่องทำความเย็น</a>
						<ul class="sub-menu">
							<li><a href="">Condensing Unit</a></li>
							<li><a href="">คอมพรสเซอร์</a></li>
							<li><a href="">คอล์ยเย็น</a></li>
							<li><a href="">ฮีทเตอร์</a></li>
							<li><a href="">คอล์ยร้อน</a></li>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>

					<li class="item-menu-mobile">
						<a href="https://topcooling.net/shop/product/room.php">อุปกรณ์ห้องเย็น</a>
						<ul class="sub-menu">
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=1">โฟมผนังห้องเย็น</a></li>
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=3">อลูมิเนียม</a></li>
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=4">ซิลิโคน</a></li>
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=10">วาล์วปรับแรงดัน</a></li>
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=5&subcate=1">ประตูห้องเย็น</a></li>
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=5&subcate=2">บานพับประตู</a></li>
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=5&subcate=2">กลอนประตู</a></li>
							<li><a href="https://topcooling.net/shop/product/room_detail.php?cate=6">อุปกรณ์อื่นๆ </a></li>
						</ul>
									
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>
					
					<li class="item-menu-mobile">
						<a href="https://topcooling.net/shop/product/electric.php">ระบบไฟฟ้า</a>
						<ul class="sub-menu">
							<li><a href="">Phase Protection</a></li>
							<li><a href="">Carel</a></li>
							<li><a href="">Magnetic</a></li>
							<li><a href="">Overload</a></li>
							<li><a href="">ตู้คอนโทรล</a></li>
							<li><a href="">สายไฟต่างๆ</a></li>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>
					
					<li class="item-menu-mobile">
						<a href="https://topcooling.net/shop/product/machass.php">อุปกรณ์เครื่อง</a>
						<ul class="sub-menu">
							<?php 
								$sqlmass1 = "SELECT * FROM tb_category WHERE cat_type = 2 AND cat_publish = 1";
								$resultmass1 = mysql_query($sqlmass1);
								$nummass1 = mysql_num_rows($resultmass1);
										
								for($i=1; $i<=$nummass1; $i++) { 
									$rowmass1 = mysql_fetch_array($resultmass1);
								?>
								<li><a href=""><?php echo $rowmass1['cat_name'];?></a></li>
							<?php } ?>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>


					<li class="item-menu-mobile">
						<a href="about.html">เครื่องมือช่าง</a>
					</li>

					<li class="item-menu-mobile">
						<a href="https://topcooling.net/shop/contact.php">ติดต่อ</a>
					</li>
				</ul>
			</nav>
		</div>