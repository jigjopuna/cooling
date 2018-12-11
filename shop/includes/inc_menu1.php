				
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
						
							<li class="catetype1">
								<a href="../index.php">หน้าแรก</a>
							</li> 
							
							<li class="catetype2">
								<a href="machine.php">เครื่องทำความเย็น</a>
								<ul class="sub_menu">
									<li><a href="">Condensing Unit</a></li>
									<li><a href="">คอมพรสเซอร์</a></li>
									<li><a href="">คอล์ยเย็น</a></li>
									<li><a href="">ฮีทเตอร์</a></li>
									<li><a href="">คอล์ยร้อน</a></li>
								</ul>
							</li>

							

							<li class="catetype3">
								<a href="room.php">อุปกรณ์ห้องเย็น</a>
								<ul class="sub_menu">
									<li><a href="product/room_detail.php?cate=1">โฟมผนังห้องเย็น</a></li>
									<li><a href="product/room_detail.php?cate=3">อลูมิเนียม</a></li>
									<li><a href="product/room_detail.php?cate=4">ซิลิโคน</a></li>
									<li><a href="product/room_detail.php?cate=10">วาล์วปรับแรงดัน</a></li>
									<li><a href="product/room_detail.php?cate=5&subcate=1">ประตูห้องเย็น</a></li>
									<li><a href="product/room_detail.php?cate=5&subcate=2">บานพับประตู</a></li>
									<li><a href="product/room_detail.php?cate=5&subcate=2">กลอนประตู</a></li>
									<li><a href="product/room_detail.php?cate=6">อุปกรณ์อื่นๆ</a></li>
								</ul>
							</li>

							<li class="catetype4">
								<a href="electric.php">ระบบไฟฟ้า</a>
								<ul class="sub_menu">
									<li><a href="">Phase Protection</a></li>
									<li><a href="">Carel</a></li>
									<li><a href="">Magnetic</a></li>
									<li><a href="">Overload</a></li>
									<li><a href="">ตู้คอนโทรล</a></li>
									<li><a href="">สายไฟต่างๆ</a></li>
								</ul>
							</li>
							
							
							<li class="catetype5">
								<a href="mass.php">อุปกรณ์เครื่อง</a>
								<ul class="sub_menu">
									<?php 
										$sqlmass = "SELECT * FROM tb_category WHERE cat_type = 2 AND cat_publish = 1";
										$resultmass = mysql_query($sqlmass);
										$nummass = mysql_num_rows($resultmass);
										
										for($i=1; $i<=$nummass; $i++) { 
											$rowmass = mysql_fetch_array($resultmass);
									?>
									<li><a href=""><?php echo $rowmass['cat_name'];?></a></li>
									<?php } ?>
								</ul>
							</li>

							<li class="catetype6">
								<a href="../about.php">งานโครงสร้าง</a>
							</li>

							<li class="catetype7">
								<a href="../contact.php">ติดต่อ</a>
							</li>
						</ul>
					</nav>
				</div>